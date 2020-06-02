@extends('layouts.main')
@section('content')
        <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <div style="display:inline-flex">
                    <h2 class="blog-post-title">{{$post->title}}</h2>
                    @can('update',$post)
                    <a style="margin: auto"  href="/posts/{{$post->id}}/edit">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>
                    @endcan
                    @can('delete',$post)
                    <a style="margin: auto"  href="/posts/{{$post->id}}/delete">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                    @endcan
                </div>

                <p class="blog-post-meta">{{$post->created_at->toRfc7231String()}}<a href="#">{{$post->user->name}}</a></p>

                <p>{!! $post->content !!}</p>

                <div>
                    @if($zan[0]->count == 0)
                    <a href="/posts/{{$post->id}}/zan" type="button" class="btn btn-primary btn-lg">赞</a>
                    @else
                    <a href="/posts/{{$post->id}}/deletezan" type="button" class="btn btn-primary btn-lg">取消赞</a>
                    @endif
                </div>
            </div>



            @if(count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif

        </div>
@endsection

