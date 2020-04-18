<?php

namespace App\Http\Controllers;


use App\Classes\Facades\DataFavorite;
use App\Favorite;
use Illuminate\Http\Request;

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
 }
