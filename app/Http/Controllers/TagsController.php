<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::select('name' , 'created_at' , 'updated_at')->get();

        return response()->json([
            "success" => true,
            "message" => "all tags",
            "data" => $tags
        ]);
    }  // end index

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $tag = Tag::create($input);
        return response()->json([
            "success" => true,
            "message" => "Tag created successfully.",
            "data" => $tag
        ]);
    } //end store


    public function show($id)
    {
        $tag = Tag::find($id);
        if (is_null($tag)) {
            return $this->sendError('tag not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Tag retrieved successfully.",
            "data" => $tag
        ]);
    } // end show

    public function update(Request $request, Tag $tag)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $tag->name = $input['name'];
        $tag->save();
        return response()->json([
            "success" => true,
            "message" => "Tag updated successfully.",
            "data" => $tag
        ]);
    } // end update


    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json([
            "success" => true,
            "message" => "tag deleted successfully.",
            "data" => $tag
        ]);
    } // end destroy 
}
