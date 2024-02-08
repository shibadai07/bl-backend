<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MstBucket;

class BucketListController extends Controller
{
    public function getBucketList()
    {
        // バケットリスト一覧を取得
        $bucketList = MstBucket::all();

        return response()->json(['bucketlist' => $bucketList], 200);
    }

    public function store(Request $request)
    {
        // // バリデーションを適用する場合は、必要に応じて追加してください
        // $validatedData = $request->validate([
        //     'bucket_name' => 'required|max:50',
        //     'bucket_detail' => 'required|max:200',
        //     // 他のフィールドに対するバリデーションも追加する
        // ]);

        // データベースに新しいバケットを挿入
        $bucket = new MstBucket;
        $bucket->bucket_name = $request['bucket_name'];
        $bucket->bucket_detail = $request['bucket_detail'] ?? null;
        $bucket->create_date = now()->toDateTimeString();
        $bucket->create_user = "shibadai";
        $bucket->update_date = now()->toDateTimeString();
        $bucket->update_user = "shibadai";
        $bucket->timestamps = false;
        $bucket->save();

        return response()->json(['message' => 'Bucket created successfully'], 201);
    }
}
