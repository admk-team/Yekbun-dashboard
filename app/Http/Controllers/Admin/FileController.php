<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        if (! $request->hasFile('file')) {
            return response('', 400);
        }

        $path = $request->file->store("/" . $request->folder?? 'files', "public");

        return [
            'status' => true,
            'path' => $path
        ];
    }

    public function delete(Request $request)
    {
        if (! $request->path) {
            return response('', 400);
        }

        if (Storage::delete($request->path)) {
            return [
                'status' => true
            ];
        } else {
            return [
                'status' => false
            ];
        }
    }
}
