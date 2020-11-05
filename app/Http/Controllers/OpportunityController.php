<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpportunityStore;
use App\Http\Resources\Opportunity as OpportunityResource;
use App\Http\Resources\OpportunityCollection;
use App\Models\Opportunity;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new OpportunityCollection(Opportunity::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OpportunityStore $request)
    {
       $opportunity = Opportunity::create([
           'title' => $request->title,
           'description' => $request->description,
           'category_id' => $request->categoryId,
           'country_id' => $request->countryId,
           'deadline' => $request->deadline,
           'organizer' => $request->organizer,
           'created_by' => $request->createdBy
       ]);
       return new OpportunityResource($opportunity);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\Opportunity  $opportunity
     * @return \Illuminate\Http\Response
     */
    public function show(Opportunity $opportunity)
    {
        return new OpportunityResource($opportunity);
    }

     

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Opportunity  $opportunity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Opportunity $opportunity)
    {
        $opportunity->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->categoryId,
            'country_id' => $request->countryId,
            'deadline' => $request->deadline,
            'organizer' => $request->organizer,
            'created_by' => $request->createdBy
        ]);

        return new OpportunityResource($opportunity);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Opportunity  $opportunity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Opportunity $opportunity)
    {
        $opportunity->delete(); 

        return "Deleted successfully";
    }
}
