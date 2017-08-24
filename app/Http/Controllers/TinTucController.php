<?php

namespace App\Http\Controllers;
use App\TheLoai;
use App\TinTuc;
use App\LoaiTin;
use Illuminate\Http\Request;


class TinTucController extends Controller
{
    //
    public function getDanhSach()
    {
    	$tintuc=TinTuc::orderBy('id','DESC')->paginate(10);
    	return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }
    public function getThem()

    {
    	$theloai=TheLoai::all();
    	$loaitin=LoaiTin::all();
    	return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postThem(Request $request)
    {
    	$this->validate($request,[
    				'Ten'=>'required|min:3|max:100|unique:TheLoai'
    		],[

    			'Ten.required'=>'Bạn chưa nhập tên',
    			'Ten.min'=>'Không đủ độ dài',
    			'Ten.max'=>'Tên quá dài',
    			'Ten.unique'=>'Tên thể loại đã tồn tại',
    		]);
    	$tintuc=new TinTuc;
    	$tintuc->TieuDe=$request->TieuDe;
    	$tintuc->TieuDeKhongDau=changeTitle($request->TieuDe);
    	$tintuc->TomTat=$request->TomTat;
    	$tintuc->NoiDung=$request->NoiDung;
    	if($request->hasFile('Hinh'))
    	{
    		$file=$request->file('Hinh');
    		$name=$file->getClientOriginalName();
    		$Hinh=srt_random(4)."_".$name;
    		$file->move("upload/tintuc",$Hinh);

    	}
    	else
    	{
    		$tintuc->Hinh="";
    	}
    	$tintuc->save();

    }
    public function getXoa($id)
    {
        $tintuc=TinTuc::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao','Xóa thành công " '.$tintuc->TieuDe.'"');
    }
}
