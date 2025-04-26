<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class My_Parent extends Model
{
    use HasTranslations;
    public $translatable = ['Name_Father','Job_Father','Name_Mother','Job_Mother'];
    protected $table = 'my__parents';
    protected $guarded=[];

    // // علاقة بين اولياء والصور لجلب اسم الصور  في جدول الاولياء
    // public function images()
    // {
    //     return $this->morphMany('App\Models\Image', 'imageable');
    // }
}
