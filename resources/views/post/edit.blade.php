@extends('layouts.main')
@section('content')
    <div class="row">

        <div class="col-sm-8 blog-main">
                <form action="/posts/{{$post->id}}" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    <label>标题</label>
                    <input name="title" type="text" class="form-control" placeholder="这里是标题" value="{{$post->title}}">
                </div>
                <div class="form-group">
                    <label>内容</label>
                    <textarea id="content" name="content" class="form-control" style="height:400px;max-height:500px;"  placeholder="这里是内容">
                        {{$post->content}}
                    </textarea>
                </div>

                    @if(count($errors) > 0)
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </div>
                    @endif

                <button type="submit" class="btn btn-default">提交</button>
            </form>
            <br>
        </div>

        <div id="sidebar" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        </div>
    </div>
@endsection
