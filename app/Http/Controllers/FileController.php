<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller implements HasMiddleware
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware(['auth', 'role:admin'], only: ['index', 'create', 'store']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = File::get();

        return view('files.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('files.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required'
        ]);

        $file = $request->file('file');
        $user = User::find(Auth::user()->id);

        $PATH = 'storage/files/'.$user->id;


        $finalName = time().'.'.$file->extension();

        $request->file->storeAs($PATH, $finalName);

        $file = File::create([
            'path' => $PATH.'/'.$finalName,
            'original' => $file->getClientOriginalName(),
            'name' => $finalName,
            'user_id' => Auth::user()->id
        ]);

        return response()->json(['success' => 'You have successfully uploaded file.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function download(string $id)
    {
        $file = File::where('id', $id)->get()->first();

        if(!$file) abort(404);

        response()->download($file->path, $file->original);

        return redirect()->back();
    }
}
