<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
header('Access-Control-Allow-Origin: *');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/addItem',function(Request $req){
	$name = Storage::put('public', $req->file('img'));
    $path=Storage::url($name);
  	$id = App\Stuff::insertGetId(
	         [
				"title"=>$req->title,
				"description"=>$req->desc,
				"status"=>$req->status,
				"contact"=>$req->contact,
				"done"=>0,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
				'image'=>$path
			]
	);
	$result = [
		"message"=>"Объявление добавлено",
		"id"=>$id
	];
	return $result;
});
Route::get('/deviceId', function(Request $req) {
	header('Access-Control-Allow-Origin: *');
    $API_ACCESS_KEY = 'AIzaSyDG3fYAj1uW7VB-wejaMJyJXiO5JagAsYIAIzaSyBNwTHzLZpvUDzOyxJLmnHU30KllbZjdIY';
   
    $msg = array(
    	"message"=>"hello",
    	"vibrate"=>1,
    	"sound"=>1,
    	'smallIcon'=>'small_icon'
    );
    $fields = array(
    	
    );
    return $req->id;
});
Route::get('/main',function(){
	header('Access-Control-Allow-Origin:*');
	return App\Stuff::orderBy('created_at','desc')->where('done',0)->take(3)->get();
});
Route::get('/found',function(){
	header('Access-Control-Allow-Origin:*');
	return App\Stuff::orderBy('created_at','desc')->where('done',0)->where('status',1)->get();
});
Route::get('/lost',function(){
	header('Access-Control-Allow-Origin:*');
	return App\Stuff::orderBy('created_at','desc')->where('done',0)->where('status',0)->get();
});
Route::get('/search',function(Request $req){
	header('Access-Control-Allow-Origin:*');
	 return App\Stuff::where('title','like',"%{$req->search}%")->orWhere('description','like',"%{$req->search}%")->get();
});
Route::get('/addItem',function(Request $req){
	header('Access-Control-Allow-Origin:*');
		$id = App\Stuff::insertGetId(
	         [
				"title"=>$req->title,
				"description"=>$req->desc,
				"status"=>$req->status,
				"contact"=>$req->contact,
				"done"=>0,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			]
		);
	$result = [
		"message"=>"Объявление добавлено",
		"id"=>$id
	];
	return $result;
});
Route::get('/getMyItem',function(Request $req){
	header('Access-Control-Allow-Origin:*');
	return App\Stuff::find($req->id);
});
Route::get('/updateItem', function(Request $req){
			header('Access-Control-Allow-Origin:*');
		App\Stuff::where('id',$req->id)->update(["done"=>1]);
		return "сделано";
});
Route::post('/uploadImg',function(Request $req){
	Log::info('app.requests', ['request' => $request->all()]);
	header('Access-Control-Allow-Origin:*');
	return "ok";
});

Route::get('/log', function(Request $request) {
	//Log::info('app.requests', ['request' => $request->all()]);
	return "log";
});