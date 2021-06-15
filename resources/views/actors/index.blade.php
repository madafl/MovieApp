@extends('layouts.main')

@section('content')
    <div class="container" >
        <div><h3>Actori</h3></div>
        <div class="row">
        @foreach ($popularActors as $actor)
            <div class="col-sm" style="padding:10px;">
                <div class="card" style="width:250px;padding:10px;margin-bottom:5px;">
                    <a href="{{route('actors.show', $actor['id'])}}" style="text-decoration:none;color:black;">
                        @if ($actor['profile_path'] != null)
                            <img  class="card-img-top" src="{{ 'https://image.tmdb.org/t/p/w185/'.$actor['profile_path'] }}" style="width:100%;padding:5px;">
                        @else
                            <img  href="{{route('actors.show', $actor['id'])}}" class="card-img-top" src='https://www.almamater.ro/wp-content/uploads/2020/02/No-picture-3.png'style="width:91%;padding:5px;" >
                        @endif
                        <p>{{$actor['name']}}</p> 
                    </a>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection
