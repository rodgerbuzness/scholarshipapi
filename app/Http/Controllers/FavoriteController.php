<?php

namespace App\Http\Controllers;

use App\Http\Resources\Favorite as FavouriteResource;
use App\Http\Resources\FavouriteCollection;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        return new FavouriteCollection($user->favorites);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $favorite = Favorite::create([
            'user_id' => $request->user_id,
            'opportunity_id' => $request->opportunity_id
         ]);
 
         return new FavouriteResource($favorite);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show(Favorite $favorite)
    {
        return new FavouriteResource($favorite);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favorite $favorite)
    {
        $favorite->update([
            'user_id' => $request->user_id,
            'opportunity_id' => $request->opportunity_id
        ]);

        return new FavouriteResource($favorite);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorite $favorite)
    {
        //
    }
}
