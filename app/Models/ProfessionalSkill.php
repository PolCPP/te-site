<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalSkill extends Model
{
    public $timestamps = false;

    public static $rules = array(
            'name' => 'required|unique:professional_skills',
            'language_code' => 'required',
    );

    public function students()
    {
        return $this->belongsToMany('\App\Models\Student');
    }
}