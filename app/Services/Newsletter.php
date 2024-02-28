<?php

namespace App\Services;
use MailchimpMarketing\ApiClient;

class Newsletter
{
    public function subscribe(string $email,string $list = null)
    {
        $mailchimp = new ApiClient();

        $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us18',
        ]);
        $list ??= config('services.mailchimp.lists.subscribers');

        return $mailchimp->lists->addListMember($list,[
            "email_address" => $email,
            "status" => "subscribed",
        ]);
    }
}
