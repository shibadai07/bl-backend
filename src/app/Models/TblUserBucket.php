<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblUserBucket extends Model
{
    use HasFactory;
    protected $table = 'tbl_user_bucket';
    
    public function addMyBucket(){
        $tbl_user_bucket = new TblUserBucket;
        $tbl_user_bucket->user_id = $request['user_id'];
        $tbl_user_bucket->bucket_bucket_id = $request['bucket_id'];
        $tbl_user_bucket->status_id = $request['status_id'];
        $tbl_user_bucket->create_date = now()->toDateTimeString();
        $tbl_user_bucket->update_date = now()->toDateTimeString()
        $tbl_user_bucket->timestamps = false;
        $tbl_user_bucket->save();
    }


}
