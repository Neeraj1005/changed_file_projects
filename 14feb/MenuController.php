<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Menu; 
use App\Content;
 
class MenuController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
function __construct()
    {
          $this->middleware('permission:menu-list');
          $this->middleware('permission:menu-create', ['only' => ['create','store']]);
          $this->middleware('permission:menu-edit', ['only' => ['edit','update']]);
          $this->middleware('permission:menu-delete', ['only' => ['destroy']]);
    }
    
    public function index()
    {

         
        $items =Menu::where('delete_status','=','1')->orderBy('id','DESC')->latest()->get();
        $trashMenu = Menu::where('delete_status','=','0')->count();
        return view('menu.index',array('items'=>$items,'trashMenu'=>$trashMenu));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pages = Content::latest()->get();

        // echo json_encode($pages);
        // exit();
        return view('menu.create',compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


        $this->validate($request,
        [
            'name' => 'required|unique:menus',
            'status'=>'required|not_in:3',
            'page'=>'required|not_in:0'
        ]);

        // $item = $request->all();
        // dd($item);
        // Menu::create($item);

        $item = new Menu();
        $item->name = $request->name;
        $item->status = $request->status;
        $item->parent_id = $request->parent_id;
        // $item->content_id = $request->page;
          if ($request->input('page') == 'NewField') {
            $item->content_id = $request->page1;
        } else {
            $item->content_id = $request->page;
        }

        $item->save();
        
        return \Redirect::route('admin_menu')->with('message','Menu added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // $items = Menu::with('Content')->findOrFail($id);
        $items = Menu::findOrFail($id);
        $pages = Content::all();
        // return view('menu.edit',compact('items','pages'));
        // dd([$pages, $items]);
        return view('menu.edit',['items'=>$items, 'pages'=>$pages]);
        // return view('menu.edit',['items'=>$items]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         $this->validate($request,[

            'name'=>'required',
            'status'=>'required|not_in:3',
            'page'=>'required|not_in:0'
         ]);

         $items = Menu::find($id);
// return json_encode($items);
// exit();
         // dd($items);
         $items->name = $request->name;
         $items->status = $request->status;
         $items->parent_id = $request->parent_id;
         // $items->content_id = $request->page;
         if ($request->input('page') == 'NewField') {
             $items->content_id = $request->page1;
         } else {
             $items->content_id = $request->page;
         }
         $items->save();
         // return \Redirect::route('admin_menu')->with('message','Menu  is updated successfully');
         return redirect()->route('admin_menu')->with('message','Menu  is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
       // menu::Destroy($id);
        menu::where('id',$id)->update(['delete_status' => '0']);
        return \Redirect::route('admin_menu')->with('message','Menu  move to trash Successfully !');
    }
    
     public function deleteMultiple(Request $request){
  
    // return json_encode($request->input());
    
       $ids = $request->ids;
        
        // dd($ids);

       //Menu::whereIn('id',explode(",",$ids))->delete();
       Menu::whereIn('id',explode(",",$ids))->update(['delete_status' => '0']);

        return response()->json(['status'=>true,'message'=>"Menu move to trash successfully."]);   

    }

}
