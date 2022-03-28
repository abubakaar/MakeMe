<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  Customer::paginate(10);
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
        $customerData = $this->getValidationFactory()->make($request->all(), [
            'name' => 'required|string',
            'rating' => 'required|numeric',
            'email' => 'required|email|unique:customers',
            'password' => 'required',
            'verified_at' => 'required',
            'phone_no' => 'required|numeric'

        ]);

        if (!$customerData->fails()) {
            $customer = new Customer();
            $customerData->validated()['password'] = bcrypt($customerData->validated()['password']);
            $customer->persist($customerData->validated());
            return $this->sendResponse($customerData->validated(), 'Data Saved Successfully.');
        } else {
            return $this->sendError('Unsuccessful', $customerData->getMessageBag(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customerData = $this->getValidationFactory()->make($request->all(), [
            'name' => 'required|string',
            'rating' => 'required|numeric',
            'email' => 'required|email|unique:customers',
            'password' => 'required',
            'verified_at' => 'required',
            'phone_no' => 'required|numeric'

        ]);
        if (!$customerData->fails()) {
            $customer->persist($customerData->validated());
            return $this->sendResponse($customerData->validated(), 'Data Updated Successfully.');
        } else {
            return $this->sendError('Unsuccessful', $customerData->getMessageBag(), 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return $this->sendResponse($customer, 'Data Deleted Successfully.');

    }
}
