<?php

namespace App\Http\Controllers;
use App\Models\Crop;
use App\Models\User;
use App\Models\Field;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\FieldsResource;
use App\Http\Requests\StoreFieldRequest;

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
        return CropResource::collection(
            Crop::where('field_id', Auth::user()->id)->get()
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

    //display the crop via field
    public function userFieldCrop($id){

        $user = User::find($id);
        $crop = Crop::find($id);
        $field = Field::find($id);

        return $this->success([
            'crop' => $crop,
            'field' => $field,
            'user' => $user,
            'token'=>$user->createToken('API token of' . $user->name)->plainTextToken
        ]);
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
