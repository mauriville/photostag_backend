<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use App\Models\Image;
use App\Http\Requests\ImageRequest;

class ImageController extends Controller
{
    //
    public function index()
    {
        $item = Image::select('id', 'Title', 'ImageUrl', 'ThumbnailUrl')->whereNull('deleted_at');

        return Datatables::of($item)
            ->addIndexColumn()
            ->addColumn('action', function ($p) {
                return '<button class="btn btn-info btn-xs btn-datatable-Image" id="' . $p->id . '"><i class="fa fa-bars"></i> ' . 'Detalles' . '</button> &nbsp;';
            })
            ->editColumn('id', '{{$id}}')
            ->make(true);
    }

    public function list(Request $request)
    {
        $item = new Image();
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
        try {
            $item = Image::findOrFail($request->id);
            $data = array(
                'success' => true,
                'data' => $item,
                'msg' => trans('messages.listed')
            );
        } catch (\Exception $e) {
            $data = array(
                'success' => false,
                'data' => null,
                'msg' => trans('mesagges.error')
            );
        } finally {
            return response()->json($data);
        }
    }

    public function store(ImageRequest $request)
    {
        if ($request->id) {
            $item = Image::findOrFail($request->id);
            $msg = trans('messages.updated');
        } else {
            $item = new Image();
            $msg = trans('messages.added');
        }

        $item->Tittle = $request->Tittle;
        $item->ImageUrl = $request->ImageUrl;
        $item->ThumbnailUrl = $request->ThumbnailUrl;

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
        $item = Image::where('id', $request->id)->first();
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
