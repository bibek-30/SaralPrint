<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;


use function PHPSTORM_META\type;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:products,name',
            'image' => 'mimes:jpg,jpeg,png|max:5048',
        ]);

        $file_product = $request->file('image');
        $filename = uniqid() . '.' . $file_product->extension();
        $file_product->storeAs('public/images/product', $filename);

        $product = Product::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'image' =>env('APP_URL').Storage::url('public/images/product/'.$filename),
            // 'category_id'=> $request->category_id,
        ]);

        foreach($request->attribute as $row){
            $new_attribute[] = [
                "product_id" => $product->id,
                "attribute" => $row['attribute'],
                "value" => $row['value']
            ];
        }

        $product->attribute()->insert($new_attribute);

        $status = [
            'success' =>true,
            'message' => "Add Sucess"
        ];

        return response($status,201);


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
    public function show(Request $request, $id)
    {
        $product = Product::with('rateList','attribute')->find($id);
        // return $product;

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


    // public function cart($cart){
    //     return $cart;
    // }


    // public function addToCart($id)
    // {
    //     $product = Product::find($id);
    //     if(!$product) {
    //         abort(404);
    //     }
    //     $cart = session()->get('Cart');

    //     // if cart is empty then this the first product
    //     if(!$cart) {
    //         $cart = [
    //                 $id => [
    //                     "name" => $product->name,
    //                     "quantity" => 1,
    //                     "price" => $product->price,
    //                     "photo" => $product->photo
    //                 ]
    //         ];
    //         session()->put('cart', $cart);
    //         return response($cart,200);
    //         // return redirect()->back()->with('success', 'Product added to cart successfully!');
    //     }
    //     // if cart not empty then check if this product exist then increment quantity
    //     if(isset($cart[$id])) {
    //         $cart[$id]['quantity']++;
    //         session()->put('cart', $cart);
    //         return response('success');

    //         // return redirect()->back()->with('success', 'Product added to cart successfully!');
    //     }
    //     // if item not exist in cart then add to cart with quantity = 1
    //     $cart[$id] = [
    //         "name" => $product->name,
    //         "quantity" => 1,
    //         "price" => $product->price,
    //         "photo" => $product->photo
    //     ];
    //     session()->put('cart', $cart);
    //     return response('Sucess');
    //     // return redirect()->back()->with('success', 'Product added to cart successfully!');

    // }

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
    public function update(Request $request, $id)
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
