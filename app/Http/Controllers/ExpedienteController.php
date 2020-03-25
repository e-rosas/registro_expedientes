<?php

namespace App\Http\Controllers;

use App\Expediente;
use App\Http\Requests\ExpedienteRequest;
use App\Http\Requests\UpdateExpedienteRequest;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpedienteRequest $request)
    {
        $validados = $request->validated();
        if (!isset($request['insured'])) {
            $validados['insured'] = 0;
        } else {
            $validados['insured'] = 1;
        }

        if (!isset($request['destroyed'])) {
            $validados['destroyed'] = 0;
        } else {
            $validados['destroyed'] = 1;
        }

        Expediente::create($validados);

        return redirect()->route('expedientes.index')->withStatus(__('Expediente registrado exitosamente.'));
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
     * @param  \App\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function show(Expediente $expediente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function edit(Expediente $expediente)
    {
        return view('expedientes.edit', compact('expediente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpedienteRequest $request, Expediente $expediente)
    {
        $validated = $request->validated();
        if (!isset($request['insured'])) {
            $validated['insured'] = 0;
        } else {
            $validated['insured'] = 1;
        }

        if (!isset($request['destroyed'])) {
            $validated['destroyed'] = 0;
        } else {
            $validated['destroyed'] = 1;
        }
        $expediente->fill($validated);
        $expediente->save();

        return redirect()->route('expedientes.edit', compact('expediente'))
            ->withStatus(__('Expediente modificado exitosamente.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expediente  $expediente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expediente $expediente)
    {
        $expediente->delete();

        return redirect()->route('expedientes.index')
            ->withStatus(__('Expediente eliminado exitosamente.'));
    }
}
