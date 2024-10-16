<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Utilities\FileHandler;
use App\Utilities\SimpleCRUD;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // ! faltan los request en esta clase

    public $crud;

    public function __construct()
    {
        $this->crud = new SimpleCRUD(new Product);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        return $this->crud->index(ProductResource::class, $request->pagination);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        return $this->crud->store(
            FileHandler::handleSingleFileUpload($request, 'image_uri'),
            null
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        return $this->crud->update(
            FileHandler::handleSingleFileUpload($request, 'image_uri'),
            $id,
            null
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        return $this->crud->destroy($id);
    }
}
