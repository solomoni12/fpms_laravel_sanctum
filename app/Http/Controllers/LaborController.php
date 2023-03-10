<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Labor;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\LaborResource;
use App\Http\Requests\StoreLaborRequest;

class LaborController extends Controller
{

    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LaborResource::collection(
            Labor::where('user_id', Auth::user()->id)->get()
        );
        return FieldResource::collection(
            Field::where('user_id', Auth::user()->id)-get()
        );
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
    public function store(StoreLaborRequest $request)
    {
        $request->validated($request->all());

        // fetch field data
        $field = Field::all()->random()->id;

        $labor = Labor::create([
            'user_id' => Auth::user()->id,
            'field_id' => $field,
            'name' => $request->name,
            'labor_cost' => $request->labor_cost
        ]);
        return new LaborResource($labor);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
