<?php
namespace App\Traits;

use App\Models\Document;
use App\Models\Image;

trait Uploader
{
    public function upload($request, $name, $file_id, $bucket, $relation, ?string $access = 'public')
    {
        $file = $request->file($name);
        $mime = $file->getClientOriginalExtension();
        $file_name = uniqid() . "." . $mime;
        $url = asset('storage/' . $bucket->toString() . '/' . $file_name);

        $file->storeAs($bucket->toString(), $file_name, $access);
        if ($name == 'image') {
            Image::create(['image_type' => $relation, 'image_id' => $file_id, 'name' => $file_name, 'path' => $bucket->toString(), 'size' => $file->getSize(), 'mime' => $file->getClientMimeType(), 'disk' => 'local', 'url' => $url]);
        }
        if ($name == 'document') {
            Document::create(['document_type' => $relation, 'document_id' => $file_id, 'name' => $file_name, 'path' => $bucket->toString(), 'size' => $file->getSize(), 'mime' => $file->getClientMimeType(), 'disk' => 'local', 'url' => $url]);
        }

    }
}
