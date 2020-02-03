@extends('layouts.app')

@section('content')

<div class="col-12">
    <a href="{{route('posts.create')}}" class="btn btn-lg btn-success">Cadastro</a>
</div>

<div class="container">
    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titulo</th>
                    <th>Criado em </th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->created_at}} </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Não existem dados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>



    </div>

    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            {{ $posts->links() }}
        </div>
    </div>

</div>

@endsection
