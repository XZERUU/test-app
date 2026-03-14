<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        return view('files.upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:2048'
        ]);

        $path = $request->file('file')->store('uploads', 'public');

        return back()->with('success', 'File uploaded successfully');
    }
}