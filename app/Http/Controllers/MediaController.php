<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaUploadRequest;
use App\Http\Resources\FileResource;
use App\Http\Resources\ImageBrowserResource;
use App\Models\Upload;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\MediaCollections\Exceptions\DiskDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        $media = Media::where('mime_type', 'like', 'image%')->where('collection_name', 'uploads')->latest()->get();

        return response()->json(ImageBrowserResource::collection($media));
    }

    /**
     * @param MediaUploadRequest $request
     * @return JsonResponse
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function upload(MediaUploadRequest $request)
    {
        $media = null;

        /** @var Upload $model */
        $model = $request->has('model_type')
            ? $request->model_type::find($request->model_id)
            : Upload::create();

        if ($request->hasFile('file')) {
            $media = $model->addMediaFromRequest('file')
                ->sanitizingFileName(filenameSanitizer())
                ->toMediaCollection($request->collection ?? 'uploads');
        }

        return response()->json($media ? new FileResource($media) : null);
    }

    /**
     * @param Request $request
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function destroy(Request $request)
    {
        $src = urldecode($request->input('src'));

        preg_match('/\/\d+\//', $src, $matches);

        $upload = Media::find(trim($matches[0], '/'))->model;

        if ($upload instanceof Upload) {
            $upload->delete();
        }

        return response(null, 200);
    }

    /**
     * @param Media $media
     * @return Application|ResponseFactory|Response
     * @throws Exception
     */
    public function regularDestroy(Media $media)
    {
        $media->delete();

        return response(null, 204);
    }
}
