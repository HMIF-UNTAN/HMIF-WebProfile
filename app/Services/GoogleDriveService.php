<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;

class GoogleDriveService
{
    public function create()
    {
        $client = new Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect_uri'));
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');
        $client->addScope(Drive::DRIVE);
        return $client;
    }

    public function drive($token)
    {
        $client = $this->create();
        $client->setAccessToken($token);
        return new Drive($client);
    }
}
