<?php

use Illuminate\Support\Facades\Route;
use Mis3085\MailLog\Http\Controllers\MailgunController;

Route::group([
    'prefix'        => 'webhooks/mailgun',
    'middleware'    => 'api',
    'as'            => 'webhooks.mailgun.',
], function () {
    Route::post('delivered', [MailgunController::class, 'delivered'])->name('delivered');
    Route::post('failed', [MailgunController::class, 'failed'])->name('failed');
});
