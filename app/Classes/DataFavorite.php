<?php

namespace App\Classes;

use App\Favorite;
use Doctrine\DBAL\Query\QueryException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use simplehtmldom\HtmlDocument;
use Illuminate\Support\Facades\Config;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Database\QueryException as QException;

class DataFavorite
{
    private $httpClient;
    private $parser;
    private $result;
    private $body;
    private $url;
    private $favicon;
    private $title = 'No name';
    private $metaDescription;
    private $metaKeywords;

    public function __construct(Client $httpClient, HtmlDocument $parser)
    {
        $this->httpClient = $httpClient;
        $this->parser = $parser;
        $this->result = [
            'status' => 'success',
            'errors' => '',
            'favorite' => null
        ];
    }

    public function create($postData)
    {
        try {
            $this->url = $postData['url'];
            $isData = $this->get();

            if ($isData) {
                $this->parse();
                $this->save();
            }
        } catch (RequestException $e) {
            $this->setError("Неверный формат URL");
        } catch (ClientException $e) {
            $this->setError("Страницы {$this->url} не существует");
        } catch (ServerException $e) {
            $this->setError("Сервер не отвечает");
        } catch (QException $e) {
            $this->setError("Ошибка сохранения в БД");
        }


        return $this->result;
    }

    private function get()
    {
        $response = $this->httpClient->get($this->url);

        if ($response->getStatusCode() == '200') {
            $this->body = $response->getBody();

            //Получаем favicon
            $parsedUrl = parse_url($this->url, PHP_URL_HOST);
            $url = $parsedUrl . '/favicon.ico';
            $this->favicon = Config::get('app.upload_dir') . '/' . md5(time()). '.ico';
            $filePath = $_SERVER['DOCUMENT_ROOT'] . $this->favicon;

            $file = fopen($filePath,'w');
            $this->httpClient->get($url, ['sink' => $filePath]);
            fclose($file);
        }

        return true;
    }

    private function setError($message)
    {
        $this->result = [
            'status' => 'fail',
            'error' => $message
        ];
    }

    private function parse()
    {
        $html = $this->parser->load($this->body);

        if ($html) {
            if ($tag = $html->find('title', 0)) {
                $this->title = $tag->plaintext;
            }

            if ($tag = $html->find('meta[name="description"]', 0)) {
                $this->metaDescription = $tag->content;
            }
            if ($tag = $html->find('meta[name="keywords"]', 0)) {
                $this->metaKeywords = $tag->content;
            }
        }
    }

    private function save()
    {
        $data = [
            'url' => $this->url,
            'favicon' => $this->favicon,
            'title' => $this->title,
            'meta_description' => $this->metaDescription,
            'meta_keywords' => $this->metaKeywords
        ];

        $favorite = new Favorite();
        $favorite->fill($data);
        $favorite->save();

        $this->result['favorite'] = $favorite;
    }
}
