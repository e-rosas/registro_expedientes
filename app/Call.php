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
    protected $dates = ['date'];

    public function status()
    {
        switch ($this->status) {
            case 0:
                return __('En proceso');

                break;
            case 1:
                return __('Deducibles');

                break;
            case 2:
                return __('Negada por cargos no cubiertos');

                break;
            case 3:
                return __('Pagada');

                break;
            case 4:
                return __('Negada por cobro no llenado');

                break;
            case 5:
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
