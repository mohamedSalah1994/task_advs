<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Adv;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdvsController extends Controller
{
    public function index()
    {
        $adv = Adv::all();
        return response()->json([
            "success" => true,
            "message" => "advertise List",
            "data" => $adv
        ]);
    } // end index

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'type' => 'required',
            'title' => 'required',
            'description' => 'required|min:5',
            'advertiser_email' => 'required',
            'cat_id' => 'required',
            'tag_id' => 'required',
            'start_date' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $adv = Adv::create($input);
        return response()->json([
            "success" => true,
            "message" => "Advertise created successfully.",
            "data" => $adv
        ]);
    } // end store

    public function show($id)
    {
        $adv = Adv::find($id);
        if (is_null($adv)) {
            return $this->sendError('Advertise not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Advertise retrieved successfully.",
            "data" => $adv
        ]);
    } //end show

    public function update(Request $request, Adv $adv)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'type' => 'required',
            'title' => 'required',
            'description' => 'required|min:5',
            'advertiser_email' => 'required',
            'cat_id' => 'required',
            'tag_id' => 'required',
            'start_date' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $adv->type = $input['type'];
        $adv->title = $input['title'];
        $adv->description = $input['description'];
        $adv->advertiser_email = $input['advertiser_email'];
        $adv->cat_id = $input['cat_id'];
        $adv->tag_id = $input['tag_id'];
        $adv->start_date = $input['start_date'];
        $adv->save();
        return response()->json([
            "success" => true,
            "message" => "Advertise updated successfully.",
            "data" => $adv
        ]);
    } //end update

    public function destroy(Adv $adv)
    {
        $adv->delete();
        return response()->json([
            "success" => true,
            "message" => "Advertise deleted successfully.",
            "data" => $adv
        ]);
    } //end destroy

    public function getByCategory($id)

    {
        
        $advs = Adv::with('category')->where('cat_id' , $id)->get();
        return response()->json([
            "success" => true,
            "message" => "Advertise list.",
            "data" => $advs
        ]);

    } //end getByCategory

    public function getByTag($id)

    {
        
        $advs = Adv::with('tag')->where('tag_id' , $id)->get();
        return response()->json([
            "success" => true,
            "message" => "Advertise list.",
            "data" => $advs
        ]);

    } //end getByCategory


}
