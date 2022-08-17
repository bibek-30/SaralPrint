<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\productRequest;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ProductRequest $request)
    {
        $request-> validate([
        'image' => 'required|mimes:jpg,jpeg,png|max:5048',
    ]);

        // return $request;


        $product_data= json_decode($request->props);
        $file_product = $request->file('image');
        $filename = uniqid() . '.' . $file_product->extension();
        $file_product->storeAs('public/images/product', $filename);

        Product::create([
            'name' => $product_data->name,
            'image' => $filename,
            'desc' => $product_data->desc,
            'category_id'=> $product_data->category_id,
        ]);

        $response = [
            "status" => true,
            "message" => "Product Added Successfully",

        ];

        return $response;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(["message" => "Product not found"], 404);
        }

        return response()->json($product, 200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }


    public function categories($id)
        {
            $category = Category::with('products')->find($id);
            return response()->json($category, 200);

        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(productRequest $request, $id)
    {


            $product = Product::find($id);
            $product->update();

            $errResponse = [
                "status" => false,
                "message" => "Update error"
            ];

            if (!$product) {
                return response()->json($errResponse, 404);
            }

            $successResponse = [
                "status" => true,
                "message" => "Updated Successfully"
            ];

            return response()->json($successResponse, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(["message" => "Invalid"], 404);
        }
        $product->delete();
        $successResponse = ["message" => "User deleted successfully"];
        return response()->json($successResponse, 200);
    }
}
