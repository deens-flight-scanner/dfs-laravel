<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Resources\FavoriteResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        //
        $user_id = Auth::guard('web')->user()->id;
        $favorites = Favorite::where('user_id', '=', $user_id)->get();

        // $favorites = Favorite::all();
        return view("favorite")->with('favorites', $favorites);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $favorites = Favorite::all();
        return response([ 'favorites' => 
            FavoriteResource::collection($favorites), 
            'message' => 'Successful'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        $validator = Validator::make($data, [
            'user_id' => 'required',
            'departure_airport' => 'required',
            'departure_city' => 'required',
            'departure_date' => 'required',
            'arrival_airport' => 'required',
            'arrival_city' => 'required',
            'arrival_date' => 'required',
            'price' => 'required',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 
            'Validation Error']);
        }

        $favorite = Favorite::create($data);

        return response([ 'favorite' => new 
            FavoriteResource($favorite), 
            'message' => 'Success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show(Favorite $favorite)
    {
        return response([ 'favorite' => new 
            FavoriteResource($favorite), 'message' => 'Success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function showByUserID($user_id)
    {
        $favorites = Favorite::where('user_id', '=', $user_id)->get();

        return response([ 'favorites' => 
            FavoriteResource::collection($favorites), 
            'message' => 'Successful'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favorite $favorite)
    {
        //

        $favorite->update($request->all());

        return response([ 'favorite' => new 
            FavoriteResource($favorite), 'message' => 'Success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Favorite::destroy($id);
        
        return response(['message' => 'Favorite deleted']);
    }
}
