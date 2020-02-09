<?php

namespace App\Http\Controllers;

use App\Welcome;
use File;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Welcome::get();
        return view('theme1.welcome.index',['data' => $data]);
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
        $validatedData = $request->validate([
                'title' => 'required|max:255',
                'description' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        $originalname = $image->getClientOriginalName();
        $path = $image->move('uploads/media/welcome/', $originalname);
        $imgsizes = $path->getSize();
        $data = getimagesize($path);
        $width = $data[0]; 
        $height = $data[1];
        $mimetype = $image->getClientMimeType();

        $data = new Welcome();
        $data->title = $request->title;
        $data->description = $request->description;
        $data->image = str_replace('\\', '/', $path);
        $data->save();

        return redirect()->route('welcome-home.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Welcome  $welcome
     * @return \Illuminate\Http\Response
     */
    public function show(Welcome $welcome)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Welcome  $welcome
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Welcome::findOrFail($id);
        // dd($data);
        // return view('theme1.welcome.edit',['data'=>$data]);
        return view('theme1.welcome.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Welcome  $welcome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
                'title' => 'required|max:255',
                'description' => 'required',
                // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        $data = Welcome::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
        $image = $request->file('image');
        $originalname = $image->getClientOriginalName();
        unlink($data->image);//this will remove old image 
        $path = $image->move('uploads/media/welcome/', $originalname);
        $data->image = str_replace('\\', '/', $path);
            }
        }

        $data->title = $request->title;
        $data->description = $request->description;
        $data->image = $data->image;
        $data->save();

        return redirect()->route('welcome-home.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Welcome  $welcome
     * @return \Illuminate\Http\Response
     */
    public function destroy(Welcome $welcome)
    {
        //
    }
}
