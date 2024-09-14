<?php

namespace App\Facades\Admin;

use App\Facades\Facade;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

final class CategoryFacade extends Facade
{
    protected object $category;

    public function __construct
    (
        Category $category = null,
    )
    {
        $this->category = $category ?: new Category();
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        return ['data' => $this->category->all()];
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        // TODO: Implement create() method.
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $validatedData
     * @return void|object
     */
    public function store(array $validatedData)//: void|object
    {
        $tableId = $validatedData['table'];
        $tableName = DB::table('categories')->where('id', $tableId)->first()->table;

        try {
            DB::transaction(function () use ($validatedData, $tableName) {
                DB::table($tableName)->insert(['name' => $validatedData['newItem']]);
            }, 3);

        } catch (\Exception $exception) {
            return $exception;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return array|null
     */
    public function show(Request $request): array|null
    {
        $tableId = $request->input('id');

        $response = DB::table('categories')->where('id', $tableId)->first();

        return empty($response) ? null : ['data' => DB::table($response->table)->get()];
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit()
    {
        // TODO: Implement edit() method.
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update()
    {
        // TODO: Implement update() method.
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param Request|null $request
     * @return array|object
     */
    public function destroy(int $id, Request $request = null)//: void|object
    {
        $permissionRemove = null;
        $tableId = $request->input('id');

        $response = DB::table('categories')->where('id', $tableId)->first();

        if (!empty($response)) {
            $permissionRemove = DB::table($response->table)
                ->where('id', '=', $id)
                ->first()->permission_remove;
        }

        if ($permissionRemove) {
            try {
                DB::transaction(function () use ($id, $response) {
                    DB::table($response->table)->where('id', '=', $id)->delete();
                }, 3);

                return [];

            } catch (\Exception $exception) {
                return $exception;
            }
        }

        return new \Exception();
    }
}
