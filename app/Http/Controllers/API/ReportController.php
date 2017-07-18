<?php

namespace App\Http\Controllers\API;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseApiController;
use Exception;
use DB;
use Validator;
use App\Helpers\Transformers\ReviewTransformer;

class ReportController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapReportReview = Report::get()->map(function($item){
            return $item->Review;
        });
        $reports = ReviewTransformer::transform($mapReportReview);

        $data = [
            "reports"   =>  $reports
        ];

        return response()->json($data, 200);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'review_id' =>  'required'
        ]);

        $validator->validate();

        try {

            $data = [
                "user_id"   =>  $this->getUser()->id,
                "review_id" =>  $request->review_id
            ];

            $report = Report::updateOrCreate($data);

            return response()->json($report, 201);

        } catch (Exception $e) {

            return response()->json($e->getMessage(), 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
