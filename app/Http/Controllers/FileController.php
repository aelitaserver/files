<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('files.index');
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

        $PATH = 'public/files/'.$user->id;

        $name = $file->getClientOriginalName();
        $name = preg_replace('/[^A-Za-z0-9 -]/', '_', $name);
        $name = preg_replace('/  */', '-', $name);

        $finalName = $name.'_'.time().'.'.$file->extension();

        $id = $user->id;
        $request->file->storeAs($PATH, $finalName);

        $file = File::create([
            'path' => $PATH,
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
}
