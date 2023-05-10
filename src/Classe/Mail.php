<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private $api_key = 'd6c38877a0a2ab8049e4f1fbc1280163';
    private $api_key_secret = 'fdb96431db31422b622a7cd5aa6a0330';

    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new Client($this->api_key, $this->api_key_secret, true, ['version' => 'v3.1']);

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "ludo.spysschaert@orange.fr",
                        'Name' => "TRT"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 3958411,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'content' => $content,
                    ]
                ]
            ]
        ];

        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success();
    }
}
