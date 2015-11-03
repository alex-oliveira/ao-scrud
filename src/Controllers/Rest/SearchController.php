<?php

namespace AoScrud\Controllers\Rest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class SearchController extends Controller
{

    /**
     * The main repository.
     *
     * @var mixed
     */
    protected $repository;

    /**
     * Return instance of main repository class.
     *
     * @return \AoScrud\Repositories\BaseRepository::class
     */
    abstract public function repository();

    /**
     * The class's constructor.
     */
    public function __construct()
    {
        $this->repository = app()->make($this->repository());
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->repository->search($request->all());

        return response()->json($data->items())
            ->header('x-total', $data->total())
            ->header('x-per-page', $data->perPage())
            ->header('x-current-page', $data->currentPage())
            ->header('x-last-page', $data->lastPage())
            ->header('x-first-item', $data->firstItem())
            ->header('x-last-item', $data->lastItem());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json($this->repository->read($id));
    }

}
