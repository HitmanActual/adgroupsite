<?php

namespace App\Http\Controllers;
use App\Traits\ResponseTrait;
use App\Demo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class DemoController extends Controller
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
        $demos = Demo::all();
        return $this->successResponse($demos, Response::HTTP_OK);
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
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'company_name' => 'required',
            'message' => 'required',
            'service_id'=>'required',
        ];

        $validateData = Validator::make($request->all(), $rules);

        if ($validateData->fails()) {

            return $validateData->errors();
        }


        $demo = Demo::create([


            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'company_name'=>$request->company_name,
            'message'=>$request->message,
            'demo_date'=>$request->demo_date,
            'service_id'=>$request->service_id,

        ]);

        return $this->successResponse($demo, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Demo  $demo
     * @return \Illuminate\Http\Response
     */
    public function show(Demo $demo)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Demo  $demo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demo $demo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Demo  $demo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demo $demo)
    {
        //
    }
}
