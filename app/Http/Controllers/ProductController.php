<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProductResource;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        return ProductResource::collection(
            Product::where('user_id', Auth::user()->id)->get()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request){

       $request -> validated($request->all());
       $field = Field::all()->random()->id;

       $product = Product::create([
            'field_id' => $field,
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'quantity' => $request->quantity
        ]);

         return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product){
        return $this->isNotAuthorized($product) ? $this->isNotAuthorized($product) : new ProductResource($product);
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
    public function update(Request $request, Product $product) {
        
        if(Auth::user()->id !== $product->user_id){
            return $this->error('','You are not Authorized to make request',403);
        }

        $product->update($request->all());

        return new ProductResource($product);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        return $this->isNotAuthorized($product) ? $this->isNotAuthorized($product) : $product -> delete();
    }

    // Authorization function
    private function isNotAuthorized($product){
         
        if(Auth::user()->id !== $product->user_id){
            return $this->error('','You are not Authorized to make request',403);
        }
    }
}
