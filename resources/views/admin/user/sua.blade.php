@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thể loại
                            <small>{{$user->name}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors)>0)
                        <div class="alert alert-danger">

                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                        <form action="admin/theloai/sua/{{$user->id}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Tên người dùng</label>
                                <input class="form-control" name="Ten" value="{{$user->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input readonly="" class="form-control" name="Email" value="{{$user->email}}" />
                            </div>
                            <div class="form-group">
                                <label>Quyền</label>
                                <select class="form-control" name="quyen">
                                    <option  value="1" @if($user->quyen==1) {{"selected"}}@endif>Admin</option>
                                    <option  @if($user->quyen==0) {{"selected"}}@endif value="0">User</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Sửa mật khẩu</label>
                                <input type="checkbox" width="5px" id="check"/>
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input disabled="" id="Pass" class="form-control" name="Pass" placeholder="Nhập mật khẩu " />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input disabled=""  id="RePass" class="form-control" name="RePass" placeholder="Nhập lại mật khẩu" />
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

 @endsection
 @section('script')
 <script type="text/javascript">
        $(document).ready(function(){
           $("#check").change( function(){
            if( $(this).is(':checked') ) {
            $("#Pass").removeAttr("disabled");
            $("#RePass").removeAttr("disabled");
            }else{
            $("#Pass").attr("disabled","");
            $("#RePass").attr("disabled","");
            
            }    
            });
            });
        </script>
 @endsection