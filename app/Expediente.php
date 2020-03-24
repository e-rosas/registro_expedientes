<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    public $fillable = [
        'full_name',
        'birth_date',
        'phone_number',
        'email',
        'insured',
        'first_consultation_date',
        'last_consultation_date',
        'comments',
        'destroyed'
    ];
    /**
    * The attributes that should be casted to native types.
    *
    * @var array
    */
    protected $casts = [
        'id' => 'integer',
        'full_name' => 'string',
        'comments' => 'string',
        'phone_number' => 'string',
        'email' => 'string',
        'insured' => 'boolean',
        'destroyed' => 'boolean',
    ];
    protected $dates = [
        'birth_date',
        'created_at',
        'updated_at',
        'first_consultation_date',
        'last_consultation_date',
    ];
}
