<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\GuestUser;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductCustomization;
use App\Utilities\SimpleCRUD;
use App\Utilities\SimpleJSONResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $crud;

    public function __construct()
    {
        $this->crud = new SimpleCRUD(new Order);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        return $this->crud->index(OrderResource::class, $request->pagination);
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
        return $this->crud->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return $this->crud->show($id);
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
        return $this->crud->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        return $this->crud->destroy($id);
    }

    // ! propoenso a errores
    public function orderAll(Request $request)
    {
        $products = json_decode($request->products, true);
        $order = new Order();
        $guestUser = new GuestUser();

        // crear el registro del usuario
        $guestUser->first_name = $request->first_name;
        $guestUser->last_name = $request->last_name;
        $guestUser->email = $request->email;
        $guestUser->phone_number = $request->phone_number;
        $guestUser->secondary_phone_number = $request->secondary_phone_number;
        $guestUser->date_of_birth = $request->date_of_birth;
        $guestUser->save();

        // crear el registro del estado
        $order->order_status_id = 1;
        $order->guest_user_id = $guestUser->id;
        $order->save();

        foreach ($products as $product) {
            // formato de los inputs
            $productInputId = 'product-file-' . $product['id'];
            // saber si hay un id de customization del producto
            $productCustomizationId = -1;

            // guardar la imagen si encuentra los inputs de tipo file
            if ($request->hasFile($productInputId)) {
                $fileName = time() . '.' . $request->$productInputId->extension();
                $request->$productInputId->storeAs('public/images', $fileName);

                // crear el registro de customization del producto
                $productCustomization = new ProductCustomization();
                $productCustomization->image_uri = $fileName;
                $productCustomization->save();
                // indicar que el producto tiene una customizacion
                $productCustomizationId = $productCustomization->id;
            }

            // crear el registro de  order_details
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $product['id'];
            if ($productCustomizationId !== -1)
                $orderDetail->product_customization_id = $productCustomizationId;
            $orderDetail->quantity = $product['quantity'];
            $orderDetail->save();
        }
        return SimpleJSONResponse::successResponse(
            null,
            'Registros creados exitosamente',
            200
        );
    }
}
