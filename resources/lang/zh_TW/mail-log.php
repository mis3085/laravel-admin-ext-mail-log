<?php

return [
    'title' => '郵件紀錄',
    'attrs' => [
        'sent_at'   => '發送時間',
        'recipient' => '收信人',
        'subject'   => '主旨',
        'status'    => '狀態',
        'raw'       => '原始內容',
    ],

    'statuses' => [
        'starting' => '啟動中',
        'queued'   => '已佇列',
        'sent'     => '已發送',
        'failed'   => '已失敗',
    ],

    'status-colors' => [
        'starting' => 'default',
        'queued'   => 'info',
        'sent'     => 'success',
        'failed'   => 'danger',
    ],
];
