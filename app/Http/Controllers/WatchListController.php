<?php

namespace App\Http\Controllers;

use App\Http\Requests\WatchListRequest;
use App\Http\Resources\WatchListResource;
use App\Models\WatchList;
use App\Service\WatchListService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WatchListController extends Controller
{
    private WatchListService $watchListService;
    public function __construct(WatchListService $watchlistService)
    {
          $this->watchListService = $watchlistService;
    }

    public function index()
    {
//        $movies =  WatchListRepository::all();
//          $movies = $this->movieRepository::all();
        $movies = $this->watchListService->getItems();
//        return response()->json(["results" => $movies]);
        return response()->json(["results" => WatchListResource::collection($movies)]);
    }

    public function show(int $movie_id)
    {
//        $movie = WatchListRepository::findByMovieId($movie_id);
            $movie = $this->watchListService->getOneItem($movie_id);
        if ($movie){
            return response()->json(['status' => 'mdi-check']);
        }
        return response()->json(['status' => 'mdi-plus']);
    }

    public function store(WatchListRequest $request)
    {
        $parametrosPermitidos = $request->validate();

        try {
            DB::beginTransaction();
//            $this->watchListService->createItemList($parametrosPermitidos['movie']);
//            WatchList::create([
//                'name' => $request->name,
//                'url' => $request->url,
//                'type' => $request->type,
//                'movie_id' => $request->movie_id,
//                'user_id' => Auth::user()->id,
//            ]);
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
            $this->watchListService->delete($ids);
            return response()->json(['message' => 'Removed from your list.', 'type' => 'warning']);
        }catch (ModelNotFoundException $e){
            return response()->json(['message' => 'movie not found'],404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao excluir filmes.', 'error' => $e->getMessage()], 500);
        }
    }
}
