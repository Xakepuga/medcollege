<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Admin\UserFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param UserFacade $userFacade
     * @return View
     */
    public function index(UserFacade $userFacade): view
    {
        $data = $userFacade->index();
        return view('admin.manage.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.manage.users.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param UserFacade $userFacade
     * @param int $id
     * @return View
     */
    public function show(Request $request, UserFacade $userFacade, int $id): view
    {
        $data = $userFacade->show($request, $id);

        if (empty($data['user'])) {
            abort(404);
        }

        return view('admin.manage.users.form', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UserFacade $userFacade
     * @param int $id
     * @return View
     */
    public function edit(UserFacade $userFacade, int $id): view
    {
        $data = $userFacade->edit($id);

        if (empty($data['user'])) {
            abort(404);
        }

        return view('admin.manage.users.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserFormRequest $userFormRequest
     * @param UserFacade $userFacade
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UserFormRequest $userFormRequest, UserFacade $userFacade, int $id): RedirectResponse
    {
        $response = $userFacade->update($userFormRequest->validated(), $id);

        return is_object($response) ?
            back()->withInput()->with('error', config('messages.manageUsers.error.update')) :
            redirect()->route('admin.manage.users.user.show', $id)->with('success', config('messages.manageUsers.success.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserFacade $userFacade
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(UserFacade $userFacade, int $id)//: RedirectResponse
    {
        $response = $userFacade->destroy($id);

        return is_object($response) ?
            back()->withInput()->with('error', config('messages.manageUsers.error.destroy')) :
            back()->with('success', config('messages.manageUsers.success.destroy'));
    }
}
