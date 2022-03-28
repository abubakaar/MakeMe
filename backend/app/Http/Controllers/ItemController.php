<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  Item::with("itemImages")->paginate(10);
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
        $itemData = $this->getValidationFactory()->make($request->all(), [
            'category_id' => 'required',
            'customer_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'location' => 'required',
            'is_sold' => 'required|boolean',
            'at_ducan' => 'required|boolean'

        ]);
        if (!$itemData->fails()) {
            $item = new Item();
            $item->persist($itemData->validated());
            return $this->sendResponse($itemData->validated(), 'Data Saved Successfully.');
        } else {
            return $this->sendError('Unsuccessful', $itemData->getMessageBag(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Item $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Item $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Item $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $itemData = $this->getValidationFactory()->make($request->all(), [
            'category_id' => 'required',
            'customer_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'location' => 'required',
            'is_sold' => 'required|boolean',
            'at_ducan' => 'required|boolean'

        ]);
        if (!$itemData->fails()) {
            $item->persist($itemData->validated());
            return $this->sendResponse($itemData->validated(), 'Data Saved Successfully.');
        } else {
            return $this->sendError('Unsuccessful', $itemData->getMessageBag(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Item $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return $this->sendResponse($item, 'Data Deleted Successfully.');
    }

    public function getItemByCategoryId($id){
        $data =  Item::where("category_id",$id)->with('itemImages')->paginate(5);
        return $this->sendResponse($data, 'request Successfull.');
    }
}
