<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BucketListController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    //マイバケットリスト一覧を取得するAPI
    Route::get('/get-bucketlist', [BucketListController::class, 'getBucketList']);
    //新規でバケットリストを作成するAPI
    Route::post('/store-new-bucket', [BucketListController::class, 'storeNewBucket']);
});