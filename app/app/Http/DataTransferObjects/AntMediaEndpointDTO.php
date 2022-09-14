<?php

namespace App\Http\DataTransferObjects;

use App\Http\Validators\InArray;
use Spatie\DataTransferObject\DataTransferObject;

class AntMediaEndpointDTO extends DataTransferObject
{
    #[InArray(['started', 'finished', 'failed', 'broadcasting'])]
    public string $status;

    #[InArray(['facebook', 'periscope', 'youtube', 'generic'])]
    public string $type;

    public string $rtmpUrl;

    public string $endpointServiceId;
}
