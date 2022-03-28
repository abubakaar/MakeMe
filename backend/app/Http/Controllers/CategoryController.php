<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  Category::paginate(10);
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
        $categoryData = $this->getValidationFactory()->make($request->all(), [
            'name' => 'required'
        ]);
        if (!$categoryData->fails()) {
            $category = new Category();
            $category->persist($categoryData->validated());
            return $this->sendResponse($categoryData->validated(), 'Data Saved Successfully.');
        } else {
            return $this->sendError('Unsuccessful', $categoryData->getMessageBag(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $category->with('items.itemImages')->paginate(10);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $categoryData = $this->getValidationFactory()->make($request->all(), [
            'name' => 'required'
        ]);
        if (!$categoryData->fails()) {
            $category->persist($categoryData->validated());
            return $this->sendResponse($categoryData->validated(), 'Data Saved Successfully.');
        } else {
            return $this->sendError('Unsuccessful', $categoryData->getMessageBag(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->sendResponse($category, 'Data Deleted Successfully.');
    }
}
