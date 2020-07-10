<?php

namespace App\Http\Controllers;

use App\Actions\PreparePDF;
use App\Expediente;
use App\Http\Requests\ExpedienteRequest;
use App\Http\Requests\UpdateExpedienteRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!is_null($request->perPage)) {
            $perPage = $request->perPage;
        } else {
            $perPage = 15;
        }
        if (is_null($request['search'])) {
            $search = '';
        } else {
            $search = $request->search;
        }

        if (is_null($request['insured'])) {
            $insured = 2;
        } else {
            $insured = $request['insured'];
        }

        if ($insured < 2) {
            $expedientes = Expediente::with('calls')->whereLike(['full_name', 'comments'], $search)->where('insured', $insured)
                ->orderBy('full_name', 'ASC')
                ->paginate($perPage)
            ;
        } else {
            $expedientes = Expediente::with('calls')->whereLike(['full_name', 'comments'], $search)
                ->orderBy('full_name', 'ASC')
                ->paginate($perPage)
            ;
        }

        return view('expedientes.index', compact('expedientes', 'perPage', 'search', 'insured'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expedientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ExpedienteRequest $request)
    {
        $validated = $request->validated();
        $validated['insured'] = 'on' == $request->insured ? 1 : 0;
        $validated['destroyed'] = 0;
        $validated['destroyed_at'] = Carbon::today();
        $validated['year_difference'] = $this->calculateYearDifference($validated['year']);

        Expediente::create($validated);

        return redirect()->route('expedientes.create')->withStatus(__('Expediente registrado exitosamente.'));
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $expedientes = Expediente::whereLike(['full_name', 'comments'], $search)
            ->paginate(10)
        ;

        return view('expedientes.index', compact('expedientes'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Expediente $expediente)
    {
        $expediente->load('calls');
        $today = Carbon::today();

        return view('expedientes.show', compact(['expediente', 'today']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Expediente $expediente)
    {
        return view('expedientes.edit', compact('expediente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpedienteRequest $request, Expediente $expediente)
    {
        $validated = $request->validated();
        $validated['year_difference'] = $this->calculateYearDifference($validated['year']);
        $expediente->fill($validated);
        $expediente->save();

        return redirect()->route('expedientes.edit', compact('expediente'))
            ->withStatus(__('Expediente modificado exitosamente.'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expediente $expediente)
    {
        $expediente->delete();

        return redirect()->route('expedientes.index')
            ->withStatus(__('Expediente eliminado exitosamente.'))
        ;
    }

    /* public function listView()
    {
        $end = Carbon::today()->addDay();
        $start = Carbon::today()->subWeeks(2);
        $expedientes = $this->getExpedientes($start, $end);

        return view('expedientes.lista', compact('expedientes', 'start', 'end'));
    } */

    public function list(Request $request)
    {
        if (!empty($request['start'] && !empty($request['end']))) {
            $start = Carbon::parse($request->start);
            $end = Carbon::parse($request->end);
        } else {
            $end = Carbon::today()->addDay();
            $start = Carbon::today()->subMonths(3);
        }

        if (!is_null($request->id)) {
            $id = $request->id;
        } else {
            $id = 0;
        }

        $expedientes = $this->getExpedientes($start, $end, $id); //>2750

        return view('expedientes.lista', compact('expedientes', 'start', 'end', 'id'));
    }

    public function destroyList(Request $request)
    {
        $start = new Carbon($request['start']);
        $end = new Carbon($request['end']);

        if (!is_null($request->id)) {
            $id = $request->id;
        } else {
            $id = 0;
        }

        $expedientes = $this->getExpedientes($start, $end, $id);

        $pdf = new PreparePDF($expedientes);

        $today = Carbon::today();

        foreach ($expedientes as $expediente) {
            $expediente->destroyed = 1;
            $expediente->destroyed_at = $today;

            $expediente->save();
        }

        return $pdf->list();

        return redirect()->route('expedientes.index')->withStatus(__('Expedientes marcados como destruidos exitosamente.'));
    }

    private function calculateYearDifference($year)
    {
        $now = Carbon::today();

        return $now->year - $year;
    }

    private function getExpedientes($start, $end, $id)
    {
        return Expediente::whereBetween('created_at', [$start, $end])->where('id', '>=', $id)
            ->orderBy('full_name', 'ASC')
            ->get()
        ;
    }
}