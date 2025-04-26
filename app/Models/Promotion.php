<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $guarded=[];

    // علاقة بين الطلاب والترقيات لجلب اسم الطالب في جدول الطلاب

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

    // علاقة بين الترقيات والمراحل الدراسية لجلب اسم المرحلة في جدول الترقيات

    public function f_grade()
    {
        return $this->belongsTo('App\Models\Grade', 'from_grade');
    }


    // علاقة بين الترقيات والصفوف الدراسية لجلب اسم الصف في جدول الترقيات

    public function f_classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'from_Classroom');
    }

    // علاقة بين الترقيات والاقسام الدراسية لجلب اسم القسم  في جدول الترقيات

    public function f_section()
    {
        return $this->belongsTo('App\Models\Section', 'from_section');
    }

    // علاقة بين الترقيات والمراحل الدراسية لجلب اسم المرحلة في جدول الترقيات

    public function t_grade()
    {
        return $this->belongsTo('App\Models\Grade', 'to_grade');
    }


    // علاقة بين الترقيات والصفوف الدراسية لجلب اسم الصف في جدول الترقيات

    public function t_classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'to_Classroom');
    }

    // علاقة بين الترقيات والاقسام الدراسية لجلب اسم القسم  في جدول الترقيات

    public function t_section()
    {
        return $this->belongsTo('App\Models\Section', 'to_section');
    }
}
