<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoStoreRequest;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function create(PhotoStoreRequest $request)
    {
        $imageFile = $request->file('photo');
        if (is_null($imageFile)) return;
        $fileName = Storage::disk('s3')->put('/public', $imageFile);

        Photo::create([
            'user_id' => Auth::id(),
            'filename' => $fileName,
        ]);

        return response($fileName, 201);
    }
}
