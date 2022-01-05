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
        $query = Photo::with(['user']);
        $photos = $query->orderBy(Photo::CREATED_AT, 'desc')->paginate();

        return PhotoResource::collection($photos);
    }


    /**
     * フォト詳細を取得する
     *
     * @return Photo
     */
    public function show(String $id)
    {
        $photo = Photo::where('id', $id)
            ->with(['user', 'comments', 'comments.user'])
            ->first();
        return new PhotoResource($photo) ?? abort(404);
    }

    /**
     * フォトを投稿する
     *
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

        return response($photo, 201);
    }
}
