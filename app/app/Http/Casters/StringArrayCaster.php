<?php

namespace App\Http\Casters;

use Exception;
use Spatie\DataTransferObject\Caster;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class StringArrayCaster implements Caster
{

    /**
     * @throws UnknownProperties
     * @throws Exception
     */
    public function cast(mixed $value): array
    {
        if (!is_array($value)) {
            throw new Exception("Can only cast arrays to string");
        }

        return array_map(
            function (array $data) {
                return array_map(
                    function (string $item) {
                        return $item;
                    },
                    $data
                );
            },
            $value
        );
    }
}
