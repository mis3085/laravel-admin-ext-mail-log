<?php

return [
    'title' => 'Mail Logs',
    'attrs' => [
        'sent_at'   => 'Sent At',
        'recipient' => 'Recipient',
        'subject'   => 'Subject',
        'status'    => 'Status',
        'raw'       => 'Raw Body',
    ],

    'statuses' => [
        'starting' => 'Starting',
        'queued'   => 'Queued',
        'sent'     => 'Sent',
        'failed'   => 'Failed',
    ],

    'status-colors' => [
        'starting' => 'default',
        'queued'   => 'info',
        'sent'     => 'success',
        'failed'   => 'danger',
    ],
];
