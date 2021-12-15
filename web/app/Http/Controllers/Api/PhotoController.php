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
        $this->middleware('auth')->except(['index']);
    }

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

    public function index()
    {
        $query = Photo::with(['user']);
        $photos = $query->orderBy(Photo::CREATED_AT, 'desc')->paginate();

        return PhotoResource::collection($photos);
    }
}
