<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use Illuminate\Http\Request;

class ExpertController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  Expert::paginate(10);
        return $this->sendResponse($data, 'Successful');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expertData = $this->getValidationFactory()->make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:customers',
            'password' => 'required',
            'rating' => 'required|numeric',
            'phone_number' => 'required|numeric'

        ]);
        if (!$expertData->fails()) {
            $expert = new Expert();
            $expertData->validated()['password'] = bcrypt($expertData->validated()['password']);
            $expert->persist($expertData->validated());
            return $this->sendResponse($expertData->validated(), 'Data Saved Successfully.');
        } else {
            return $this->sendError('Unsuccessful', $expertData->getMessageBag(), 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Expert $expert
     * @return \Illuminate\Http\Response
     */
    public function show(Expert $expert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Expert $expert
     * @return \Illuminate\Http\Response
     */
    public function edit(Expert $expert)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Expert $expert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expert $expert)
    {
        $expertData = $this->getValidationFactory()->make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:customers',
            'password' => 'required',
            'rating' => 'required|numeric',
            'phone_number' => 'required|numeric'

        ]);
        if (!$expertData->fails()) {
            $expert->persist($expertData->validated());
            return $this->sendResponse($expertData->validated(), 'Data Saved Successfully.');
        } else {
            return $this->sendError('Unsuccessful', $expertData->getMessageBag(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Expert $expert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expert $expert)
    {
        $expert->delete();
        return $this->sendResponse($expert, 'Data Deleted Successfully.');
    }
}
