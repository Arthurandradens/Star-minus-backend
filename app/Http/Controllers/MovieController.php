<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
       $movies = Movie::all();

        return response()->json([$movies]);
    }

    public function store(Request $request)
    {
       $request->validate([
          'name' => 'required|string|max:255',
          'url' => 'required|url',
          'movie_id' => 'required|integer'
      ]);

       $movie = new Movie([
           'name' => $request->input('name'),
           'url' => $request->input('url'),
           'movie_id' => $request->input('movie_id'),
       ]);

       $movie->save();

       return response()->json(['message' => 'movie criado com sucesso'],201);
    }

    public function destroy(int $id)
    {
        $movie = Movie::find($id);
        $movie->delete();

        return response()->json(['message' => 'deletado com sucesso']);
    }
}
