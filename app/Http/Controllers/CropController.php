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
    public function index(){
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
        
        // if(Auth::user()->id != )
        $request->validated($request->all());
        

        // fetch  data
        // $field = Field::all()->id;
        // Auth::user()->id

        $crop = Crop::create([
            'field_id' => $request -> field_id,
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
    public function show(Crop $crop)
    {
        return $this->isNotAuthorized($crop) ? $this->isNotAuthorized($crop) : new CropResource($crop);
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
    public function update(Request $request, Crop $crop)
    {
        if(Auth::user()->id !== $crop->field_id){
            return $this->error('','You are not Authorized to make request',403);
        }
        $crop->update($request->all());

        return new CropResource($crop);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Crop $crop)
    {
        return $this->isNotAuthorized($crop) ? $this->isNotAuthorized($crop) : $crop -> delete();
    }

    private function isNotAuthorized($crop){
         
        if(Auth::user()->id !== $crop->field_id){
            return $this->error('','You are not Authorized to make request',403);
        }
    }
}
