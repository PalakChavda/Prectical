<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'blog';
    public $timestamps = true;

    protected $fillable = [
        'name', 'detail', 'user_id','status'
    ];

    protected $dates = ['created_at','updated_at','deleted_at'];

}
