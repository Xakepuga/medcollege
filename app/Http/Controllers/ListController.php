<?php

namespace App\Http\Controllers;

use App\Facades\ListFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ListController extends Controller
{
    /**
     * [Method description].
     *
     * @param Request $request
     * @param ListFacade $listFacade
     * @return View
     */
    public function viewStudentLists(Request $request, ListFacade $listFacade): view
    {
        $data = $listFacade->getList($request);
        return view('lists.view-lists.index', $data);
    }

    /**
     * [Method description].
     *
     * @param Request $request
     * @param ListFacade $listFacade
     * @return View
     */
    public function enrollmentManage(Request $request, ListFacade $listFacade): view
    {
        $data = $listFacade->showFacultyStudents($request);
        return view('lists.enrollment-manage.index', $data);
    }

    /**
     * [Method description].
     *
     * @param Request $request
     * @param ListFacade $listFacade
     * @return JsonResponse
     */
    public function changeEnrollmentStatus(Request $request, ListFacade $listFacade): JsonResponse
    {
        $response = $listFacade->changeEnrollmentStatus($request);
        return response()->json();
    }
}
