<?php

namespace App\Http\Controllers;

use App\Company;
use App\Traits\ResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
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
        $companies = Company::with(['services','folios'])->get();
        return $this->successResponse($companies, Response::HTTP_OK);
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
            'title' => 'unique:companies|required',
        ];

        $validateData = Validator::make($request->all(), $rules);

        if ($validateData->fails()) {

            return $validateData->errors();
        }

        try {

            $company = Company::create([
                'title' => $request->title,
            ]);

            return $this->successResponse($company, Response::HTTP_CREATED);

        } catch (QueryException $exception) {

            return $exception;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Company $company
     * @return \Illuminate\Http\Response
     */
    public function show($company)
    {
        //
        $company = Company::with(['services.imageServices','folios.imageFolios'])->findOrFail($company);
        return $this->successResponse($company, Response::HTTP_OK);


    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $company = Company::findOrFail($id);
        $company->title = $request->title;
        $company->save();
        return $this->successResponse($company, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Company $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($company)
    {
        //
        $company = Company::findOrFail($company);
        $company->delete();
        return $this->successResponse($company, Response::HTTP_OK);
    }
}
