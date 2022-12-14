<?php

namespace App\Http\Controllers;

use App\Page;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class PageController extends Controller
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
        $services = Page::all();
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
                $file->storeAs('/public/pages', $newName);
            }

            $page = Page::create([

                'section' => $request->section,
                'title' => $request->title,
                'thumbnail_path' => $newName ?? null,
                'description' => $request->description,
                'video_url' => $request->video_url,
                'subtitle' => $request->subtitle,
            ]);


            return $this->successResponse($page, Response::HTTP_CREATED);


        } catch (QueryException $exception) {
            return $exception;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Page $page
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $page = Page::findOrFail($id);
        return $this->successResponse($page, Response::HTTP_OK);


    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $page)
    {
        //
        $page = Page::findOrFail($page);
        $page->section = $request->section;
        $page->title = $request->title;
        $page->subtitle = $request->subtitle;


        if ($request->hasFile('thumbnail_path')) {

            $file = $request->file('thumbnail_path');
            $extension = $file->getClientOriginalExtension();

            $newName = md5(microtime()) . time() . '.' . $extension;
            $file->storeAs('/public/pages', $newName);

            $page->thumbnail_path = $newName;
        }


        $page->description = $request->description;

        $page->video_url = $request->video_url;

        $page->save();
        return $this->successResponse($page, Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Page $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($page)
    {
        $page = Page::findOrFail($page);
        $page->delete();
        return $this->successResponse($page, Response::HTTP_OK);
    }
}
