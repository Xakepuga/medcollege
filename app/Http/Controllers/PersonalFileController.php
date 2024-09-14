<?php

namespace App\Http\Controllers;

use App\Facades\PersonalFileFacade;
use App\Http\Requests\PersonalFileFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PersonalFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param PersonalFileFacade $personalFileFacade
     * @return View
     */
    public function create(PersonalFileFacade $personalFileFacade): view
    {
        $data = $personalFileFacade->create();
        return view('personal-files.form.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PersonalFileFormRequest $personalFileFormRequest
     * @param PersonalFileFacade $personalFileFacade
     * @return RedirectResponse
     */
    public function store
    (
        PersonalFileFormRequest $personalFileFormRequest,
        PersonalFileFacade      $personalFileFacade
    ): RedirectResponse
    {
        $response = $personalFileFacade->store($personalFileFormRequest->validated());

        return is_object($response) ?
            back()->withInput()->with('error', config('messages.personalFiles.error.store')) :
            redirect()->route('personal-files.manage.personal-file.show', $response)->with('success', config('messages.personalFiles.success.store'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param PersonalFileFacade $personalFileFacade
     * @param int $id
     * @return View
     */
    public function show(Request $request, PersonalFileFacade $personalFileFacade, int $id): view
    {
        $data = $personalFileFacade->show($request, $id);

        if (empty($data['student'])) {
            abort(404);
        }

        return view('personal-files.form.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PersonalFileFacade $personalFileFacade
     * @param int $id
     * @return View
     */
    public function edit(PersonalFileFacade $personalFileFacade, int $id): view
    {
        $data = $personalFileFacade->edit($id);

        if (empty($data['student'])) {
            abort(404);
        }

        return view('personal-files.form.index', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PersonalFileFormRequest $personalFileFormRequest
     * @param PersonalFileFacade $personalFileFacade
     * @param int $id
     * @return RedirectResponse
     */
    public function update
    (
        PersonalFileFormRequest $personalFileFormRequest,
        PersonalFileFacade      $personalFileFacade,
        int                     $id
    ): RedirectResponse
    {
        $response = $personalFileFacade->update($personalFileFormRequest->validated(), $id);

        return is_object($response) ?
            back()->withInput()->with('error', config('messages.personalFiles.error.update')) :
            redirect()->route('personal-files.manage.personal-file.show', $id)->with('success', config('messages.personalFiles.success.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PersonalFileFacade $personalFileFacade
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(PersonalFileFacade $personalFileFacade, int $id): RedirectResponse
    {
        $response = $personalFileFacade->destroy($id);

        return is_object($response) ?
            back()->withInput()->with('error', config('messages.personalFiles.error.destroy')) :
            redirect()->route('personal-files.manage.personal-file.search')->with('success', config('messages.personalFiles.success.destroy'));
    }

    /**
     * [Method description].
     *
     * @param Request $request
     * @param PersonalFileFacade $personalFileFacade
     * @return View
     */
    public function search(Request $request, PersonalFileFacade $personalFileFacade): view
    {
        if ($request->input('query')) {
            $data = $personalFileFacade->search($request);
            return view('personal-files.search.index', ['students' => $data]);
        }

        return view('personal-files.search.index');
    }

    /**
     * [Method description].
     *
     * @param PersonalFileFacade $personalFileFacade
     * @param int $id
     * @return BinaryFileResponse
     */
    public function exportApplicationToWord(PersonalFileFacade $personalFileFacade, int $id): BinaryFileResponse
    {
        $fileName = $personalFileFacade->exportApplicationToWord($id);
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
}
