<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DriveController extends Controller
{
    public function getDrive(){
        $dir = '/';
        return Storage::cloud()->listContents($dir, false);
    }
}
