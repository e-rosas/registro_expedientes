<?php

namespace App\Actions;

use Barryvdh\DomPDF\Facade as BarryPDF;
use Illuminate\Database\Eloquent\Collection;

class PreparePDF
{
    public $expedientes;

    public function __construct(Collection $expedientes)
    {
        $this->expedientes = $expedientes;
    }

    public function list()
    {
        view()->share([
            'expedientes' => $this->expedientes,
        ]);

        dd($this->expedientes);

        $list = BarryPDF::loadView('pdf.list');

        return $list->download('expedientes.pdf');
    }
}