<?php

namespace App\Http\Controllers;

use App\Garbage;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGarbage;
use App\Http\Requests\UpdateGarbage;

class GarbageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $garbage = Garbage::latest()->paginate(20);

        return view('garbage.index', compact('garbage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Garbage $garbage)
    {
        return view('garbage.create', compact('garbage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGarbage $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGarbage $request)
    {
        Garbage::create($request->validated());

        return redirect()->route('garbage.index')
            ->withSuccess(__('garbage.success.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Garbage  $garbage
     * @return \Illuminate\Http\Response
     */
    public function show(Garbage $garbage)
    {
        return view('garbage.show', compact('garbage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Garbage  $garbage
     * @return \Illuminate\Http\Response
     */
    public function edit(Garbage $garbage)
    {
        return view('garbage.edit', compact('garbage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGarbage  $request
     * @param  \App\Garbage                      $garbage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGarbage $request, Garbage $garbage)
    {
        $garbage->update($request->all());

        return redirect()->route('garbage.index')
            ->withSuccess(__('garbage.success.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Garbage  $garbage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Garbage $garbage)
    {
        $garbage->delete();

        return redirect()->route('garbage.index')
            ->withSuccess(__('garbage.success.delete'));
    }
}
