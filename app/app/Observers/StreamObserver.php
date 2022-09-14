<?php

namespace App\Observers;

use App\Models\Stream;
use App\Services\AntMediaService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Storage;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class StreamObserver
{
    /**
     * @throws UnknownProperties
     * @throws GuzzleException
     */
    public function created(Stream $stream): void
    {
        $this->createBroadcast(
            $stream,
            app(AntMediaService::class)
        );
    }

    /**
     * @throws UnknownProperties
     * @throws GuzzleException
     */
    public function deleted(Stream $stream): void
    {
        $stream->refresh();
        $this->deleteBroadcast(
            $stream,
            app(AntMediaService::class)
        );
        $this->deletePreview($stream);
    }

    public function updated(Stream $stream): void
    {
        $this->deleteOldPreview($stream);
    }

    private function deletePreview(Stream $stream): void
    {
        if (empty($stream->preview))
            return;
        Storage::disk('local')->delete($stream->preview);
    }

    private function deleteOldPreview(Stream $stream): void
    {
        if (
            empty($stream->getOriginal('preview')) ||
            $stream->preview == $stream->getOriginal('preview')
        )
            return;
        Storage::disk('local')->delete($stream->getOriginal('preview'));
    }

    /**
     * @param Stream $stream
     * @throws GuzzleException
     * @throws UnknownProperties
     */
    public function retrieved(Stream $stream): void
    {
        $this->updateStatus(
            $stream,
            app(AntMediaService::class)
        );
    }

    /**
     * @param Stream $stream
     * @param AntMediaService $antMediaService
     * @throws GuzzleException
     * @throws UnknownProperties
     */
    private function updateStatus(Stream $stream, AntMediaService $antMediaService): void
    {
        if (empty($stream->stream_id))
            return;
        $antMediaBroadcastDTO = $antMediaService->getBroadcast(
            new \App\Http\DataTransferObjects\AntMediaBroadcastDTO(
                streamId: $stream->stream_id
            )
        );
        if (empty($antMediaBroadcastDTO->status))
            return;
        $stream->status = $antMediaBroadcastDTO->status;
        $stream->save();
    }

    /**
     * @param Stream $stream
     * @param AntMediaService $antMediaService
     * @return void
     * @throws GuzzleException
     * @throws UnknownProperties
     */
    private function createBroadcast(Stream $stream, AntMediaService $antMediaService): void
    {
        if ($stream->stream_id)
            return;
        $streamDTO = (new \App\Http\DataTransferObjects\StreamDTO(
            $stream->toArray()
        ))->only(
            'name', 'description', 'stream_id'
        );
        $res = $antMediaService->createBroadcast(
            new \App\Http\DataTransferObjects\AntMediaBroadcastDTO(
                type: 'liveStream',
                name: $streamDTO->name,
                description: $streamDTO->description,
                streamId: $streamDTO->stream_id
            )
        );
        $stream->stream_id = $res->streamId;
        $stream->save();
    }

    /**
     * @throws UnknownProperties
     * @throws GuzzleException
     */
    private function deleteBroadcast(Stream $stream, AntMediaService $antMediaService): void
    {
        if (empty($stream->stream_id))
            return;
        $streamDTO = (new \App\Http\DataTransferObjects\StreamDTO(
            $stream->toArray()
        ))->only(
            'stream_id'
        );
        $antMediaService->deleteBroadcast(
            new \App\Http\DataTransferObjects\AntMediaBroadcastDTO(
                streamId: $streamDTO->stream_id
            )
        );
    }
}
