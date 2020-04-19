<?php

namespace App\Http\Controllers;


use App\Classes\Facades\DataFavorite;
use App\Favorite;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Config;

class FavoriteController extends Controller
{
    private const THEAD = [
        'Дата добавления',
        'Favicon',
        'URL страницы',
        'Заголовок страницы'
    ];

    public function index()
    {
        $favorites = Favorite::orderBy('created_at', 'desc')->paginate(5);
        return view('favorites.index', compact('favorites'));
    }

    public function show($id)
    {
        $favorite = Favorite::findOrFail($id);
        return view('favorites.show', compact('favorite'));
    }

    public function create()
    {
        return view('favorites.create');
    }

    public function store(Request $request)
    {
        $validatedPost = $this->validate($request, [
            'url' => 'required|url|unique:favorites|max:255'
        ],[
            'required' => 'Поле :attribute должно быть заполнено.',
            'unique' => 'Уже существует закладка с таким :attribute',
            'max' => 'Количество символов в поле :attribute должно быть не больше 255',
            'url' => 'Неверный формат URL'
        ]);


        $result = DataFavorite::create($validatedPost);

        if ($result['status'] === 'fail') {
            return back()->with('error', $result['error'])->withInput();
        }

        return redirect()->route('favorites.show', $result['favorite']);
    }

    public function export(Spreadsheet $spreadSheet)
    {
        $favorites = Favorite::orderBy('created_at', 'desc')
                         ->select(['created_at','favicon','url','title'])
                         ->get()
                         ->toArray();

        $workSheet = $spreadSheet->getActiveSheet();
        $workSheet->getStyle("A1:D1")->getFont()->setBold( true );

        $letters = range('A','D');

        foreach ($letters as $letter) {
            $workSheet->getColumnDimension($letter)->setAutoSize(true);
        }

        foreach (self::THEAD as $i => $value) {
            $workSheet->setCellValueByColumnAndRow($i + 1,1, $value);
        }

        foreach ($favorites as $row => $favorite ) {
            $j = 1;

            foreach ($favorite as $value) {
                $workSheet->setCellValueByColumnAndRow($j,$row + 2 , $value);
                $j++;
            }
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="favorite.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadSheet);
        $writer->save('php://output');
        exit;
    }
 }
