<?php

namespace App\Http\DataTransferObjects;

use App\Http\Casters\StringArrayCaster;
use App\Http\Casters\AntMediaEndpointArrayCaster;
use App\Http\Validators\InArray;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\DataTransferObject;

class AntMediaBroadcastDTO extends DataTransferObject
{
    public string|null $streamId;

    #[InArray(['finished', 'broadcasting', 'created', null])]
    public string|null $status;

    #[InArray(['finished', 'broadcasting', 'created', null])]
    public string|null $playListStatus;

    #[InArray(['liveStream', 'ipCamera', 'streamSource', 'VoD', 'playlist', null])]
    public string|null $type;

    #[InArray(['WebRTC', 'RTMP', 'Pull', null])]
    public string|null $publishType;

    public string|null $name;

    public string|null $description;

    public bool|null $publish;

    public int|null $date;

    public int|null $plannedStartDate;

    public int|null $plannedEndDate;

    public int|null $duration;

    #[CastWith(AntMediaEndpointArrayCaster::class)]
    public array|null $endPointList;

    #[CastWith(StringArrayCaster::class)]
    public array|null $playListItemList;

    public bool|null $publicStream;

    public bool|null $is360;

    public string|null $listenerHookURL;

    public string|null $category;

    public string|null $ipAddr;

    public string|null $username;

    public string|null $password;

    public string|null $quality;

    public float|null $speed;

    public string|null $streamUrl;

    public string|null $originAdress;

    public int|null $mp4Enabled;

    public int|null $webMEnabled;

    public int|null $expireDurationMS;

    public string|null $rtmpURL;

    public bool|null $zombi;

    public int|null $pendingPacketSize;

    public int|null $hlsViewerCount;

    public int|null $webRTCViewerCount;

    public int|null $rtmpViewerCount;

    public int|null $startTime;

    public int|null $receivedBytes;

    public int|null $bitrate;

    public string|null $userAgent;

    public string|null $latitude;

    public string|null $longitude;

    public string|null $altitude;

    public string|null $mainTrackStreamId;

    #[CastWith(StringArrayCaster::class)]
    public array|null $subTrackStreamIds;

    public int|null $absoluteStartTimeMs;

    public int|null $webRTCViewerLimit;

    public int|null $hlsViewerLimit;

    public string|null $subFolder;

    public int|null $currentPlayIndex;

    public string|null $metaData;

    public bool|null $playlistLoopEnabled;

}
