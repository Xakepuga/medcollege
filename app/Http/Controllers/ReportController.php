<?php

namespace App\Http\Controllers;

use App\Facades\ReportFacade;
use App\Services\Reports\LibraryBasedServices\ExportReportService;
use App\Services\Reports\LibraryBasedServices\ExportStatisticsService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    /**
     * [Method description].
     *
     * @param Request $request
     * @param ReportFacade $reportFacade
     * @return View
     */
    public function showRating(Request $request, ReportFacade $reportFacade): view
    {
        $data = $reportFacade->showRating($request);
        return view('reports.rating.index', $data);
    }

    /**
     * [Method description].
     *
     * @param ReportFacade $reportFacade
     * @param int $facultyId
     * @return BinaryFileResponse
     */
    public function exportRatingToWord(ReportFacade $reportFacade, int $facultyId): BinaryFileResponse
    {
        $fileName = $reportFacade->exportRatingToWord($facultyId);
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }

    /**
     * [Method description].
     *
     * @param Request $request
     * @param ReportFacade $reportFacade
     * @return View
     */
    public function showUniversalReport(Request $request, ReportFacade $reportFacade): view
    {
        $data = $reportFacade->showUniversalReport($request);
        return view('reports.universal-report.index', $data);
    }

    /**
     * [Method description].
     *
     * @param Request $request
     * @return void
     */
    public function exportUniversalReportToExcel(Request $request): void
    {
        (new ExportReportService($request->input('report')))
            ->store('aispk_universal_report.xlsx');
    }

    /**
     * @return StreamedResponse
     */
    public function downloadReport(): StreamedResponse
    {
        return Storage::download('aispk_universal_report.xlsx');
    }

    /**
     * [Method description].
     *
     * @param ReportFacade $reportFacade
     * @return View
     */
    public function showStatistics(ReportFacade $reportFacade): view
    {
        $data = $reportFacade->generateStatistics();
        return view('reports.statistic.index', $data);
    }

    /**
     * @param ReportFacade $reportFacade
     * @return Response|BinaryFileResponse
     */
    public function exportStatisticsToExcel(ReportFacade $reportFacade): Response|BinaryFileResponse
    {
        return (new ExportStatisticsService($reportFacade->generateStatistics()))
            ->download('aispk_application_statistics.xlsx');
    }
}
