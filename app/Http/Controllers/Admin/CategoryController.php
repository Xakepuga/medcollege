<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Admin\CategoryFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CategoryFacade $categoryFacade
     * @return View
     */
    public function index(CategoryFacade $categoryFacade): view
    {
        $data = $categoryFacade->index();
        return view('admin.manage.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryFormRequest $categoryFormRequest
     * @param CategoryFacade $categoryFacade
     * @return RedirectResponse
     */
    public function store(CategoryFormRequest $categoryFormRequest, CategoryFacade $categoryFacade)
    {
        $response = $categoryFacade->store($categoryFormRequest->validated());

        return is_object($response) ?
            back()->withInput()->with('error', config('messages.manageCategories.error.store')) :
            back()->with('success', config('messages.manageCategories.success.store'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param CategoryFacade $categoryFacade
     * @return View
     */
    public function show(Request $request, CategoryFacade $categoryFacade): view
    {
        $data = $categoryFacade->show($request);

        if (empty($data)) {
            abort(404);
        }

        return view('admin.manage.categories.category-page', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param CategoryFacade $categoryFacade
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(Request $request, CategoryFacade $categoryFacade, int $id)//: RedirectResponse
    {
        $response = $categoryFacade->destroy($id, $request);

        return is_object($response) ?
            back()->withInput()->with('error', config('messages.manageCategories.error.destroy')) :
            back()->with('success', config('messages.manageCategories.success.destroy'));
    }
}
