<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Item_images;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use function Illuminate\Support\Facades\Validator;

class ItemImagesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Item_images::paginate(10);
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

        $imageData = $this->getValidationFactory()->make($request->all(), [
            'item_id' => 'required|Numeric',
            'image' => 'required'
        ]);
        $item = Item::findOrFail($request->get('item_id'));

        if (!$imageData->fails() && $item) {
            $image = new Item_images();
//            Extracting image Url and saving in file
            $img = $request->input('image');
            $img = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));
            $png_url = "itemImage-" . time() . ".jpg";
            file_put_contents(public_path('mobiles/') . $png_url, $img);
            $data['image'] = "mobiles/".$png_url;
//            Saving path in DB
            $image->persist($data);
//            adding Item id Relation
            $item->itemImages()->save($image);

            return $this->sendResponse($imageData->validated(), 'Data Saved Successfully.');
        } else {
            return $this->sendError('Bad Request', $imageData->errors(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Item_images $item_images
     * @return \Illuminate\Http\Response
     */
    public function show(Item_images $item_images)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Item_images $item_images
     * @return \Illuminate\Http\Response
     */
    public function edit(Item_images $item_images)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Item_images $item_images
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item_images $item_images)
    {
        $imageData = $this->getValidationFactory()->make($request->all(), [
            'item_id' => 'required|Numeric',
            'image' => 'required'
        ]);
        if (!$imageData->fails()) {
            $item_images->persist($imageData->validate());
            return $this->sendResponse($imageData->validate(), 'Data Updated Successfully.');
        } else {
            return $this->sendError('Bad Request', [$imageData->errors()], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Item_images $item_images
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item_images $item_images)
    {
        $item_images->delete();
        return $this->sendResponse($item_images, 'Data Deleted Successfully.');

    }
}
