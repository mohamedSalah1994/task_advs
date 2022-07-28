<?php

namespace App\Http\Controllers;

use App\Models\Advertiser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdvertisersController extends Controller
{

    public function index()
    {
        $advertisers = Advertiser::select('name' , 'email' , 'created_at' , 'updated_at')->get();

        return response()->json([
            "success" => true,
            "message" => "all advertisers",
            "data" => $advertisers
        ]);
    }  // end index

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $advertiser = Advertiser::create($input);
        return response()->json([
            "success" => true,
            "message" => "Advertiser created successfully.",
            "data" => $advertiser
        ]);
    } //end store


    public function show($id)
    {
        $advertiser = Advertiser::find($id);
        if (is_null($advertiser)) {
            return $this->sendError('Advertiser not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Advertiser retrieved successfully.",
            "data" => $advertiser
        ]);
    } // end show

    public function update(Request $request, Advertiser $advertiser)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $advertiser->name = $input['name'];
        $advertiser->email = $input['email'];
        $advertiser->save();
        return response()->json([
            "success" => true,
            "message" => "Advertiser updated successfully.",
            "data" => $advertiser
        ]);
    } // end update


    public function destroy(Advertiser $advertiser)
    {
        $advertiser->delete();
        return response()->json([
            "success" => true,
            "message" => "Advertiser deleted successfully.",
            "data" => $advertiser
        ]);
    } // end destroy
}
