<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use App\Models\Tag;
use App\Http\Requests\TagRequest;

class TagController extends Controller
{
    //
    public function index()
    {
        $item = Tag::select('id', 'Label')->whereNull('deleted_at');

        return Datatables::of($item)
            ->addIndexColumn()
            ->addColumn('action', function ($p) {
                return '<button class="btn btn-info btn-xs btn-datatable-Tag" id="' . $p->id . '"><i class="fa fa-bars"></i> ' . 'Detalles' . '</button> &nbsp;';
            })
            ->editColumn('id', '{{$id}}')
            ->make(true);
    }

    public function list(Request $request)
    {
        $item = new Tag();
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
            $item = Tag::findOrFail($request->id);
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

    public function store(TagRequest $request)
    {
        if ($request->id) {
            $item = Tag::findOrFail($request->id);
            $msg = trans('messages.updated');
        } else {
            $item = new Tag();
            $msg = trans('messages.added');
        }

        $item->Label = $request->Label;

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
        $item = Tag::where('id', $request->id)->first();
        $item->deleted_at = Carbon::now();
        $item->save();
        $result = array(
            'success' => true,
            'data' => null,
            'msg' => trans('messages.deleted')
        );

        return response()->json($result);
    }

    public function select2(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return response()->json([]);
        }

        $items = Tag::where('Label', 'ilike', '%' . $term . '%')
            ->limit(250);

        $items = $items->get();

        $result = array(
            'success' => true,
            'items' => $items,
        );

       return response()->json($result);

    }

}
