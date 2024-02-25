<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MstBucket;
use App\Models\TblUserBucket;
use Illuminate\Support\Facades\Log;


class BucketListController extends Controller
{
    // Myバケットリストを一覧を取得する
    public function getMyBucketList(Request $request)
    {
        log::info('getMyBucketList');
        //postのリクエストボディからuser_idを取得
        $user_id = $request->input('user_id');
        //user_idを元にバケットリストを取得
        $tblUserBucket = new \App\Models\TblUserBucket();
        $bucketList = $tblUserBucket->getMyBucketList($user_id);
        //取得したバケットリストを返却
        return response()->json($bucketList);
    }

    // バケットを追加する
    public function addMyBucket(Request $request)
    {
        //postのリクエストボディからuser_idとbucket_idを取得
        $user_id = $request->input('user_id');
        $bucket_id = $request->input('bucket_id');
        $bucket_id = $request->input('status_id');
        //user_idとbucket_idを元にバケットを追加
        $tblUserBucket = new \App\Models\TblUserBucket();
        $tblUserBucket->addMyBucket($user_id, $bucket_id);
        //追加したバケットを返却
        return response()->json(['result' => $res]);
    }

    // バケットリストを新規で作成する
    public function createNewBucket(Request $request)
    {
        //postのリクエストボディからバケット名、バケット詳細、公開フラグを取得
        $bucket_name = $request->input('bucket_name');
        $bucket_detail = $request->input('bucket_detail');
        $publish_flg = $request->input('publish_flg');

        //createBucket実行
        $mstBucket = new \App\Models\MstBucket();
        $bucket_id = $mstBucket->createBucket($bucket_name, $bucket_detail, $publish_flg);

        //自分のバケットにも追加
        $tblUserBucket = new \App\Models\TblUserBucket();
        $tblUserBucket->addMyBucket($user_id, $bucket_id);

        //作成したバケットを返却
        return response()->json(['result' => $res]);
    }

    // バケットリストを削除する
    public function deleteMyBucket(Request $request)
    {
        //postのリクエストボディからuser_idとbucket_idを取得
        $user_id = $request->input('user_id');
        $bucket_id = $request->input('bucket_id');
        //user_idとbucket_idを元にバケットリストを削除
        $tblUserBucket = new \App\Models\TblUserBucket();
        $res = $tblUserBucket->deleteMyBucket($user_id, $bucket_id);
        //削除したバケットを返却
        return response()->json(['result' => $res]);
    }
}
