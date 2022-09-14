<?php

use App\Services\AntMediaService;

beforeEach(function () {
    $this->antMediaService = app(AntMediaService::class);
});

it('logins to antmedia api correctly', function () {
    dd(
        $this->antMediaService->createBroadcast(
            new \App\Http\DataTransferObjects\AntMediaBroadcastDTO(
                (new \App\Http\DataTransferObjects\StreamDTO(
                    \App\Models\Stream::first()->toArray()
                ))->only(
                    'name', 'description'
                )->toArray() + [
                    'type' => 'liveStream'
                ]
            )
        )
    );
});
