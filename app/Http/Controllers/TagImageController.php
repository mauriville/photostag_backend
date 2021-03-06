<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\TagImage;
use App\Http\Requests\TagImageRequest;

class TagImageController extends Controller
{

    public function list(Request $request)
    {
        $item = new TagImage();
        $objeto = null;
        $objeto = $item->whereNull('deleted_at')->get();

        $data = array(
            'success' => true,
            'data' => $objeto,
            'msg' => trans('messages.listed')
        );

        return response()->json($data);
    }

    public function show(Request $request)
    {
        $item = TagImage::where($request->id)->with('Tag', 'Image')->first();
        $data = array(
            'success' => true,
            'data' => $item,
            'msg' => trans('messages.listed')
        );
        return response()->json($data);
    }

    public function store(TagImageRequest $request)
    {

        $item = TagImage::where('Tag',$request->Tag)
            ->where('Image',$request->Image)
            ->first();
        if (!isset($item)) {

            $item = new TagImage();
            $item->Tag = $request->Tag;
            $item->Image = $request->Image;

        }else{
            $item->deleted_at=null;
        }
        $msg = trans('messages.added');
        $item->save();

        $result = array(
            'success' => true,
            'data' => $item,
            'msg' => $msg
        );
        return response()->json($result);
    }

    public function destroy(Request $request)
    {
        $item = TagImage::where('Tag',$request->Tag)
            ->where('Image',$request->Image)
            ->first();
        $item->deleted_at = Carbon::now();
        $item->save();
        $result = array(
            'success' => true,
            'data' => null,
            'msg' => trans('messages.deleted')
        );

        return response()->json($result);
    }
}
