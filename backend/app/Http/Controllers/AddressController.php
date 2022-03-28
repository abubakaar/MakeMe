<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Address::paginate(10);
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
        $addressData = $this->getValidationFactory()->make($request->all(), [
            'customer_id' => 'required|numeric',
            'address' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'country' => 'required|string',

        ]);
        if (!$addressData->fails()) {
            $address = new Address();
            $address->persist($addressData->validated());
            return $this->sendResponse($addressData->validated(), 'Data Saved Successfully.');
        } else {
            return $this->sendError('Unsuccessful', $addressData->getMessageBag(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Address $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Address $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Address $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {

        $addressData = $this->getValidationFactory()->make($request->all(), [
            'customer_id' => 'required|numeric',
            'address' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string',
            'country' => 'required|string',
        ]);
        if (!$addressData->fails()) {
            $address->persist($addressData->validated());
            return $this->sendResponse($addressData->validated(), 'Data Saved Successfully.');
        } else {
            return $this->sendError('Unsuccessful', $addressData->getMessageBag(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Address $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();
        return $this->sendResponse($address, 'Data Deleted Successfully.');
    }
}
