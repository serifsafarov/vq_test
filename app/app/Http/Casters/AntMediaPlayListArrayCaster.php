<?php

namespace App\Http\Casters;

use App\Http\DataTransferObjects\AntMediaBroadcastDTO;
use App\Http\DataTransferObjects\AntMediaEndpointDTO;
use App\Http\DataTransferObjects\AntMediaPlayListItemDTO;
use Exception;
use Spatie\DataTransferObject\Caster;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AntMediaPlayListArrayCaster implements Caster
{

    /**
     * @throws UnknownProperties
     * @throws Exception
     */
    public function cast(mixed $value): array
    {
        if (! is_array($value)) {
            throw new Exception("Can only cast arrays to AntMediaPlayListItemDTO");
        }

        return array_map(
        /**
         * @throws UnknownProperties
         */ fn (array $data) => new AntMediaPlayListItemDTO(...$data),
            $value
        );
    }
}
