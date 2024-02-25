<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class TblUserBucket extends Model
{
    use HasFactory;
    // 接続するdb
    protected $connection = 'mysql';
    #タイムスタンプを無効にする
    public $timestamps = false;
    #テーブル名を指定
    protected $table = 'tbl_user_bucket';
    
    // ユーザーのバケットリストを取得する
    public function getMyBucketList($user_id){
        $bucketList = DB::select("
            SELECT 
                ub.my_bucket_id,
                ub.user_id,
                ub.bucket_id,
                ub.status_id,
                ub.publish_flg,
                ub.create_date,
                ub.update_date,
                mb.bucket_id,
                mb.bucket_name,
                mb.bucket_detail
            FROM tbl_user_bucket as ub
            INNER JOIN mst_bucket as mb ON ub.bucket_id = mb.bucket_id
            WHERE ub.user_id = ?
            LIMIT 100", [$user_id]);

        return $bucketList;
    }

    public function addMyBucket($user_id, $bucket_id, $status_id = 0){
        try {
            $sql = "
                INSERT INTO tbl_user_bucket (user_id, bucket_id, status_id, create_date, update_date)
                VALUES (?, ?, ?, ?, ?)
            ";
            $params = [
                $user_id,
                $bucket_id,
                $status_id,
                now()->toDateTimeString(),
                now()->toDateTimeString()
            ];
            DB::insert($sql, $params);
            
            return true;
        } catch (Exception $e) {
            Log::error($e);
            return false;
        }
    }


    // バケットリストを削除する
    public function deleteMyBucket($user_id, $bucket_id){
        try {
            $sql = "
                DELETE FROM tbl_user_bucket
                WHERE user_id = ? AND bucket_id = ?
            ";
            $params = [
                $user_id,
                $bucket_id
            ];
            DB::delete($sql, $params);
            return true;
        } catch (Exception $e) {
            Log::error($e);
            return false;
        }
    }


}
