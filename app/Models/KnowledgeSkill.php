<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KnowledgeSkill extends Model
{
    public $timestamps = false;

    public static $rules = array(
            'name' => 'required',
    );
}
