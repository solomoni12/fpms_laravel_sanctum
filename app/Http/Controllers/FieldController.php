<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreFieldRequest;
use App\Models\Field;
use App\Traits\HttpResponses;
use App\Http\Resources\FieldsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FieldController extends Controller
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
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFieldRequest $request)
    {
        $request->validated($request->all());

        $field = Field::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'location' => $request->location,
            'size' => $request->size
        ]);
        return new FieldsResource($field);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Field $field){

       return $this->isNotAuthorized($field) ? $this->isNotAuthorized($field) : new FieldsResource($field);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Field $field){

        if(Auth::user()->id !== $field->user_id){
            return $this->error('','You are not Authorized to make request',403);
        }
        
        $field->update($request->all());

        return new FieldsResource($field);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Field $field){
        
        return $this->isNotAuthorized($field) ? $this->isNotAuthorized($field) : $field -> delete();
    }

    private function isNotAuthorized($field){
         
        if(Auth::user()->id !== $field->user_id){
            return $this->error('','You are not Authorized to make request',403);
        }
    }
}
