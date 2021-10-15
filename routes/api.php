<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('uploadFile', function (Request $request) {
    try {
        if ($request->hasFile('File')) {
            $fileName = md5(uniqid() . \Carbon\Carbon::now()) . '.' . strtolower($request->file('File')->getClientOriginalExtension());
            //dd($request->op);
            $path = $request->file('File')->storeAs('documents', $fileName, 'public');

            $data = array(
                'success' => true,
                'data' => $fileName,
                'msg' => trans('messages.file_uplodaded')
            );
        } else {
            $data = array(
                'success' => false,
                'data' => null,
                'msg' => 'Error al guardar archivo.'
            );
        }
    } catch (\Exception $e) {
        $data = array(
            'success' => false,
            'data' => null,
            'msg' => $e->getMessage()
        );
    }
    return response()->json($data);
})->name('utils.uploadFile');

