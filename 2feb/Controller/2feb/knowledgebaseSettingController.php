<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
class knowledgebaseSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('knowledgebaseSetting.index');
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
        //
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
    }

     public function viewChange(){

       $viewval = DB::table('knowledgebaseSetting')->get()->toArray();       
       if($viewval[0]->views==1){
         $views = 0;
       }else{
         $views = 1;
       }

       $row = array('views'=>$views);
       DB::table('knowledgebaseSetting')->update($row);
        return Redirect::back()->with('message','Display view updated successfully!');
       
    }

    public function likeunlike(){

       $viewval = DB::table('knowledgebaseSetting')->get()->toArray();       
       if($viewval[0]->like_unlike ==1){
         $like_unlike = 0;
       }else{
         $like_unlike = 1;
       }

       $row = array('like_unlike'=>$like_unlike);
       DB::table('knowledgebaseSetting')->update($row);
        return Redirect::back()->with('message','Display view updated successfully!');
       

    }

    public function category(){
        $viewval = DB::table('knowledgebaseSetting')->get()->toArray();       
       if($viewval[0]->category ==1){
         $category = 0;
       }else{
         $category = 1;
       }

       $row = array('category'=>$category);
       DB::table('knowledgebaseSetting')->update($row);
        return Redirect::back()->with('message','Display view updated successfully!');

    }

    public function author(){
        $viewval = DB::table('knowledgebaseSetting')->get()->toArray();       
       if($viewval[0]->author ==1){
         $author = 0;
       }else{
         $author = 1;
       }

       $row = array('author'=>$author);
       DB::table('knowledgebaseSetting')->update($row);
       return Redirect::back()->with('message','Display view updated successfully!');

    }

    public function posteddate(){
         $viewval = DB::table('knowledgebaseSetting')->get()->toArray();       
       if($viewval[0]->posted_date ==1){
         $posted_date = 0;
       }else{
         $posted_date = 1;
       }

       $row = array('posted_date'=>$posted_date);
       DB::table('knowledgebaseSetting')->update($row);
        return Redirect::back()->with('message','Display view updated successfully!');


    }

    public function print(){
        $viewval = DB::table('knowledgebaseSetting')->get()->toArray();       
       if($viewval[0]->print ==1){
         $print = 0;
       }else{
         $print = 1;
       }

       $row = array('print'=>$print);
       DB::table('knowledgebaseSetting')->update($row);
        return Redirect::back()->with('message','Display view updated successfully!');


    }

    public function savepost(){
    $viewval = DB::table('knowledgebaseSetting')->get()->toArray();       
       if($viewval[0]->save_post ==1){
         $save_post = 0;
       }else{
         $save_post = 1;
       }

       $row = array('save_post'=>$save_post);
       DB::table('knowledgebaseSetting')->update($row);
       return Redirect::back()->with('message','Display view updated successfully!');


    }

    public function tags(){
      
       $viewval = DB::table('knowledgebaseSetting')->get();            
       if($viewval[0]->tags == 1){
         $tags = 0;
       }else{
         $tags = 1;
       }

       $row = array('tags'=>$tags);
       DB::table('knowledgebaseSetting')->update($row);
       return Redirect::back()->with('message','Display view updated successfully!');
    }

    public function relatedpost(){
    $viewval = DB::table('knowledgebaseSetting')->get()->toArray();       
       if($viewval[0]->related_post ==1){
         $related_post = 0;
       }else{
         $related_post = 1;
       }

       $row = array('related_post'=>$related_post);
       DB::table('knowledgebaseSetting')->update($row);
       return Redirect::back()->with('message','Display relatedpost updated successfully!');
    }

    public function welcomeblock(){
    $viewval = DB::table('knowledgebaseSetting')->get()->toArray();       
       if($viewval[0]->welcome_block ==1){
         $welcome_block = 0;
       }else{
         $welcome_block = 1;
       }

       $row = array('welcome_block'=>$welcome_block);
       DB::table('knowledgebaseSetting')->update($row);
       return Redirect::back()->with('message','Display welcomeblock updated successfully!');
    }

    public function sliderblock(){
    $viewval = DB::table('knowledgebaseSetting')->get()->toArray();       
       if($viewval[0]->slider_block ==1){
         $slider_block = 0;
       }else{
         $slider_block = 1;
       }

       $row = array('slider_block'=>$slider_block);
       DB::table('knowledgebaseSetting')->update($row);
       return Redirect::back()->with('message','Display sliderblock updated successfully!');
    }    

    public function footerblock(){
    $viewval = DB::table('knowledgebaseSetting')->get()->toArray();       
       if($viewval[0]->footer_block ==1){
         $footer_block = 0;
       }else{
         $footer_block = 1;
       }
       $row = array('footer_block'=>$footer_block);
       DB::table('knowledgebaseSetting')->update($row);
       return Redirect::back()->with('message','Display footerblock updated successfully!');
    }

    public function featuredblock(){
      $statusvalue = DB::table('knowledgebaseSetting')->get()->toArray();
      $retVal = ($statusvalue[0]->featured_block==1) ? 0 : 1 ;
      $colFeatured = array('featured_block' =>$retVal);
      DB::table('knowledgebaseSetting')->update($colFeatured);
      return Redirect::back()->with('message','Display featuredblock updated successfully!'); 
    }    

    public function categoryblock(){
      $statusvalue = DB::table('knowledgebaseSetting')->get()->toArray();
      $retVal = ($statusvalue[0]->category_block==1) ? 0 : 1 ;
      $colFeatured = array('category_block' =>$retVal);
      DB::table('knowledgebaseSetting')->update($colFeatured);
      return Redirect::back()->with('message','Display featuredblock updated successfully!'); 
    }    

    public function searchblock(){
      $statusvalue = DB::table('knowledgebaseSetting')->get()->toArray();
      $retVal = ($statusvalue[0]->search_block==1) ? 0 : 1 ;
      $colFeatured = array('search_block' =>$retVal);
      DB::table('knowledgebaseSetting')->update($colFeatured);
      return Redirect::back()->with('message','Display featuredblock updated successfully!'); 
    }

    public function viewimageblock(){
      $statusvalue = DB::table('knowledgebaseSetting')->get()->toArray();
      $retVal = ($statusvalue[0]->viewimg_block==1) ? 0 : 1 ;
      $colFeatured = array('viewimg_block' =>$retVal);
      DB::table('knowledgebaseSetting')->update($colFeatured);
      return Redirect::back()->with('message','Display featuredblock updated successfully!'); 
    }

    public function homeimageblock(){
      $statusvalue = DB::table('knowledgebaseSetting')->get()->toArray();
      $retVal = ($statusvalue[0]->homeimg_block==1) ? 0 : 1 ;
      $colFeatured = array('homeimg_block' =>$retVal);
      DB::table('knowledgebaseSetting')->update($colFeatured);
      return Redirect::back()->with('message','Display featuredblock updated successfully!'); 
    }

    public function listimageblock(){
      $statusvalue = DB::table('knowledgebaseSetting')->get()->toArray();
      $retVal = ($statusvalue[0]->listimg_block==1) ? 0 : 1 ;
      $colFeatured = array('listimg_block' =>$retVal);
      DB::table('knowledgebaseSetting')->update($colFeatured);
      return Redirect::back()->with('message','Display featuredblock updated successfully!'); 
    }
}
