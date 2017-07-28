<?php

namespace App\Http\Controllers\API;

use App\Helpers\Transformers\ReviewTransformer;
use App\Http\Controllers\BaseApiController;
use App\Models\Report;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Validator;

class ReportController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $mapReportReview = Review::withTrashed()->withCount('Report')
            ->whereHas('Report')->orderBy('report_count', 'desc')
            ->get();
        $reports = ReviewTransformer::transform($mapReportReview);

        $data = [
            'reports'   => $reports,
        ];

        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'review_id' => 'required',
        ]);

        $validator->validate();

        try {
            $data = [
                'user_id'   => $this->getUser()->id,
                'review_id' => $request->review_id,
            ];

            $report = Report::updateOrCreate($data);

            return response()->json($report, 201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }


}
