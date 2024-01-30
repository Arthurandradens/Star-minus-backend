<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use App\Repository\MovieRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
//    private MovieRepository $movieRepository;
//    public function __construct($movieRepository)
//    {
//          $this->movieRepository = $movieRepository;
//    }

    public function index()
    {
        $movies =  MovieRepository::all();
//          $movies = $this->movieRepository::all();
        return response()->json(["results" => $movies]);
    }

    public function store(MovieRequest $request)
    {
      $parametrosPermitidos = $request->validate();
        try {
            DB::beginTransaction();
            $movie = new Movie($parametrosPermitidos['movie']);
            $movie->save();
            DB::commit();
            return response()->json(["message" => 'criado com sucesso']);
        } catch (\Exception $exception){
            DB::rollBack();
            return response($exception->getMessage(),422);
        }
//       $movie = new Movie(
//           'name' => $request->input('name'),
//           'url' => $request->input('url'),
//           'type' => $request->input('type'),
//           'movie_id' => $request->input('movie_id'),
//       $parametrosPermitidos['movie']
//       );
//
//       $movie->save();
//
//       return response()->json(['message' => 'movie criado com sucesso'],201);
    }

    public function destroy(int $id)
    {
        $movie = Movie::find($id);
        $movie->delete();

        return response()->json(['message' => 'deletado com sucesso']);
    }
}
