<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductTestController extends Controller
{
    public function add(Request $request){

        // return $request->rate;

        // $request->validate([
        //     'name' => 'required|unique:products,name'
        // ]);

        $product = Product::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'category_id'=> $request->category_id,
            'image' => 'image.png'
        ]);

        foreach($request->attribute as $row){
            $new_attribute[] = [
                "product_id" => $product->id,
                "attribute" => $row['attribute'],
                "value" => $row['value']
            ];
        }

        foreach($request->rate as $price){
            $new_rate[] = [
                "product_id" => $product->id,
                "from" => $price['from'],
                "to" => $price['to'],
                "normal" => $price['normal'],
                "urgent" => $price['urgent'],
                "discount" => $price['discount']
            ];
        }

        $product->attribute()->insert($new_attribute);
        $product->rate()->insert($new_rate);

        $status = [
            'success' =>true,
            'message' => "Add Sucess"
        ];

        return response($status,201);


    }
}

// return $request->attributes;

//         $request-> validate([
//         'image' => 'mimes:jpg,jpeg,png|max:5048',
//         ]);

//         return $request;
//         // $image=$request->image;

//         $product_data = $request;



//         $product_data= json_decode($request->props);
//         // if (!$image) {

//         $file_product = $request->file('image');
//         $filename = uniqid() . '.' . $file_product->extension();
//         $file_product->storeAs('public/images/product', $filename);
//         // }
//         $product=Product::create([
//                 'name' => $product_data->name,
//                 // 'image' =>env('APP_URL').Storage::url('public/images/product/'.$filename),
//                 'desc' => $product_data->desc,
//                 'category_id'=> $product_data->category_id,
//         ]);

//         // foreach{}
//         // $product->attribute()->insert($request->attribute());
//         // $product->()->insert($request->attribute());



//         $response = [
//             "status" => true,
//             "message" => "Product Added Successfully",
//             "data"=> $product
//         ];

//         return $response;
