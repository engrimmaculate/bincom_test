<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" 
          content="width=device-width, initial-scale=1.0">
    <title>Bincom Dev Center</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

</head>

<body class="px-0 py-0">
<nav class="flex items-center justify-between flex-wrap bg-indigo-600 p-6">
  <div class="flex items-center flex-shrink-0 text-white mr-6">
    <img class="h-16 w-32 mr-4" src="{{asset('binocmacademylogo.png')}}" alt="Bincom Dev Center">
    <span class="font-semibold text-xl tracking-tight">Bincome Dev Center</span>
  </div>
  <div class="block lg:hidden">
    <button class="flex items-center px-3 py-2 border rounded text-white border-teal-400 hover:text-white hover:border-white">
      <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Home</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
    </button>
  </div>
  <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
    
    <div class="text-sm lg:flex-grow">
      <a href="{{route('pu.search')}}" class="block mt-4 lg:inline-block lg:mt-0 text-white font-semibold mr-4">
        Search PU Results
      </a>
      <a href="{{route('pu.search')}}" class="block mt-4 lg:inline-block lg:mt-0 text-white font-semibold mr-4">
        TOTAL PU Results BY LGA
      </a>
      
    </div>
    <div>
      <a href="{{route('pu.create')}}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-indigo-600 hover:bg-white mt-4 lg:mt-0 font-semibold">
        ADD NEW POLLING UNIT RESULTS
    </a>
    </div>
  </div>
</nav>
@isset($summed_results)
@if(count($summed_results) <= 0)
<div class="alert alert-danger text-danger" role="alert">
    <script>
        alert('No Results Found for the Local government Specified') 
    </script>
</div>

@endif
@endisset
@if(session('success'))
<div class="alert alert-danger text-danger" role="alert">
    <script>
        alert('{{ session("success") }}') 
    </script>
</div>

@endif

@if(!isset($data))
<div class="md:flex md:flex-row text-center">

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm mb-10">
            <form class="space-y-6 shadow-lg rounded-lg px-8 py-6 mt-32" action="{{route('pu.results.show')}}" method="GET">
                <div>
                    <h2 class="text-center font-bold">Bincom Dev Center</h2>
                    <label for="email" class="block text-sm/6 font-semibold text-gray-900 text-center">Search Results by Polling Unit Number</label>
                    <div class="mt-2">
                    <input type="text" name="pu" id="search" autocomplete="pu" 
                        placeholder="Search Result By Individual Polling Unit" 
                        required class="block w-full rounded-md bg-white px-3 py-2 text-base text-gray-900 outline-1 shadow-lg rounded-lg -outline-offset-2 outline-indigo-600 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        <span id="pu_name" class="text-red-600 py-2 px-4 text-lg mt-2"></span>
                    <input type="hidden" name="id" id="id" autocomplete="id" 
                        placeholder="This Shows the Unique of the Polling Units"  
                        required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-600 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    <input type="hidden" name="pu_name" id="pu_n"  autocomplete="id" 
                        placeholder="This Shows the Unique of the Polling Units"  
                        required />
                    
                    </div>
                </div>

                <div>
                    <button type="submit" onclick="" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Search</button>
                </div>
            </form>
    </div>

    <!-- Summed Results by a Local Government -->
     
     
     <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm mb-10">
            <form class="space-y-6 shadow-lg rounded-lg px-8 py-6 mt-32" action="{{route('pu.results.summed')}}" method="GET">
                <div>
                    <h2 class="text-center font-bold">SUMMED RESULTS BY LOCAL GOVERMENT</h2>
                    <label for="email" class="block text-sm/6 font-semibold text-gray-900 text-center">Search Results by BY Local Government</label>
                    <div class="mt-2">
                    
                    <select name="lga" id="lga" required size="1" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-600 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        <option value="">Select LGA</option>
                        @foreach($lgas as $lga)
                            <option value="{{$lga->lga_id}}">{{$lga->lga_name}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <div>
                    <button type="submit" onclick="" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Search</button>
                </div>
            </form>
    </div>
    </div>
    @endif
    @isset($data)
    <h1 class="text-center text-2xl text-green-700 mt-10">
        Polling Unit Results  
        <a href="{{route('pu.search')}}" class="bg-indigo-600 text-white px-4 py-2 font-semibold rounded-lg">Search Again</a>
      </h1>
    <h3 class="text-center text-2xl text-green-700 my-4">
             Showing Individual Polling Unit Resuts For  <span  class="text-indigo-600 font-bold">{{$data['pu_name']}} </span> 
      </h3>
      
    <table class="table-auto  mt-10 sm:mx-auto sm:w-full sm:max-w-sm mb-10 bg-white border border-gray-300 w-[600px]" >
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">ID</th>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Score</th>
                <th class="border border-gray-300 px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $key=>$value)
            <tr class="">
                <td class="border border-gray-300 px-4 py-2">{{$key+1}}</td>
                <td class="border border-gray-300 px-4 py-2">{{$value->party_abbreviation}}</td>
                <td class="border border-gray-300 px-4 py-2">{{$value->party_score}}</td>
                <td class="border border-gray-300 px-4 py-2 flex flex-row space-x-5">
                    <!-- <a href="{{ route('pu.results.edit', $key)}}" class="bg-indigo-600 text-white px-4 py-2 font-semibold text-lg rounded-lg">Edit</a>
                    <form action="{{ route('pu.results.destroy', $key)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class=" bg-red-600 text-white px-4 py-2 font-semibold text-lg rounded-lg" id="search">Delete</button>
                    </form>     -->
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
    @endisset

    <!-- Showing Summed Results by Selected LGA -->
    @isset($summed_results)
    <h1 class="text-center text-2xl text-green-700">
        Summed Polling Unit Results  
      </h1>
    <h3 class="text-center text-2xl text-green-700 my-4">
             Showing Sumemd  Polling Unit Resuts For  <span  class="text-indigo-600 font-bold">{{$lga?->lga_name}} </span> 
      </h3>
      
    <table class="table-auto  mt-10 sm:mx-auto sm:w-full sm:max-w-sm mb-10 bg-white border border-gray-300 w-[600px]" >
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">ID</th>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">SUMMED VALUE</th>
                <th class="border border-gray-300 px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
        @isset($summed_results)
        @if(count($summed_results) <= 0)
        <tr class="">
                <td colspan="4" class="border border-gray-300 px-4 py-2">No Results found for the LGA</td>
            </tr>
        @else
            @foreach($summed_results as $key=>$value)
            <tr class="">
                <td class="border border-gray-300 px-4 py-2">{{$key+1}}</td>
                <td class="border border-gray-300 px-4 py-2">{{$value->lga_name}}</td>
                <td class="border border-gray-300 px-4 py-2">{{$value->score}}</td>
                <td class="border border-gray-300 px-4 py-2 flex flex-row space-x-5">
                    <!-- <a href="{{ route('pu.results.edit', $key)}}" class="bg-indigo-600 text-white px-4 py-2 font-semibold text-lg rounded-lg">Edit</a>
                    <form action="{{ route('pu.results.destroy', $key)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class=" bg-red-600 text-white px-4 py-2 font-semibold text-lg rounded-lg" id="search">Delete</button>
                    </form>     -->
                </td>
            </tr>
            @endforeach
        @endif
        @endisset
        </tbody>
    </table>
    @endisset
</body>




<script>

    var path = "{{ route('pu.results') }}";

    $( "#search" ).autocomplete({

        source: function( request, response ) {

          $.ajax({

            url: path,

            type: 'GET',

            dataType: "json",

            data: {

               search: request.pu

            },

            success: function( data ) {

               response( data );

            }

          });

        },

        select: function (event, ui) {

           $('#search').val(ui.item.label);
           $('#id').val(ui.item.uniqueid);
           let pu_details = ui.item.polling_unit_name + "( " + ui.item.label + " )";
           $('#pu_name').text(pu_details);
           $('#pu_n').val(ui.item.polling_unit_name);
           console.log(ui.item); 

           return false;

        }

    });

  
// fetch the data from server for the selected polling unit result
</script>
</html>