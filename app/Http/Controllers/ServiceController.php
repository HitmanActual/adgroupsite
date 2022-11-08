<?php

namespace App\Http\Controllers;

use App\Service;
use App\Traits\ResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
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

        $services = Service::all();
        return $this->successResponse($services, Response::HTTP_OK);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


        $rules = [
            'company_id' => 'required',
            'title' => 'required',

        ];

        $validateData = Validator::make($request->all(), $rules);

        if ($validateData->fails()) {

            return $validateData->errors();
        }

        try {


            if ($request->hasFile('thumbnail_path')) {

                $file = $request->file('thumbnail_path');
                $extension = $file->getClientOriginalExtension();

                $newName = md5(microtime()) . time() . '.' . $extension;
                $file->storeAs('/public/services', $newName);
            }

            $service = Service::create([

                'company_id' => $request->company_id,
                'title' => $request->title,
                'thumbnail_path' => $newName ?? null,
                'description' => $request->description,
                'video_url' => $request->video_url,
            ]);


            return $this->successResponse($service, Response::HTTP_CREATED);


        } catch (QueryException $exception) {
            return $exception;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Service $service
     * @return \Illuminate\Http\Response
     */
    public function show($service)
    {
        //
        $service = Service::with('imageServices')->findOrFail($service);

        return $this->successResponse($service, Response::HTTP_OK);


    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Service $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $service)
    {
        //
        $service = Service::findOrFail($service);
        $service->company_id = $request->company_id;
        $service->title = $request->title;


        if ($request->hasFile('thumbnail_path')) {

            $file = $request->file('thumbnail_path');
            $extension = $file->getClientOriginalExtension();

            $newName = md5(microtime()) . time() . '.' . $extension;
            $file->storeAs('/public/services', $newName);

            $service->thumbnail_path = $newName;
        }


        $service->description = $request->description;

        $service->video_url = $request->video_url;

        $service->save();
        return $this->successResponse($service, Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Service $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($service)
    {
        //
        $service = Service::findOrFail($service);
        $service->delete();
        return $this->successResponse($service, Response::HTTP_OK);
    }
}
