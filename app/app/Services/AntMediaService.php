<?php

namespace App\Services;

use App\Http\DataTransferObjects\AntMediaBroadcastDTO;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AntMediaService
{
    private string $apiEndpoint;
    private Client $client;

    public function __construct(string $apiEndpoint)
    {
        $this->apiEndpoint = $apiEndpoint;
        $this->client = new Client([
            'base_uri' => $this->apiEndpoint,
            'headers' => [
                'Content-type' => 'application/json'
            ]
        ]);
    }

    /**
     * @throws UnknownProperties
     * @throws GuzzleException
     */
    public function createBroadcast(AntMediaBroadcastDTO $data): AntMediaBroadcastDTO
    {
        $res = $this->client->post('v2/broadcasts/create', [
            'body' => json_encode(
                collect($data->toArray())->filter()->toArray()
            )
        ]);
        $res = json_decode(
            $res->getBody()->getContents(),
            true
        );
        return new AntMediaBroadcastDTO($res);
    }

    /**
     * @throws GuzzleException
     */
    public function deleteBroadcast(AntMediaBroadcastDTO $data): bool
    {
        $res = $this->client->delete("v2/broadcasts/{$data->streamId}");
        $res = json_decode(
            $res->getBody()->getContents()
        );
        return !empty($res->success);
    }

    /**
     * @throws UnknownProperties
     * @throws GuzzleException
     */
    public function getBroadcast(AntMediaBroadcastDTO $data): AntMediaBroadcastDTO
    {
        $res = $this->client->get("v2/broadcasts/{$data->streamId}");
        $res = json_decode(
            $res->getBody()->getContents(),
            true
        );
        return new AntMediaBroadcastDTO($res);
    }
}
