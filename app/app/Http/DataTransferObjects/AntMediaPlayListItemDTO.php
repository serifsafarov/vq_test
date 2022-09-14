<?php

namespace App\Http\DataTransferObjects;

use App\Http\Validators\InArray;
use Spatie\DataTransferObject\DataTransferObject;

class AntMediaPlayListItemDTO extends DataTransferObject
{
    public string $streamUrl;

    public string $type;
}
