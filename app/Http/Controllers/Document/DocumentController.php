<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;

class DocumentController extends Controller
{
    public function document()
    {
        echo view('Document.Document',compact(''));
        die;
    }
}
