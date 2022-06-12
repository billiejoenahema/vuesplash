<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoStoreRequest;
use App\Http\Resources\PhotoResource;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'download', 'show']);
    }


    /**
     * フォト一覧を取得する
     *
     * @return Photo
     */
    public function index()
    {
        $query = Photo::with(['user'])->withCount(['likeUsers']);
        $photos = $query->paginate();

        return PhotoResource::collection($photos);
    }


    /**
     * フォト詳細を取得する
     *
     * @return Photo
     */
    public function show(String $id)
    {
        $photo = Photo::with([
                'user',
                'user.photos',
                'user.likePhotos',
                'comments',
                'comments.user',
            ])
            ->withCount(['likeUsers'])
            ->findOrFail($id);
        return new PhotoResource($photo) ?? abort(404);
    }

    /**
     * フォトを投稿する
     *
     * @param PhotoStoreRequest $request
     * @return Photo
     */
    public function create(PhotoStoreRequest $request)
    {
        $imageFile = $request->file('photo');
        if (is_null($imageFile)) return;
        $fileName = Storage::disk('s3')->put('/public', $imageFile);

        $photo = Photo::create([
            'user_id' => Auth::id(),
            'filename' => $fileName,
        ]);

        return new PhotoResource($photo);
    }

    /**
     * フォトを削除する
     *
     * @return Photo
     */
    public function delete(String $id)
    {
        $photo = Photo::findOrFail($id);
        if ($photo) {
            $photo->delete();
        }
        return response()->json(['message' => 'success']);
    }
}
