<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
       $request->validate([
          'name' => 'required|string|max:255',
          'url' => 'required|url',
          'image_id' => 'required|integer'
      ]);

       $movie = new Movie([
           'name' => $request->input('name'),
           'url' => $request->input('url'),
           'image_id' => $request->input('id'),
       ]);

       $movie->save();

       return response()->json(['message' => 'movie criado com sucesso'],201);

    }
}
