<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SubCategory::paginate(10);
        return $this->sendResponse($data, 'Successful');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $this->getValidationFactory()->make($request->all(), [
            'category_id' => 'required',
            'name' => 'required'
        ]);

        $category = Category::findOrFail($request->get('category_id'))->get();

        if (!$data->fails() && $category) {
            $subCategory = new SubCategory();
            $subCategory->persist($data->validated());
            return $this->sendResponse($data->validated(), 'Data Saved Successfully.');
        } else {
            return $this->sendError('Unsuccessful', $data->getMessageBag(), 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\SubCategory $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\SubCategory $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SubCategory $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $data = $this->getValidationFactory()->make($request->all(), [
            'category_id' => 'required',
            'name' => 'required'
        ]);
        if (!$data->fails()) {
            $newData = $request->only("name");
            $subCategory->persist($newData);
            return $this->sendResponse($data->validate(), 'Data Updated Successfully.');
        } else {
            return $this->sendError('Bad Request', [$data->errors()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SubCategory $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return $this->sendResponse($subCategory, 'Data Deleted Successfully.');
    }
}
