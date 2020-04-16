<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\HttpClientKernel;

class FavoriteController extends Controller
{
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
            'url' => 'required|unique:favorites|max:255'
        ],[
            'required' => 'Поле :attribute должно быть заполнено.',
            'unique' => 'Уже существует закладка с таким :attribute',
            'max' => 'Количество символов в поле :attribute должно быть не больше 255',
        ]);

        //TODO: создать сервис добавления закладки там подключить hhtpClient и phpquery
        //AddFavorite::getData($validatedPost);

        return redirect()->route('favorites.index');
    }
 }
