<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        return view('expedientes.index', ['expedientes' => Expediente::paginate(15)]);
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
        $validated['destroyed'] = 1;
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

    public function listView()
    {
        $end = Carbon::today()->addDay();
        $start = Carbon::today()->subWeeks(2);
        $expedientes = $this->getExpedientes($start, $end);

        return view('expedientes.lista', compact('expedientes', 'start', 'end'));
    }

    public function list(Request $request)
    {
        $start = new Carbon($request['start_date']);
        $end = new Carbon($request['end_date']);

        $expedientes = $this->getExpedientes($start, $end);

        return view('expedientes.lista', compact('expedientes', 'start', 'end'));
    }

    private function calculateYearDifference($year)
    {
        $now = Carbon::today();

        return $now->year - $year;
    }

    private function getExpedientes($start, $end)
    {
        return Expediente::whereBetween('updated_at', [$start, $end])
            ->where('destroyed', 1)
            ->get()
        ;
    }
}
