<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;
    public $fillable = [
        'comments',
        'campaign_id',
        'expediente_id',
        'date',
        'user_id',
    ];
    protected $dates = ['date'];

    public function expediente()
    {
        return $this->belongsTo('App\Expediente');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }
}