<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCAtegoryRequest;
use App\Http\Resources\ProductCategoryCollection;
use App\Http\Resources\ProductCategoryResource;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $queryData = ProductCategory::all();
            $formatedData = new ProductCategoryCollection($queryData);
            return response() ->json([
                "message" => "success",
                "data" => $formatedData
            ],200);
        } catch (Exception $e){
            return response()->json($e->getMessage(),400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request)
    {
        $validatedRequest = $request->validated();
        try{
        $queryData = ProductCategory::create($validatedRequest);
        $formatedData = new ProductCategoryResource($queryData);

        return response() ->json([
                "message" => "success",
                "data" => $formatedData
            ],200);
        } catch (Exception $e){
            return response()->json($e->getMessage(),400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $queryData = ProductCategory::findOrFail($id);
            $formatedData = new ProductCategoryResource($queryData);
            return response() ->json([
                "message" => "success",
                "data" => $formatedData
            ],200);
        } catch (Exception $e){
            return response()->json($e->getMessage(),400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCAtegoryRequest $request, string $id)
    {
        $validatedRequest = $request->validated();
         try{
            $queryData = ProductCategory::findOrFail($id);
            $queryData->update($validatedRequest);
            $queryData->save();
            $formatedData = new ProductCategoryResource($queryData);
            return response() ->json([
                "message" => "success",
                "data" => $formatedData
            ],200);
        } catch (Exception $e){
            return response()->json($e->getMessage(),400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $queryData = ProductCategory::findOrFail($id);
            $queryData->delete();
            $formatedData = new ProductCategoryResource($queryData);
            return response() ->json([
                "message" => "success",
                "data" => $formatedData
            ],200);
        } catch (Exception $e){
            return response()->json($e->getMessage(),400);
        }
    }
}
