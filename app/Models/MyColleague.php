<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class MyColleague extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'office_id',
        'colleague_name',
        'colleague_address',
        'colleague_mobile',
    ];

    protected static function boot(){
        parent::boot();

        self::creating(function($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
