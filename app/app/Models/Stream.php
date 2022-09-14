<?php

namespace App\Models;

use App\Observers\StreamObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Stream extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'preview', 'user_id', 'status', 'stream_id'
    ];

    protected static function booted()
    {
        self::observe(StreamObserver::class);
    }

    public function getPreviewLinkAttribute(): string
    {
        return Storage::temporaryUrl(
            $this->preview, now()->addMinutes(5)
        );
    }
}
