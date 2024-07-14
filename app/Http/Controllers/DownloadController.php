<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DownloadController extends Controller
{
    public function downloadClasslist()
    {
        $filePath = public_path('files/sample.xlsx');
        return Response::download($filePath);
    }
}
