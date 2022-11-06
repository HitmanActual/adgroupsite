<?php

namespace App\Http\Controllers;

use App\ImageService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ImageServiceController extends Controller
{

    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return 'hii';
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
        $rules = [
            'service_id'=>'required',
            'image_path'=>'required',
        ];

        $validateData = Validator::make($request->all(), $rules);

        if ($validateData->fails()) {

            return $validateData->errors();
        }


        if($request->hasFile('image_path')){

            foreach ($request->image_path as $file){

                $fileName = $file->getClientOriginalExtension();
                $newName = md5(microtime()) . time() . '.' . $fileName;
                $file->storeAs('/public/services', $newName);

                $imageService = ImageService::create([
                    'service_id'=>$request->service_id,
                    'image_path'=>$newName,
                ]);
            }

            return $this->successResponse($imageService, Response::HTTP_CREATED);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ImageService  $imageService
     * @return \Illuminate\Http\Response
     */
    public function show(ImageService $imageService)
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImageService  $imageService
     * @return \Illuminate\Http\Response
     */
    public function edit(ImageService $imageService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ImageService  $imageService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImageService $imageService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImageService  $imageService
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageService $imageService)
    {
        //
    }
}
