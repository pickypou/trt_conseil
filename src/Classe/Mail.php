<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private $api_key = 'd6c38877a0a2ab8049e4f1fbc1280163';
    private $api_key_secret = 'fdb96431db31422b622a7cd5aa6a0330';

    public function mailUserValidated($to_email, $to_name, $subject, $content)
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
    public function mailValidatedAnnonce($to_email, $to_name, $subject, $content)
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
                    'TemplateID' => 4816043,
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


    public function sendWithAttachment($to_email, $to_name, $subject, $content, $attachmentPath, $attachmentFilename)
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
                    'Subject' => $subject,
                    'TextPart' => $content,
                    'Attachments' => [
                        [
                            'ContentType' => 'application/pdf',
                            'Filename' => $attachmentFilename,
                            'Base64Content' => base64_encode(file_get_contents($attachmentPath))
                        ]
                    ]
                ]
            ]
        ];

        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success();
    }


    public function mailCandidatedRecruteur($to_email, $to_name, $subject, $content)
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
                    'TemplateID' => 4373649,
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

    public function mailUserCandidacy($to_email, $to_name, $subject, $content)
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
                    'TemplateID' => 4816004,
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
