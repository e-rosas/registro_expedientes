<?php

namespace App\Http\Controllers;

use App\Call;
use App\Http\Requests\CallRequest;
use App\Http\Requests\UpdateCallRequest;
use App\Http\Resources\CallResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CallController extends Controller
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
        if (!empty($request['start'] && !empty($request['end']))) {
            $start = Carbon::parse($request->start);
            $end = Carbon::parse($request->end);
        } else {
            $end = Carbon::today()->addDay();
            $start = Carbon::today()->subMonths(3);
        }

        if (is_null($request['search'])) {
            $search = '';
        } else {
            $search = $request['search'];
        }
        if (is_null($request['status'])) {
            $status = 6;
        } else {
            $status = $request['status'];
        }

        if ($status < 6) {
            $calls = Call::with('expediente')
                ->where('status', $status)
                ->whereBetween('date', [$start, $end])
                ->whereLike(['number', 'expediente.full_name', 'comments'], $search)
                ->orderBy('date', 'desc')
                ->paginate($perPage)
        ;
        } else {
            $calls = Call::with('expediente')
                ->whereBetween('date', [$start, $end])
                ->whereLike(['number', 'expediente.full_name', 'comments'], $search)
                ->orderBy('date', 'desc')
                ->paginate($perPage)
        ;
        }

        return view('calls.index', compact('calls', 'search', 'perPage', 'status', 'end', 'start'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CallRequest $request)
    {
        $validated = $request->validated();
        $call = new Call();
        $call->status = $validated['status'];
        if (0 == $validated['status']) {
            $call->next_date = $validated['next_date'];
        }
        $call->number = 'C'.$validated['expediente_id'].'-'.rand(1, 1000);
        $call->comments = $validated['comments'];
        $call->date = $validated['date'];
        $call->expediente_id = $validated['expediente_id'];
        $call->user_id = Auth::user()->id;
        $call->save();

        return $this->expedienteCalls($request->expediente_id);
    }

    public function find(Request $request)
    {
        $call = Call::findOrFail($request->id);

        CallResource::withoutWrapping();

        return new CallResource($call);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Call $call)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Call $call)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCallRequest $request)
    {
        $validated = $request->validated();
        $id = $request->id;

        $call = Call::findOrFail($id);
        $call->fill($validated);
        $call->save();

        return $this->expedienteCalls($call->expediente_id);
    }

    public function delete(Request $request)
    {
        $call = Call::findOrFail($request['call_id']);
        $expediente_id = $call->expediente_id;
        $call->delete();

        return $this->expedienteCalls($expediente_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Call $call)
    {
    }

    private function expedienteCalls($expediente_id)
    {
        $calls = Call::where('expediente_id', $expediente_id)
            ->orderBy('date', 'desc')
            ->get()
        ;

        return CallResource::collection($calls);
    }
}