<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\TagImageController;
use App\Http\Controllers\TagController;
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


/****************************************** Image *********************************/
Route::group(['prefix' => 'Image', 'middleware' => 'guest'], function () {
    Route::get('/list', [ImageController::class, 'list'])->name('Image.list');
    Route::get('/index', [ImageController::class, 'index'])->name('Image.index');
    Route::post('/destroy', [ImageController::class, 'destroy'])->name('Image.destroy');
    Route::post('/store', [ImageController::class, 'store'])->name('Image.store');
    Route::get('/show', [ImageController::class, 'show'])->name('Image.show');
});


/****************************************** Tag *********************************/
Route::group(['prefix' => 'Tag', 'middleware' => 'guest'], function () {
    Route::get('/list', [TagController::class, 'list'])->name('Tag.list');
    Route::get('/index', [TagController::class, 'index'])->name('Tag.index');
    Route::post('/destroy', [TagController::class, 'destroy'])->name('Tag.destroy');
    Route::post('/store', [TagController::class, 'store'])->name('Tag.store');
    Route::get('/show', [TagController::class, 'show'])->name('Tag.show');
});

/****************************************** TagImage *********************************/
Route::group(['prefix' => 'TagImage', 'middleware' => 'guest'], function () {
    Route::get('/list', [TagImageController::class, 'list'])->name('TagImage.list');
    Route::post('/destroy', [TagImageController::class, 'destroy'])->name('TagImage.destroy');
    Route::post('/store', [TagImageController::class, 'store'])->name('TagImage.store');
    Route::get('/show', [TagImageController::class, 'show'])->name('TagImage.show');
});