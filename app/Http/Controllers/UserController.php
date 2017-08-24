<?php

namespace App\Http\Controllers;
use App\User;
use App\LoaiTin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    
class UserController extends Controller
{
    //
    public function getDanhSach()
    {
    	$user=User::all();
    	return view('admin.user.danhsach',['user'=>$user]);
    }
    public function getThem()
    {
    	
    	return view('admin.user.them');
    }
    public function postThem(Request $request)
    {
    	$this->validate($request,[
    				'User'=>'required|min:3|max:100|unique:users,name',
    				'Pass'=>'required|min:3|max:100',
    				'Email'=>'required|email|unique:users,email',
    				'RePass'=>'required|same:Pass'
    		],[

    			'User.required'=>'Bạn chưa nhập tên',
    			'User.min'=>'Tên không đủ độ dài',
    			'User.max'=>'Tên quá dài',
    			'RePass.required'=>'Bạn chưa nhập lại mật khẩu',
    			'User.unique:users,name'=>'Tên đã tồn tại',
    			'Pass.required'=>'Bạn chưa nhập mật khẩu',
    			'Pass.min'=>'Mật khẩu đủ độ dài',
    			'Pass.max'=>'Mật khẩu quá dài',
    			'Email.required'=>'Bạn chưa nhập email',
    			'Email.unique:users,email'=>'Email đã tồn tại',
    			'Email.email'=>'Vui lòng nhập chính xác địa chỉ email',
    		]);
    	$user=new User;
    	$user->name=$request->User;
    	$user->email=$request->Email;	
    	$user->quyen=$request->get('quyen');
    	$user->password=md5($request->Pass);
    	$user->save();	
    	return redirect('admin/user/them')->with('thongbao','Thêm user thành công');
    }
    public function getXoa($id)
    {
    	$user=User::find($id);
    	$user->delete();
    	return redirect('admin/user/danhsach')->with('thongbao','Xóa thành công "'.$user->name.'"');
    }
    public function getSua($id)
    {
    	$user=User::find($id);
    	
    	return view('admin.user.sua',['user'=>$user]);
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
    public function getdangnhapAdmin()
    {

    	return view('admin.dangnhap.login');
    }
    public function postdangnhapAdmin(Request $request)
    {
    	$this->validate($request,[
            'email'=>'required|email',
            'password'=>'required|min:3|max:30'
            ],[
            'email.email'=>'Không đúng định dạng email',
            'email.required'=>'Bạn chưa nhập email',
            'password.required'=>'Bạn chưa nhập password',
            'password.min'=>'Mật khẩu quá ngắn',
            'password.max'=>'Mật khẩu quá dài'
            ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            redirect('admin/theloai/danhsach');
        }
        else
        {
            redirect('admin/dangnhap')->with('thongbao','Đăng nhập thất bại');
        }
    }
}
