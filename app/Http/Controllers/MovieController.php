<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use App\Repository\MovieRepository;
use App\Service\MovieService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    private MovieService $movieService;
    public function __construct( MovieService $movieService)
    {
          $this->movieService = $movieService;
    }

    public function index()
    {
//        $movies =  MovieRepository::all();
//          $movies = $this->movieRepository::all();
        $movies = $this->movieService->getMovies();
        return response()->json(["results" => $movies]);
    }

    public function show(int $movie_id)
    {
//        $movie = MovieRepository::findByMovieId($movie_id);
            $movie = $this->movieService->getOneMovie($movie_id);
        if ($movie){
            return response()->json(['status' => 'mdi-check']);
        }
        return response()->json(['status' => 'mdi-plus']);
    }

    public function store(MovieRequest $request)
    {
      $parametrosPermitidos = $request->validate();
        try {
            DB::beginTransaction();
            $this->movieService->createMovie($parametrosPermitidos['movie']);

            DB::commit();
            return response()->json(["message" => 'added to your list'],201);
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

//    public function destroy(array $id)
//    {
//        $movie = Movie::find($id);
//        $movie = MovieRepository::deleteAll($id);
//        $movie->delete();
//
//        return response()->json([$movie]);
//    }

    public function destroy(Request $request)
    {
        $request->validate([
            "ids" => "required|array"
        ]);

        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json(['message' => 'Movie ID not found.'], 422);
        }

        try {
            // Realize a exclusão dos filmes aqui
//            Movie::whereIn('id', $ids)->delete();
                MovieRepository::deleteAllElements($ids);
            return response()->json(['message' => 'Deleted from your list.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao excluir filmes.', 'error' => $e->getMessage()], 500);
        }
    }
}
