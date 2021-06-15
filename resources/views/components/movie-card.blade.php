<!-- afisarea filmelor -->
<div class="card" style="width:250px;padding:10px;margin-bottom:5px;">
    <a href="{{route('movies.show', $movie['id'])}}" style="text-align:center;"> 
        <img class="card-img-top" src="{{ 'https://image.tmdb.org/t/p/w185/'.$movie['poster_path'] }}" style="width:100%;padding:5px;">
    </a>

    <h5 class="card-title">
        <a href="{{route('movies.show', $movie['id'])}}" style="text-decoration:none;font-size:16px;color:#e28613;">{{ $movie['title']}}</a>
    </h5>
    
    <div class="card-body">
        <p class="card-text">Nota: {{$movie['vote_average']}}/10</p>
        <p class="card-text">Premiera:
            {{ \Carbon\Carbon::parse($movie['release_date'])->format('d.m.Y') }}</p>
        <p class="card-text">Genuri:
            @foreach ($movie['genre_ids'] as $genre )
                {{$genres->get($genre)}}  @if (!$loop->last) @endif
             @endforeach
        </p>
    </div>
    
<!-- recommendations -->
</div>
