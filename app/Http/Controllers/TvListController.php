<?php

namespace App\Http\Controllers;

use App\Models\TvList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTvListRequest;

class TvListController extends Controller
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
    public function store(StoreTvListRequest $request)
    {

        $validatedData = auth()->user()->tvlists()->create($request->validated());
        return response()->json($validatedData);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TvList  $tvList
     * @return \Illuminate\Http\Response
     */
    public function show(TvList $tvList)
    {
        //
    }

    public function showAll()
    {
        //
    }

    public function checkUser($serie)
    {
        // ** Se obtiene el registro de la serie agregada por el User
        $tvCheck = TvList::where([['api_id', $serie],['user_id', Auth::id()]])->first();
        return response()->json($tvCheck);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TvList  $tvList
     * @return \Illuminate\Http\Response
     */
    public function edit(TvList $tvList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TvList  $tvList
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTvListRequest $request,  TvList $tvlist)
    {
        //
        $tvlist->update($request->all());
        return response()->json($tvlist);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TvList  $tvList
     * @return \Illuminate\Http\Response
     */
    public function destroy(TvList $tvList)
    {
        //
    }
}
