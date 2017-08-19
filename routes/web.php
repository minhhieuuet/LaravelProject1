<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\TheLoai;
Route::get('/', function () {
    return view('welcome');
});
Route::get('test',function(){
	$theloai=TheLoai::find(1);
	foreach ($theloai ->loaitin as $loaitin) {
		# code...
		echo $loaitin->Ten."<br>";
	}
});
Route::group(['prefix'=>'admin'],function(){
	Route::group(['prefix'=>'theloai'],function(){
		Route::get('danhsach','TheLoaiController@getDanhSach');
		Route::get('sua','TheLoaiController@getSua');
		Route::get('them','TheLoaiController@getThem');
	});
	Route::group(['prefix'=>'loaitin'],function(){
		Route::get('danhsach','TheLoaiController@getDanhSach');
		Route::get('sua','TheLoaiController@getSua');
		Route::get('them','TheLoaiController@getThem');
	});
	Route::group(['prefix'=>'tintuc'],function(){
		Route::get('danhsach','TheLoaiController@getDanhSach');
		Route::get('sua','TheLoaiController@getSua');
		Route::get('them','TheLoaiController@getThem');
	});
	Route::group(['prefix'=>'slide'],function(){
		Route::get('danhsach','TheLoaiController@getDanhSach');
		Route::get('sua','TheLoaiController@getSua');
		Route::get('them','TheLoaiController@getThem');
	});
});