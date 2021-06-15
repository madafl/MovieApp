<div class="container">
<div class="dropdown" style="float:right">
            <form class="form-inline my-2 my-lg-0" action="{{ route('search', $search) }}" method="POST"  >
                <input wire:model="search" type="search" class="form-control rounded" onchange="checkFilled();" placeholder="Search" aria-label="Search" aria-describedby="search-addon" id="drp" value="{{$search}}" name="search"/>
                <button class="btn btn-dark" type="submit">
                    <i class="fa fa-search" style="color: #e28613;"></i>
                </button>
            </form>
        <div>
          <!-- submit form -> redirectioneaza catre o pagina cu toate rezultatele -->
            <ul class="dropdown-menu" id="dropdown" style="list-style-type: none; ">
           
                @foreach ($searchResults as $result)
                    <li> 
                        <a href="{{route('movies.show', $result['id'])}}" style="text-decoration:none;color:black;">
                            @if ($result['poster_path'] != null)
                                <img class="img-fluid" src="{{ 'https://image.tmdb.org/t/p/w185/'.$result['poster_path'] }}" style="width: 25%;padding: 5px;">
                                {{$result['title']}}</a>
                            @else
                                <img class="img-fluid" src= 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1Zco_AzlB5030ccqs-SkdHxO_PmzfBw5sjXSKCjfaX46A9-YEg-9_vjqAHsvgQTw3kbw&usqp=CAU' style="width: 25%;padding: 5px;">
                                {{$result['title']}}</a>
                            @endif
                    </li>
                   <hr/>
                @endforeach 
            </ul>
        </div>
    </div>
</div>

 <script type="text/javascript">
     function checkFilled() {
        var inputVal = document.getElementById("drp");
        var dropdownElement = document.getElementById("dropdown");
        if (inputVal.value == "") {
            dropdownElement.style.display = "none";
        }
        else{
            dropdownElement.style.display = "block";
        }
    }
 </script>

<!-- on enter=> trimite rezulattele din input catre un alt view si adauga pagina -->