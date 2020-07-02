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
        $list = [];
        $count = count($this->expedientes);
        $rows = 0;
        for ($i = 0; $i < $count; $i += 3) {
            $r = $i % 3;
            while ($r < 3) {
                $name = $this->expedientes[$i + $r]->full_name ?? '';
                if (!empty($name)) {
                    $list[$rows][$r] = $i + $r + 1 .'. '.$name;
                } else {
                    $list[$rows][$r] = '';
                }
                ++$r;
            }
            ++$rows;
        }
        view()->share([
            'list' => $list,
        ]);
        $pdf = BarryPDF::loadView('pdf.list');

        return $pdf->download('expedientes.pdf');
    }
}