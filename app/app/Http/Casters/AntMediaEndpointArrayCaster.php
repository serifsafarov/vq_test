<?php

namespace App\Http\Casters;

use App\Http\DataTransferObjects\AntMediaEndpointDTO;
use Exception;
use Spatie\DataTransferObject\Caster;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AntMediaEndpointArrayCaster implements Caster
{

    /**
     * @throws UnknownProperties
     * @throws Exception
     */
    public function cast(mixed $value): array
    {
        if (! is_array($value)) {
            throw new Exception("Can only cast arrays to AntMediaEndpointDTO");
        }

        return array_map(
        /**
         * @throws UnknownProperties
         */ fn (array $data) => new AntMediaEndpointDTO(...$data),
            $value
        );
    }
}
