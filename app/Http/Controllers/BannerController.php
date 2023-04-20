<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();

        return response()->json($banners, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return $request;

        $request->validate([
            'info*.title' => 'required|unique:banners|min:3|max:255',
            'cover_img' => 'mimes:jpg,jpeg,png|max:3048',
            'info*.status' => 'required|in:active,inactive',
            'info*.type' => 'required',
            'info*.desc' => 'required',


        ]);
        // return $request;

        $banner_data = json_decode($request->info);
        // $banner_data = $request;



        $file_banner = $request->file('cover_img');
        $filename_banner = uniqid() . '.' . $file_banner->extension();
        $file_banner->storeAs('public/images/banner', $filename_banner);

        $banner = Banner::create([
            'title' => $banner_data->title,
            'cover_img' => env('APP_URL') . Storage::url('public/images/banner/' . $filename_banner),
            'status' => $banner_data->status,
            'type' => $banner_data->type,
            'desc' => $banner_data->desc,
        ]);

        $response = [
            "status" => true,
            "message" => "Banner Added Successfully",
            "banner" => $banner
        ];
        // Response if banner added successfully
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
        //`
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = Banner::find($id);

        if (!$banner) {
            return response()->json(["message" => "Banner not found"], 404);
        }

        return response()->json($banner, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;

        $request->validate([
            'title' => 'required|unique:banners|min:3|max:255',
            'cover_img' => 'mimes:jpg,jpeg,png|max:3048',
            'status' => 'required|in:active,inactive',
            'type' => 'required',
            'desc' => 'required',
        ]);

        // if($request->has(file('cover_img'))){
        // $file_banner = $request->file('cover_img');
        // $filename_banner = uniqid().'.'.$file_banner->extension();
        // $file_banner->storeAs('public/images/banner', $filename_banner);
        //  };

        $banner = Banner::find($id);
        $banner->title = $request->title ? $request->title : $banner->title;
        $banner->status = $request->status ? $request->status : $banner->status;
        // $banner->cover_img= env('APP_URL'). Storage::url('public/images/banner/'.$filename_banner);
        $banner->desc = $request->desc ? $request->desc : $banner->desc;
        $banner->type = $request->type ? $request->type : $banner->type;

        $banner->update();


        $errResponse = [
            "status" => false,
            "message" => "Update error"
        ];

        if (!$banner) {
            return response()->json($errResponse, 404);
        }

        $successResponse = [
            "status" => true,
            "message" => "Successfully Updated"
        ];

        return response()->json($successResponse, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        if (!$banner) {
            return response()->json(["message" => "Banner not found"], 404);
        }
        $banner->delete();
        $successResponse = ["message" => "Banner deleted successfully"];
        return response()->json($successResponse, 200);
    }
}
