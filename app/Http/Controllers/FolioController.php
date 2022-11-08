<?php

namespace App\Http\Controllers;

use App\Folio;
use App\Service;
use App\Traits\ResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class FolioController extends Controller
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

        $services = Folio::with('company')->get();
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
                $file->storeAs('/public/folios', $newName);
            }

            $folio = Folio::create([

                'company_id' => $request->company_id,
                'title' => $request->title,
                'thumbnail_path' => $newName ?? null,
                'description' => $request->description,
                'video_url' => $request->video_url,
                'client' => $request->client,
                'web_url' => $request->web_url,

            ]);


            return $this->successResponse($folio, Response::HTTP_CREATED);


        } catch (QueryException $exception) {
            return $exception;
        }

    }


    /**
     * Display the specified resource.
     *
     * @param \App\Folio $folio
     * @return \Illuminate\Http\Response
     */
    public function show($folio)
    {
        //
        $folio = Folio::with('imageFolios')->findOrFail($folio);

        return $this->successResponse($folio, Response::HTTP_OK);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Folio $folio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $folio)
    {
        //
        $folio = Folio::findOrFail($folio);
        $folio->company_id = $request->company_id;
        $folio->title = $request->title;


        if ($request->hasFile('thumbnail_path')) {

            $file = $request->file('thumbnail_path');
            $extension = $file->getClientOriginalExtension();

            $newName = md5(microtime()) . time() . '.' . $extension;
            $file->storeAs('/public/folios', $newName);

            $folio->thumbnail_path = $newName;
        }


        $folio->description = $request->description;
        $folio->client = $request->client;
        $folio->video_url = $request->video_url;
        $folio->web_url = $request->web_url;
        $folio->save();
        return $this->successResponse($folio, Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Folio $folio
     * @return \Illuminate\Http\Response
     */
    public function destroy($folio)
    {
        //
        $folio = Folio::findOrFail($folio);
        $folio->delete();
        return $this->successResponse($folio, Response::HTTP_OK);
    }
}
