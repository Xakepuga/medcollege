<?php

namespace App\Facades\Admin;

use App\Facades\Facade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

final class UserFacade extends Facade
{
    protected object $user;

    public function __construct
    (
        User $user = null,
    )
    {
        $this->user = $user ?: new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(): array
    {
        return ['data' => $this->user->all()];
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
    public function store(array $validatedData)
    {
        // TODO: Implement store() method.
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return array|null
     */
    public function show(Request $request, int $id = 0): array|null
    {
        return ['user' => $this->user->find($id)];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return array
     */
    public function edit(int $id = 0): array
    {
        return ['user' => $this->user->find($id)];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param array $validatedData
     * @param int $id
     * @return void|object
     */
    public function update(array $validatedData = [], int $id = 0)//: void|object
    {
        try {
            $this->user = $this->user->find($id);

            DB::transaction(function () use ($validatedData, $id) {

                $this->user->name = $validatedData['name'];
                $this->user->surname = $validatedData['surname'];
                $this->user->email = $validatedData['email'];
                $this->user->is_admin = $validatedData['isAdmin'];
                if ($validatedData['password']) $this->user->password = Hash::make($validatedData['password']);

                $this->user->save();

            }, 3);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void|object
     */
    public function destroy(int $id)//: void|string
    {
        try {
            DB::transaction(function () use ($id) {
                $this->user->find($id)->delete();
            }, 3);
        } catch (\Exception $exception) {
            return $exception;
        }
    }
}
