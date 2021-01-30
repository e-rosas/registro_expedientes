<?php

namespace App\Actions;

use App\Campaign;
use App\Email;
use Carbon\Carbon;
use Mailjet\LaravelMailjet\Facades\Mailjet;
use Mailjet\Resources;

class SendMailjet
{
    public function sendEmail(Campaign $campaign, $expedientes, $user_id)
    {
        $recipients = [];
        for ($i = 0; $i < count($expedientes); ++$i) {
            $e = new Email();
            $e->campaign_id = $campaign->id;
            $e->expediente_id = $expedientes[$i]->id;
            $e->user_id = $user_id;
            $e->date = Carbon::now();
            $e->save();

            $r = ['Email' => $expedientes[$i]->email];
            $recipients[] = $r;
        }
        $mj = Mailjet::getClient();
        $body = [
            'FromEmail' => env('MAIL_FROM_ADDRESS'),
            'FromName' => env('MAIL_FROM_NAME'),
            'Subject' => $campaign->name,
            'MJ-TemplateID' => $campaign->template,
            'MJ-TemplateLanguage' => true,
            'Recipients' => $recipients,
            'Vars' => json_decode('{"greeting": "TEST2"}', true),
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());
    }
}