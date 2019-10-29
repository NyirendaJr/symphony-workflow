<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'slug', 'path'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'video_statuses_id');
    }
}
