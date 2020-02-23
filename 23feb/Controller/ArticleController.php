<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleTag;
use App\Category;
use App\SubCategory;
use App\Tag;
use App\User;
use App\mediaLibrary;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:article-list');
         $this->middleware('permission:article-create', ['only' => ['create','store']]);
         $this->middleware('permission:article-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:article-delete', ['only' => ['destroy']]);
    }
    
    public function index()
    {

            
        if(Auth::user()->privilege  === "administrator"){
             
            $articles = Article::with('category','user','mediaLibrary')->where('delete_status','=','1')->orderBy('id','DESC')->get();
            $articles->toArray();
            $trashArticle = Article::where('delete_status','=',0)->count();
             $usertype = 'administrator';
            return view('articles.index',compact('articles','trashArticle','usertype'));
        }else{
              
              $whereArticle = [
                ['delete_status','=','1'],
                ['user_id','=',Auth::user()->id]
              ];
            $articles = Article::with('category','user','mediaLibrary')->where($whereArticle)->orderBy('id','DESC')->get();
            $articles->toArray();
            $trashArticle = Article::where('delete_status','=',0)->count();
            $usertype = 'agent';
            return view('articles.index',compact('articles','trashArticle','usertype'));
        }    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profiles = mediaLibrary::all();

        $category = Category::where('delete_status','=','1')->get();
        $tag = ArticleTag::all();
        return view('articles.create',compact('category','tag','profiles'));
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
                   
            'category_id'=>'required|not_in:0',                     
            'show_date'=>'required',            
            'description'=>'required'

        ]);
 
         $records = $request->all();
          //dd($records);
         //find category slug

          
         $categorySlug = Category::findOrFail($request->category_id);
        
        $user = Auth::user()->id;
/*        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                
                $fileName=$request->file('image')->getClientOriginalName();
                $fileName =time()."_".$fileName;
                //upload
                $request->file('image')->move('uploads/BlogImage', $fileName);
                    
                    //column name 
                $records['image']=$fileName;
                
            }
        }*/
        //  if ($request->hasFile('document')) {
        //     if ($request->file('document')->isValid()) {
                
        //         $fileName=$request->file('document')->getClientOriginalName();
        //         $fileName =time()."_".$fileName;
        //         //upload
        //         $request->file('document')->move('uploads/BlogDoc', $fileName);
                    
        //             //column name 
        //         $records['document']=$fileName;
                
        //     }
        // }
        if ($request->hasFile('image')) {
          if ($request->file('image')->isValid()) {
            $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();//Getting extension
        $originalname = $image->getClientOriginalName();//Getting original name
        $path = $image->move('uploads/media/', $originalname);//This will store in customize folder
        $imgsizes = $path->getSize();
        $size = getimagesize($path);
        $width = $size[0]; 
        $height = $size[1];
        $mimetype = $image->getClientMimeType();//Get MIME type

        // $photo = mediaLibrary::create([['filename'=>$path],['mime'=>$mimetype],['extension'=>$extension],['original_filename'=>$originalname],['imgsize'=>$imgsizes],['width'=>$width],['height'=>$height]]);
        $photo = mediaLibrary::create(['filename'=>$path,'mime'=>$mimetype,'extension'=>$extension,'original_filename'=>$originalname,'imgsize'=>$imgsizes,'width'=>$width,'height'=>$height]);


        $records['image'] = $photo->id;
      }
    }

        // dd($records);
        
        $records['user_id'] = $user;
        $records['slug'] = $categorySlug->slug;
        //$records['subcategory_id'] = $request->subcategory_id;
        $records['aslug'] = $this->createSlug($request->title);

        if ($request->has('save'))
        {
                    // draft
            $records['draft'] = 0;
        }
        else if ($request->has('publish'))
        {
                    // publish
            $records['draft'] = 1;
        } 

         
      $insertedid= Article::create($records);
       // if($request->hasFile('image') && $request->file('image')->isValid()){
       //     $insertedid->addMediaFromRequest('image')->toMediaCollection('blogimages');
       // }
        //= DB::table('articles')->insert($values);
         
       
        $tagValue = array('articleSlug' => $records['aslug'], 'name'=>$request->tags,'article_id'=>$insertedid->id);
        DB::table('tags')->insert($tagValue);

//MediaLibrary

       // request()->validate([
       //              'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       //          ]);
       //  $image = $request->file('image');
       //          $extension = $image->getClientOriginalExtension();
       //          $originalname = $image->getClientOriginalName();
       //          $path = $image->move('uploads\media', $originalname);
       //          $mimetype = $image->getClientMimeType();

       //          $picture = new mediaLibrary();
       //          $picture->mime = $mimetype;
       //          $picture->original_filename = $originalname;
       //          $picture->filename = $path;     
       //          $picture->save();
        return redirect()->route('articles.index')
                        ->with('success','Article created successfully.');
// Media library
        
      
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $articles = Article::findOrFail($id);

        
        return view('articles.show',array('articles' => $articles));
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
        $category = Category::all();
        $articles = Article::findOrFail($id);

        $tags = Tag::where('article_id','=',$id)->first();

        return view('articles.edit',array('articles' => $articles,'category' => $category,'tags'=>$tags));
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
        request()->validate([
            'title'=>'required|max:220',
            'category_id'=>'required',            
            'show_date'=>'required',      
            'description'=>'required'
        ]);

        $records = Article::findOrFail($id);
        //find category Slug
          $categorySlug = Category::findOrFail($request->category_id);
          
          $mediacheck = mediaLibrary::first();//getting media id for else if condtion below
           
        if(Auth::user()->user_type != 'Admin_User'){

            $user = Auth::user()->id;
            $records->user_id = $user;
        }
        // if ($request->hasFile('image')) {
        //     if ($request->file('image')->isValid()) {
                
        //         $fileName=$request->file('image')->getClientOriginalName();
        //         if (file_exists('uploads/BlogImage/'. $records->image)) {
        //           unlink('uploads/BlogImage/'. $records->image);
        //         }
        //         $fileName =time()."_".$fileName;
        //         //upload
        //         $request->file('image')->move('uploads/BlogImage', $fileName);
        //         //column name 
        //         $records->image = $fileName;
        //     }
        // }
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();//Getting extension
                $originalname = $image->getClientOriginalName();//Getting original name

                if(file_exists($records['mediaLibrary']['filename'])) {
                    unlink($records['mediaLibrary']['filename']);
                }
                                
                $path = $image->move('uploads/media/', $originalname);
                $imgsizes = $path->getSize();
                $size = getimagesize($path);
                $width = $size[0]; 
                $height = $size[1];
                $mimetype = $image->getClientMimeType();//Get MIME type

if($records['image']===Null){
$photo = mediaLibrary::create([
                                'filename'=>$path,
                                'mime'=>$mimetype,
                                'extension'=>$extension,
                                'original_filename'=>$originalname,
                                'imgsize'=>$imgsizes,
                                'width'=>$width,
                                'height'=>$height
                              ]);
// $records['image'] = $photo->id ?? $records['image'];
}
elseif ($records['image']!=$mediacheck['id']) {
  $photo = mediaLibrary::create([
                                  'filename'=>$path,
                                  'mime'=>$mimetype,
                                  'extension'=>$extension,
                                  'original_filename'=>$originalname,
                                  'imgsize'=>$imgsizes,
                                  'width'=>$width,
                                  'height'=>$height
                                ]);
}
else{
  $photo = mediaLibrary::where('id',$records['image'])->update([
    'filename'=>$path,
    'mime'=>$mimetype,
    'extension'=>$extension,
    'original_filename'=>$originalname,
    'imgsize'=>$imgsizes,
    'width'=>$width,
    'height'=>$height
  ]);
}
$records['image'] = $photo->id ?? $records['image'];
// $records['image'] = $photo->id;
            }
        }
        $records->category_id = $request->category_id;   
        $records->title = $request->title;   
        $records->show_date = $request->show_date;   
        // $records->image = $request->image;   
        $records->description = $request->description;   
        $records->slug = $categorySlug->slug; 
        $records->aslug = $this->createSlug($request->title);
        if ($request->has('save'))
        {
                    // draft
            $records->draft = 0;
        }
        else if ($request->has('publish'))
        {
                    // publish
            $records->draft = 1;
        }   
        //Article::update($records);
        //$records->save();
        $records->save();
         
        $tagval =  DB::table('tags')->where('article_id', $records->id)->count();
        if($tagval==1){
             DB::table('tags')
            ->where('article_id', $records->id)
            ->update(['name' => $request->tags]);
        }else{
            $tagValue = array('articleSlug' => $records['aslug'], 'name'=>$request->tags,'article_id'=>$records->id);
        DB::table('tags')->insert($tagValue);
        }
       
            
           

        return redirect()->route('articles.index')
                        ->with('success','Article created successfully.');
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

        //Article::destroy($id);
        //return redirect()->route('articles.index')
                       // ->with('success','Article deleted successfully.');

        Article::where('id',$id)->update(['delete_status' => '0']);
        return redirect()->route('articles.index')->with('message','Article move to trash successfully!');

    }

    public function articlstatus(){

        
    }


    public function feed()
    {
        $posts = Article::orderBy('created_at', 'description')->take(20)->get();
        return view('feed.index')->with(compact('posts'));
    }

    public function myformAjax($id){
 
         $subcat = DB::table("subcategories")
                    ->where("category_id",$id)
                    ->pluck("subcategory_name","id");
                    
        return json_encode($subcat);


    }

    public function deleteMultiple(Request $request){
  
    // return json_encode($request->input());
    
       $ids = $request->ids;
      // Article::whereIn('id',explode(",",$ids))->delete();

        Article::whereIn('id',explode(",",$ids))->update(['delete_status' => '0']);


        return response()->json(['status'=>true,'message'=>"Article move to trash successfully."]);   

    }

     public function createSlug($title, $id = 0)
    {
        // Normalize the title
        $aslug = str_slug($title);
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allaSlugs = $this->getRelatedSlugs($aslug, $id);
        // If we haven't used it before then we are all good.
        if (! $allaSlugs->contains('aslug', $aslug)){
            return $aslug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newaSlug = $aslug.'-'.$i;
            if (! $allaSlugs->contains('aslug', $newaSlug)) {
                return $newaSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($aslug, $id = 0)
    {
        return Article::select('aslug')->where('aslug', 'like', $aslug.'%')
        ->where('id', '<>', $id)
        ->get();
    }

   
public function exportcsv()
{

       $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
        ,   'Content-type'        => 'text/csv'
        ,   'Content-Disposition' => 'attachment; filename=Article.csv'
        ,   'Expires'             => '0'
        ,   'Pragma'              => 'public'
        ];

        $list = Article::where('delete_status','=',1)->get()->toArray();
        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));

        $callback = function() use ($list) 
        {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) { 
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return Response::stream($callback, 200, $headers);
}

  public function activeArticle(){

     if(Auth::user()->privilege  === "administrator"){
             
            $articles = Article::with('category','user')->where([['article_status','=','1'],
              ['delete_status','=','1']])->orderBy('id','DESC')->get();
            $articles->toArray();
            $trashArticle = Article::where('delete_status','=',0)->count();
             $usertype = 'administrator';
            return view('articles.active',compact('articles','trashArticle','usertype'));
        }else{
              
              $whereArticle = [
                ['delete_status','=','1'],
                ['article_status','=','1'],
                ['user_id','=',Auth::user()->id]
              ];
            $articles = Article::with('category','user')->where($whereArticle)->orderBy('id','DESC')->get();
            $articles->toArray();
            $trashArticle = Article::where('delete_status','=',0)->count();
            $usertype = 'agent';
            return view('articles.active',compact('articles','trashArticle','usertype'));
        }        
  }

  public function inactiveArticle(){
     if(Auth::user()->privilege  === "administrator"){
             
            $articles = Article::with('category','user')->where([['article_status','=','0'],
              ['delete_status','=','1']])->orderBy('id','DESC')->get();
            $articles->toArray();
            $trashArticle = Article::where('delete_status','=',0)->count();
             $usertype = 'administrator';
            return view('articles.inactive',compact('articles','trashArticle','usertype'));
        }else{
              
              $whereArticle = [
                ['delete_status','=','1'],
                ['article_status','=','0'],
                ['user_id','=',Auth::user()->id]
              ];
            $articles = Article::with('category','user')->where($whereArticle)->orderBy('id','DESC')->get();
            $articles->toArray();
            $trashArticle = Article::where('delete_status','=',0)->count();
            $usertype = 'agent';
            return view('articles.inactive',compact('articles','trashArticle','usertype'));
        }        
  }

  public function featurearticle(){
    if(Auth::user()->privilege  === "administrator"){
             
            $articles = Article::with('category','user')->where([['status','=','1'],
              ['delete_status','=','1']])->orderBy('id','DESC')->get();
            $articles->toArray();
            $trashArticle = Article::where('delete_status','=',0)->count();
             $usertype = 'administrator';
            return view('articles.featureArticle',compact('articles','trashArticle','usertype'));
        }else{
              
              $whereArticle = [
                ['delete_status','=','1'],
                ['status','=','1'],
                ['user_id','=',Auth::user()->id]
              ];
            $articles = Article::with('category','user')->where($whereArticle)->orderBy('id','DESC')->get();
            $articles->toArray();
            $trashArticle = Article::where('delete_status','=',0)->count();
            $usertype = 'agent';
            return view('articles.featureArticle',compact('articles','trashArticle','usertype'));
        }        

  }
   
}
