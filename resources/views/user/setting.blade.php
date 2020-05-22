@extends('layouts.main')
@section('content')

    <div class="col-sm-8 blog-main">

        <form class="form-horizontal" action="/user/me/setting" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-10">
                    <input class="form-control" name="name" type="text" value="{{$user->name}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">头像</label>
                <div class="col-sm-2">
                    <input class=" file-loading preview_input" type="file" style="width:72px" name="photo">
                    <img class="preview_img" src="{{$user->photo}}" alt="" class="img-rounded" style="border-radius:500px;">
                </div>
            </div>
            @if(count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
            <button type="submit" class="btn btn-default">修改</button>
        </form>
        <br>

    </div>

@endsection