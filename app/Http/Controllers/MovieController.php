<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Service\MovieService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
            return response()->json(["message" => 'added to your list', 'type' => 'success'],201);
        } catch (\Exception $exception){
            DB::rollBack();
            return response($exception->getMessage(),422);
        }
    }

    public function destroy(Request $request)
    {

        $ids = $request->input('id');

        if (empty($ids)) {
            return response()->json(['message' => 'Please select at least one.', 'type' => 'error']);
        }

        try {
            $this->movieService->delete($ids);
            return response()->json(['message' => 'Removed from your list.', 'type' => 'warning']);
        }catch (ModelNotFoundException $e){
            return response()->json(['message' => 'movie not found'],404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao excluir filmes.', 'error' => $e->getMessage()], 500);
        }
    }
}
