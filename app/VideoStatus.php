<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoStatus extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
