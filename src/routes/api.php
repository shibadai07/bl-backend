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
    Route::post('/buckets/get-my-bucketlist', [BucketListController::class, 'getMyBucketList']);
    //新規でバケットリストを作成するAPI
    Route::post('/buckets/add-my-bucket', [BucketListController::class, 'addMyBucket']);
    //バケットリストを新規で作成+追加するAPI
    Route::post('/buckets/create-new-bucket', [BucketListController::class, 'createNewBucket']);
});