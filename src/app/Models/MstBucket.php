<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstBucket extends Model
{
    use HasFactory;
    protected $table = 'mst_bucket';
    #タイムスタンプを無効にする
    public $timestamps = false;

    // バケットリストを新規で作成する
    public function createBucket($bucket_name, $bucket_detail, $publish_flg = 0){
        $sql = "
            INSERT INTO mst_bucket (bucket_name, bucket_detail, publish_flg, create_date, update_date)
            VALUES (?, ?, ?, ?)
        ";
        $params = [
            $bucket_name,
            $bucket_detail,
            now()->toDateTimeString(),
            now()->toDateTimeString()
        ];
        $res = DB::insert($sql, $params);
        //作成したバケットのIDを返却
        return $res;
    }

    
}
