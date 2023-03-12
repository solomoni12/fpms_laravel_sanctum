<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\User;
use App\Models\Field;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Resources\CropResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCropRequest;
use App\Http\Resources\FieldsResource;

class CropController extends Controller
{

    use HttpResponses;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FieldsResource::collection(
            Field::where('user_id', Auth::user()->id)->get()
        );
        return CropResource::collection(
            Crop::where('field_id', Auth::user()->id)->get()
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
    public function store(StoreCropRequest $request) {
        
        $request->validated($request->all());

        // fetch  data
        $field = Field::all()->random()->id;

        $crop = Crop::create([
            'field_id' => $field,
            'crop_type' => $request -> crop_type,
            'planting_date' => $request -> planting_date,
            'harvest_date' => $request->harvest_date
        ]);
        return new CropResource($crop);
        
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
