<?php

namespace App\Http\Controllers;
use App\LoaiTin;
use App\TheLoai;
use Illuminate\Http\Request;

class LoaiTinController extends Controller
{
    //
    public function getDanhSach()
    {
    	$loaitin=LoaiTin::all();
    	return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }
    public function getThem()
    {
    	$theloai=TheLoai::all();
    	return view('admin.loaitin.them',['theloai'=>$theloai]);
    }
    public function postThem(Request $request)
    {
    	$this->validate($request,[
    				'Ten'=>'required|min:3|max:100|unique:TheLoai'
    		],[

    			'Ten.required'=>'Bạn chưa nhập tên',
    			'Ten.min'=>'Không đủ độ dài',
    			'Ten.max'=>'Tên quá dài',
    			'Ten.unique:LoaiTin,Ten'=>'Tên thể loại đã tồn tại',
    		]);
    	$loaitin=new LoaiTin;
    	$loaitin->Ten=$request->Ten;
    	$loaitin->idTheLoai=$request->get('TheLoai');	
    	$loaitin->TenKhongDau=changeTitle($request->Ten);
    	$loaitin->save();
    	return redirect('admin/loaitin/them')->with('thongbao','Thêm loại tin thành công');
    }
    public function getXoa($id)
    {
    	$loaitin=LoaiTin::find($id);
    	$loaitin->delete();
    	return redirect('admin/loaitin/danhsach')->with('thongbao','Xóa thành công');
    }
    public function getSua($id)
    {
    	$loaitin=LoaiTin::find($id);
    	$theloai=TheLoai::all();
    	return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id)
    {
    	$loaitin=LoaiTin::find($id);
    	$this->validate($request,[
    				'Ten'=>'required|min:3|max:100|unique:TheLoai'
    		],[

    			'Ten.required'=>'Bạn chưa nhập tên',
    			'Ten.min'=>'Không đủ độ dài',
    			'Ten.max'=>'Tên quá dài',
    			'Ten.unique'=>'Tên thể loại đã tồn tại',
    		]);
    	$loaitin->Ten=$request->Ten;
    	$loaitin->idTheLoai=$request->get('TheLoai');
    	$loaitin->save();
    	return redirect('admin/loaitin/danhsach')->with('thongbao','Sửa thành công');
    }
}
