<?php

namespace App\Http\Controllers;

use App\mediaLibrary;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaLibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = mediaLibrary::latest()->get();
        // $data = mediaLibrary::where('id', $id)->get();

        return view('mediaLibrary.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $extension = $image->getClientOriginalExtension();
        //     $filename = time() . "." . $extension;
        //     $image->move('public/mediaLibrary', $filename);
            
        // } 
if ($request->hasFile('image')) {
  if ($request->file('image')->isValid()) {
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();//Getting extension
        $originalname = $image->getClientOriginalName();//Getting original name
        //this code will store image in laravel default storage folder $path = $image->storeAs('', $originalname);
        $path = $image->move('uploads/media/mainMedia/', $originalname);//This will store in customize folder
        // $path = $image->move('uploads/media/'.Str::replaceLast("\\", "/", $originalname));
        // $path = $image->move(Str::replaceFirst("\\", "/", $originalname));//This will store and create new folder
        $imgsizes = $path->getSize();
        $size = getimagesize($path);
        $width = $size[0]; 
        $height = $size[1];
        $mimetype = $image->getClientMimeType();//Get MIME type
        // Storage::disk('public')->put($image->getFilename().'.'.$extension,  File::get($image));
    }
}
//Start Store in Database
        $picture = new mediaLibrary();
        $picture->mime = $mimetype;
        $picture->imgsize = $imgsizes;
        $picture->original_filename = $originalname;
        $picture->extension = $extension;
        $picture->width = $width;
        $picture->height = $height;
        $picture->filename = $path;
        // $picture->filename = $image->getFilename().'.'.$extension;
        // $path = $image->storeAs('', $picture->original_filename);
        // $picture->filename = $filename;       
        $picture->save();
//End Store
        return redirect()->route('media.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\mediaLibrary  $mediaLibrary
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = mediaLibrary::findOrFail($id);

        return view('mediaLibrary.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\mediaLibrary  $mediaLibrary
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = mediaLibrary::findOrFail($id);
        return view('mediaLibrary.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\mediaLibrary  $mediaLibrary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
                request()->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);


                $data = mediaLibrary::findOrFail($id);

                if ($request->hasFile('image')) {
                    if ($request->file('image')->isValid()) {
                        $image = $request->file('image');
                        $extension = $image->getClientOriginalExtension();//Getting extension
                        $originalname = $image->getClientOriginalName();//Getting original name

                        if(file_exists($data->filename)) {
                            unlink($data->filename);
                        }
                                        
                        $path = $image->move('uploads/media/mainMedia/', $originalname);
                        $imgsizes = $path->getSize();
                        $size = getimagesize($path);
                        $width = $size[0]; 
                        $height = $size[1];
                        $mimetype = $image->getClientMimeType();//Get MIME type

                        $data->mime = $mimetype;
                        $data->imgsize = $imgsizes;
                        $data->original_filename = $originalname;
                        $data->extension = $extension;
                        $data->width = $width;
                        $data->height = $height;
                        $data->filename = $path;

                        $data->save();
                    }
                }

                return redirect()->route('media.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\mediaLibrary  $mediaLibrary
     * @return \Illuminate\Http\Response
     */
    public function destroy(mediaLibrary $medium)
    {
        //medium is from route::list
        $image_path = public_path().'/'.$medium->filename;
        unlink($image_path);
        $medium->delete();
        // dd($profiles);
        // below line for id call
        // mediaLibrary::findOrFail($id)->delete();
        return redirect()->route('media.index');
    }

}
