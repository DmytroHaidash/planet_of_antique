<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\MediaResource;
use App\Models\Upload;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UploadsController extends Controller
{
    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $uploaded = null;

        if ($request->hasFile('image')) {
            if ($request->filled(['model', 'model_id'])) {
                $media = $request->input('model')::find($request->input('model_id'));
            } else {
                $media = Upload::create();
            }

            $uploaded = $media->addMediaFromRequest('image')
                ->toMediaCollection('uploads');
        }

        return response()->json($uploaded ? new MediaResource($uploaded) : null);
    }

    /**
     * @param Media $media
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Media $media)
    {
        $media->delete();

        return response(null, 204);
    }
}
