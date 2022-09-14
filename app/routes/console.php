<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('test', function (\App\Services\AntMediaService $antMediaService) {
    dd(
        $antMediaService->getBroadcast(
            new \App\Http\DataTransferObjects\AntMediaBroadcastDTO(
                streamId: '128048524860355234609108'
            )
        )
    );
});
