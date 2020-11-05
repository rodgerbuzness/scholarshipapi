<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpportunityDetailRequest;
use App\Http\Resources\OpportunityDetail as ResourcesOpportunityDetail;
use App\Models\OpportunityDetail;
use Illuminate\Http\Request;

class OpportunityDetailController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OpportunityDetailRequest $request)
    {
        $opportunityDetail = OpportunityDetail::create([
            'opportunity_id' => $request->opportunityId,
            'benefits' => $request->benefits,
            'application_process' => $request->applicationProcess,
            'eligibilities' => $request->eligibilities,
            'start_date' => $request->startDate,
            'end_date' => $request->endDate,
            'official_link' => $request->officialLink,
            'further_queries' => $request->furtherQueries,
            'eligible_regions' => json_encode($request->eligibleRegions)
        ]);

        return new ResourcesOpportunityDetail($opportunityDetail);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\OpportunityDetail  $opportunityDetail
     * @return \Illuminate\Http\Response
     */
    public function show(OpportunityDetail $opportunityDetail)
    {
        return new ResourcesOpportunityDetail($opportunityDetail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\OpportunityDetail  $opportunityDetail
     * @return \Illuminate\Http\Response
     */
    public function update(OpportunityDetailRequest $request, OpportunityDetail $opportunityDetail)
    {
        $opportunityDetail->update([
            'opportunity_id' => $request->opportunityId,
            'benefits' => $request->benefits,
            'application_process' => $request->applicationProcess,
            'eligibilities' => $request->eligibilities,
            'start_date' => $request->startDate,
            'end_date' => $request->endDate,
            'official_link' => $request->officialLink,
            'further_queries' => $request->furtherQueries,
            'eligible_regions' => json_encode($request->eligibleRegions)
        ]);

        return new ResourcesOpportunityDetail($opportunityDetail);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\OpportunityDetail  $opportunityDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpportunityDetail $opportunityDetail)
    {
        //
    }
}
