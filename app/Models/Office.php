<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;
    protected $fillable = [
        'office_name',
        'office_address',
        'office_phone',
    ];

    public function colleaguesCount(){
       return $this->hasMany(MyColleague::class)->count();
    }
    public function colleagues(){
       return $this->hasMany(MyColleague::class);
    }
}
