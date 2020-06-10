<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    public $fillable = [
        'number',
        'comments',
        'status',
        'expediente_id',
        'date',
    ];
    protected $dates = ['date', 'next_date'];

    public function status()
    {
        switch ($this->status) {
            case 0:
                return 'Paciente vendrá';

                break;
            case 1:
                return 'Paciente no vendrá';

                break;
            case 2:
                return __('Otro');

                break;
            default:
                // code...
                break;
        }
    }

    public function expediente()
    {
        return $this->belongsTo('App\Expediente');
    }
}
