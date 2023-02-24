<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class CommonController extends Controller
{
    // For public application
    public function app()
    {
        return view('app');
    }

    public function storage($filename): \Illuminate\Http\Response
    {
        // Add folder path here instead of storing in the database.
        $path = storage_path('app'.DIRECTORY_SEPARATOR.'custom'.DIRECTORY_SEPARATOR.$filename);

        if (! File::exists($path)) {
            abort(SymfonyResponse::HTTP_NOT_FOUND);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header('Content-Type', $type);

        return $response;
    }
}
