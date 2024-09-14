<?php

namespace App\Facades;

use Illuminate\Http\Request;

abstract class Facade
{
    /**
     * Display a listing of the resource.
     *
     */
    abstract public function index();

    /**
     * Show the form for creating a new resource.
     *
     */
    abstract public function create();

    /**
     * Store a newly created resource in storage.
     *
     * @param array $validatedData
     * @return void|string|object
     */
    abstract public function store(array $validatedData);//: void|string|object;

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return array|null
     */
    abstract public function show(Request $request): array|null;

    /**
     * Show the form for editing the specified resource.
     *
     */
    abstract public function edit();

    /**
     * Update the specified resource in storage.
     *
     */
    abstract public function update();

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void|object
     */
    abstract public function destroy(int $id);//: void|object;
}
