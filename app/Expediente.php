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
        'address',
        'year',
        'year_difference',
        'comments',
        'destroyed',
        'insured',
        'destroyed_at',
    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'year' => 'integer',
        'year_difference' => 'integer',
        'full_name' => 'string',
        'address' => 'string',
        'comments' => 'string',
        'phone_number' => 'string',
        'email' => 'string',
        'destroyed' => 'boolean',
        'insured' => 'boolean',
    ];
    protected $dates = [
        'birth_date',
        'created_at',
        'updated_at',
        'destroyed_at',
    ];

    public function diferencia()
    {
        return $this->year_difference.' '.'años';
    }

    public function destruido()
    {
        if ($this->destroyed) {
            return 'Si';
        }

        return 'No';
    }

    public function calls()
    {
        return $this->hasMany('App\Call');
    }

    public function emails()
    {
        return $this->hasMany('App\Email');
    }
}