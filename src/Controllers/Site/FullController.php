<?php

namespace AoScrud\Controllers\Site;

use AoScrud\Exceptions\JsonException;
use AoScrud\Repositories\FullRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class FullController extends Controller
{
    /**
     * Prefix to route names.
     *
     * @var string
     */
    protected $routes = '';

    /**
     * Prefix to views names.
     *
     * @var string
     */
    protected $views = '';

    /**
     * Prefix to lang name.
     *
     * @var string
     */
    protected $lang = '';

    /**
     * The main repository.
     *
     * @var FullRepository;
     */
    protected $repository;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $list = $this->repository->search($request->all());
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route('home');
        }

        return view($this->views . '.index', compact('list'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $obj = $this->repository->read($id);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->routes . '.index');
        }

        return view($this->views . '.show', compact('obj'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $obj = $this->repository->create($request->input('obj'));
        } catch (\Exception $e) {
            if ($e instanceof JsonException) {
                alert()->danger(trans($this->lang . '.whoops'), $e->getMessageArray());
            } else {
                alert()->danger($e->getMessage());
            }
            return redirect()->route($this->routes . '.create')->withInput();
        }

        alert()->success(trans($this->lang . '.created', ['route' => route($this->routes . '.show', ['id' => $obj->id])]));
        return redirect()->route($this->routes . '.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $obj = $this->repository->read($id);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->routes . '.index');
        }

        return view($this->views . '.edit', compact('obj'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $result = $this->repository->update($id, $request->input('obj'));
        } catch (\Exception $e) {
            if ($e instanceof JsonException) {
                alert()->danger(trans($this->lang . '.whoops'), $e->getMessageArray());
            } else {
                alert()->danger($e->getMessage());
            }
            return redirect()->route($this->routes . '.edit', ['id' => $id]);
        }

        $params = ['route' => route($this->routes . '.show', ['id' => $id])];
        if ($result) {
            alert()->success(trans($this->lang . '.updated', $params));
        } else {
            alert()->warning(trans($this->lang . '.unchanged', $params));
        }
        return redirect()->route($this->routes . '.index');
    }

    /**
     * Remove confirm the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $obj = $this->repository->read($id);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->routes . '.index');
        }

        return view($this->views . '.delete', compact('obj'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->destroy($id);
        } catch (\Exception $e) {
            alert()->danger($e->getMessage());
            return redirect()->route($this->routes . '.delete', ['id' => $id]);
        }

        alert()->success(trans($this->lang . '.destroyed'));
        return redirect()->route($this->routes . '.index');
    }

}
