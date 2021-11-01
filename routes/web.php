<?php

use Illuminate\Support\Facades\Route;
use Mis3085\MailLog\Http\Controllers\MailLogController;

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix').'.',
], function () {
    Route::resource('mail-logs', MailLogController::class)->only([
        'index',
        'show',
    ]);
});
