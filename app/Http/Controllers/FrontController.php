<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CRUDBooster;

use DB;
class FrontController extends Controller
{
    //
    public $blog_name = 'My Simple Blog' ; 
    public function getIndex(){
        $data['page_title'] = 'Home Page';
        $data['page_description'] = 'This is my simple blog'; 
        $data['blog_name'] = $this->blog_name; 
        $data['categories']= DB::table('categories')->get(); 
        $data['result'] = DB::table('posts')->
        join('categories' , 'categories.id' , '=' , 'category_id')->
        join('cms_users' , 'cms_users.id' , '=' , 'cms_users_id')->
        select('posts.*', 'categories.name as name_categories' , 'cms_users.name as name_authors')
        ->orderby('posts.id' , 'desc')->take(5)->get();
        return view ('index', $data); 

        ; 
    }
    public function getArticle($slug){
        $data['row'] = DB::table('posts')->
        join('categories' , 'categories.id' , '=' , 'category_id')->
        join('cms_users' , 'cms_users.id' , '=' , 'cms_users_id')->
        select('posts.*', 'categories.name as name_categories' , 'cms_users.name as name_authors')
        ->where('posts.slug' , $slug)->first();
        $data['categories']= DB::table('categories')->get();
        return view ('details', $data); 
    
}
public function getByCategories($id){
    $data['rows'] = DB::table('posts')->
    join('categories' , 'categories.id' , '=' , 'category_id')->
    join('cms_users' , 'cms_users.id' , '=' , 'cms_users_id')->
    select('posts.*', 'categories.name as name_categories' , 'cms_users.name as name_authors')
    ->where('posts.category_id' , $id)->paginate(5);
    $data['categories']= DB::table('categories')->get();
    return view ('cat', $data); 
}
public function getLatest(){
    $data['row'] = DB::table('posts')->
    join('categories' , 'categories.id' , '=' , 'category_id')->
    join('cms_users' , 'cms_users.id' , '=' , 'cms_users_id')->
    select('posts.*', 'categories.name as name_categories' , 'cms_users.name as name_authors')
    ->orderby('posts.id' , 'desc')->paginate(2);
    $data['categories']= DB::table('categories')->get();
    return view ('latest', $data); 
}
public function getSearch(Request $request){
    if ($request->q =='') return redirect('/');
    $data['row'] = DB::table('posts')->
    join('categories' , 'categories.id' , '=' , 'category_id')->
    join('cms_users' , 'cms_users.id' , '=' , 'cms_users_id')->
    select('posts.*', 'categories.name as name_categories' , 'cms_users.name as name_authors')
    ->where('posts.title' ,'like' ,'%' . $request->q . '%')->paginate(2);
    $data['categories']= DB::table('categories')->get();
    return view ('latest', $data); 
}
public function notf(){
$config['content'] = "Hellow World";
$config['to'] = CRUDBooster::adminPath('/admin');
$config['id_cms_users'] = [1,2]; //This is an array of id users
CRUDBooster::sendNotification($config);
}
}
