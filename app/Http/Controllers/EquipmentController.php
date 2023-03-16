<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\EquipmentResource;
use App\Http\Requests\StoreEquipmentRequest;

class EquipmentController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EquipmentResource::collection(
            Equipment::where('user_id', Auth::user()->id)->get()
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
    public function store(StoreEquipmentRequest $request)
    {
        $request->validated($request->all());

        $equipment = Equipment::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'equipment_cost' => $request->equipment_cost
        ]);
        return new EquipmentResource($equipment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        return $this->isNotAuthorized($equipment) ? $this->isNotAuthorized($equipment) : new EquipmentResource($equipment);
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
    public function update(Request $request, Equipment $equipment)
    {
        if(Auth::user()->id !== $equipment->user_id){
            return $this->error('','You are not Authorized to make request',403);
        }

        $equipment->update($request->all());

        return new EquipmentResource($equipment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment){
        return $this->isNotAuthorized($equipment) ? $this->isNotAuthorized($equipment) : $equipment -> delete();
    }

    private function isNotAuthorized($equipment){
         
        if(Auth::user()->id !== $equipment->user_id){
            return $this->error('','You are not Authorized to make request',403);
        }
    }
}
