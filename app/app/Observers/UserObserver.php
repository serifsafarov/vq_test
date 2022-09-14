<?php

namespace App\Observers;

use App\Http\DataTransferObjects\StreamDTO;
use App\Models\Stream;
use App\Models\User;
use App\Services\AntMediaService;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UserObserver
{
    /**
     * @throws UnknownProperties
     */
    public function created(User $user): void
    {
        $this->createStream($user);
    }

    public function deleted(User $user): void
    {
        $this->deleteStream(
            $user
        );
    }

    /**
     * @throws UnknownProperties
     */
    private function createStream(User $user): void
    {
        Stream::firstOrCreate(
            [
                'user_id' => $user->id
            ],
            (new StreamDTO(
                [
                    'name' => "$user->name`s stream",
                    'user_id' => $user->id
                ]
            ))->toArray()
        );
    }

    private function deleteStream(User $user): void
    {
        Stream::find($user->id)->delete();
    }
}
