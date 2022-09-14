<?php

namespace App\Http\DataTransferObjects;

use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapTo;
use Spatie\DataTransferObject\Caster;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Contracts\Service\Attribute\Required;

class StreamDTO extends DataTransferObject
{
    public string $name;

    public string|null $description;

    public int $user_id;

    public string|null $stream_id;

    public string|null $preview;
}
