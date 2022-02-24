@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    My posts
                    <ul>

                    </ul>
                    <table class="table table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Body</th>
                            <th>Published By</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>

                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                        <tr>
                            {{-- <a href="/post/view{{$post->id}}"> {{$post->title}}</a> --}}
                            <td>{{$post->id}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->body}}</td>                            
                            <td>{{$post->user->name}}</td>                            
                            <td>{{$post->created_at->diffForHumans()}}</td>
                            <td>{{$post->updated_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{route('post.view',$post->id)}}"><button class="btn btn-warning"> <i class="fa-solid fa-pen-to-square"></i> </button></a>
                                <a href="{{route('post.delete',$post->id)}}"><button class="btn btn-danger"><i class="fa-solid fa-trash"></i> </button></a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a href="{{route('post.create')}}"><button class="btn btn-primary"> Create new post </button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
