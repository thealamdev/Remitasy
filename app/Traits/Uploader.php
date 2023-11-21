<?php
namespace App\Traits;

use App\Models\Image;

trait Uploader
{
    public function upload($request, $image_id, $bucket, $type, ?string $access = 'public')
    {
        $image = $request->file('image');
        $mime = $image->getClientOriginalExtension();
        $image_name = uniqid() . "." . $mime;
        $url = asset('storage/' . $bucket->toString() . '/' . $image_name);

        $image->storeAs($bucket->toString(), $image_name, $access);
        Image::create(['image_type' => $type, 'image_id' => $image_id, 'name' => $image_name, 'path' => $bucket->toString(), 'size' => $image->getSize(), 'mime' => $image->getClientMimeType(), 'disk' => 'local', 'url' => $url]);
    }
}
