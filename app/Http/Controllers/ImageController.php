<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // single file approach
        // Fetch all images from the database
        $images = DB::table('images')->orderByDesc('id')-> get();
        return view('index',[
            'gallery' => $images
        ]);

        // // multifile approach
        // // Fetch all images from the database
        // $images = DB::table('multifiles')->orderByDesc('id')-> get();
        // return view('multifile',[
        //     'gallery' => $images
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       // single file approach
        $request->validate([
            'title' => 'required|string|max:50|min:5',
            'description' => 'required|string|max:200|min:5',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // FileName Genarate
        $image = $request ->file('image');

        $fileName = md5(rand(100000000, 10000000000) . '.' . time() . '.' . str_shuffle("kdhfgdsihiodfidsfids")) . '.' .$image->getClientOriginalExtension();

        // File Upload
        $image ->move(public_path('media'), $fileName);

        // Database store
       DB::table('images')->insert([
            'title'       => $request ->title,
            'description' => $request ->description,
            'image_path'  => $fileName,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
        // Return
        return redirect()->route('index')->with('success', 'File Upload Successful');




        // // multifile approach
        //  $request->validate([
        //     'image.*' => 'required|image|mimes:jpeg,png,jpg|max:4096',
        // ]);

        // // FileName Genarate
        // foreach ($request->file('image') as $image) {
        //     $fileName = md5(rand(100000000, 10000000000) . '.' . time() . '.' . str_shuffle("kdhfgdsihiodfidsfids")) . '.' .$image->getClientOriginalExtension();

        //     // File Upload
        //     $image ->move(public_path('media'), $fileName);

        //     // Database store
        //     DB::table('multifiles')->insert([
        //         'image_path'  => $fileName,
        //         'created_at'  => now(),
        //         'updated_at'  => now(),
        //     ]);
        // }
        // // Return
        // return redirect()->route('index')->with('success', 'File Upload Successful');
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
        // //single item delete
        $image = DB::table('images')->where('id', $id)->first();
        if($image){
            // Delete the entire folder
            $filePath = public_path('media/' . $image->image_path);
            // Delete file if it exists
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            // Delete from DB
            DB::table('images')->where('id', $id)->delete();
        }
        return redirect()->back()->with('success', 'Item deleted Successful.');






        // //Multiple file but single delete approach
        // $image = DB::table('multifiles')->where('id', $id)->first();
        // if($image){
        //     // Delete the entire folder
        //     $filePath = public_path('media/' . $image->image_path);
        //     // Delete file if it exists
        //     if (file_exists($filePath)) {
        //         unlink($filePath);
        //     }
        //     // Delete from DB
        //     DB::table('multifiles')->where('id', $id)->delete();
        // }
        // return redirect()->back()->with('success', 'Item deleted Successful.');
    }
}
