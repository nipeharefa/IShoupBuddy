<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Image;
use Illuminate\Http\Response as IlluminateResponse;
use Exception;

class ImageController extends Controller
{
    public function store(Request $request) {

        $filename = str_random(20);

        $path = $request->image->storeAs('original', "{$filename}.jpg", 'public');

        $data = [
            "status"    =>  "OK",
            "image"     =>  "{$filename}.jpg",
            "links"     =>  [

                "small" =>  url('image/small', "{$filename}.jpg"),
                "medium" =>  url('image/medium', "{$filename}.jpg"),
                "large" =>  url('image/large', "{$filename}.jpg")
            ],
            "message"   =>  null
        ];

        # Send to Queue Delete

        return response()->json($data, 201);
    }

    public function renderImage($ratio, $filename, Request $request) {

        $drive = Storage::disk('public');

        $path = "original/{$filename}";

        $exists = $drive->exists($path);

        try {

            if ($path) {

                $size = false;

                switch ($ratio) {
                    case 'thumb':
                        $size = 150;
                        break;
                    case 'small':
                        $size = 400;
                        break;
                    case 'medium':
                        $size = 600;
                        break;
                    case 'large':
                        $size = 800;
                        break;
                    default:
                        # original size
                        break;
                }

                $temp = $drive->get($path);

                $img = Image::cache(function($image) use ($path, $size, $temp){

                    $img = $image->make($temp);

                    if ($size) {

                        $img = $img->resize($size, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }

                    return $img;
                });

                return $this->buildResponse($img);
            }

        } catch (Exception $e) {
            abort(404);
        }

    }

    protected function buildResponse($content)
    {
        // define mime type
        $mime = finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $content);

        $etag = md5($content);
        $not_modified = isset($_SERVER['HTTP_IF_NONE_MATCH']) && $_SERVER['HTTP_IF_NONE_MATCH'] == $etag;
        $content = $not_modified ? NULL : $content;
        $status_code = $not_modified ? 304 : 200;

        return new IlluminateResponse($content, $status_code, array(
            'Content-Type' => $mime,
            'Cache-Control' => 'max-age='.(config('imagecache.lifetime')*60).', public',
            'Etag' => md5($content),
            'Expires' => gmdate('D, d M Y H:i:s \G\M\T', time() + 86400 * 365)
        ));
    }
}
