<?php

namespace App\Http\Controllers;

use App\Actions\SendMailjet;
use App\Campaign;
use App\Expediente;
use App\Http\Requests\CampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::paginate(20);

        return view('campaigns.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campaigns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CampaignRequest $request)
    {
        $validated = $request->validated();
        Campaign::create($validated);

        return redirect()->route('campaigns.create')->withStatus(__('Campaña registrada exitosamente.'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        $expediente_ids = DB::table('emails')->where('campaign_id', $campaign->id)->pluck('expediente_id')->toArray();

        //dd($expediente_ids);

        $sentExpedientes = DB::table('expedientes')->whereIn('id', $expediente_ids)->get();

        $notSentExpedientes = DB::table('expedientes')->where('email', '!=', 'PENDIENTE')->whereNotNull('email')->whereNotIn('id', $expediente_ids)->get();

        return view('campaigns.show', compact(['campaign', 'sentExpedientes', 'notSentExpedientes']));
    }

    public function send(Request $request)
    {
        $expedientes = Expediente::whereIn('id', $request->input('expedientes'))->get();

        $campaign = Campaign::findOrFail($request->campaign_id);

        $user_id = $request->user()->id;

        $mailjet = new SendMailjet();
        $mailjet->sendEmail($campaign, $expedientes, $user_id);

        return redirect()->route('campaigns.show', [$campaign])->withStatus(__('Campaña enviada exitosamente.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        return view('campaigns.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCampaignRequest $request, Campaign $campaign)
    {
        $validated = $request->validated();

        $campaign->fill($validated);
        $campaign->save();

        return redirect()->route('campaigns.edit', compact('campaigns'))
            ->withStatus(__('Campaña modificada exitosamente.'))
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
    }
}