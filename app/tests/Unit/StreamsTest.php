<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create()->refresh();
    actingAs($this->user);
});

afterEach(function () {
    $this->user->delete();
});

it('created stream when user added', function () {
    expect(
        $this->user->stream
    )->not->toBeEmpty();
});

it('created ant media broadcast when stream created', function () {
    expect(
        $this->user->stream->stream_id
    )->not->toBeEmpty();
});

it('can add stream', function ($name) {
    $response = post(route('add_stream'), [
        'name' => $name
    ]);
    $response->assertRedirect(route('add_stream'));
    expect($this->user->stream->name)->toEqual($name);
})->with([
    'new name of user`s stream'
]);
