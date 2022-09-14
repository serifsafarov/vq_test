<?php

namespace App\Http\Controllers;

use App\Http\DataTransferObjects\StreamDTO;
use App\Http\Requests\AddStreamRequest;
use App\Http\Requests\GetStreamRequest;
use App\Http\Resources\StreamResource;
use App\Models\Stream;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;


class StreamController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function list(): Factory|View|Application
    {
        return view('home', [
            'streams' => StreamResource::collection(Stream::all())
        ]);
    }

    /**
     * @throws UnknownProperties
     */
    public function add(AddStreamRequest $request)
    {
        if ($request->getMethod() === 'GET')
            return view('add_stream', [
                'stream' => $request->user()->stream
            ]);

        $request->user()->stream->update(
            (new StreamDTO(
                $request->except('preview') +
                (
                $request->file('preview') ?
                    [
                        'preview' => $request->file('preview')->store('previews')
                    ] : []
                )
                + $request->user()->stream->toArray()
            ))->toArray()
        );

        return redirect(route('add_stream'));
    }

    public function get(GetStreamRequest $request)
    {

        return view('get_stream', [
            'stream' => new StreamResource(Stream::find($request->id))
        ]);
    }

}
