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

@if(session('success'))
<div class="alert alert-danger text-danger" role="alert">
    <script>
        alert('{{ session("success") }}') 
    </script>
   
</div>
<table class="table-auto  mt-10 sm:mx-auto sm:w-full sm:max-w-sm mb-10 bg-white border border-gray-300 w-[600px]" >
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">ID</th>
                <th class="border border-gray-300 px-4 py-2">PARTY</th>
                <th class="border border-gray-300 px-4 py-2">RESULTS</th>
                <th class="border border-gray-300 px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
        @isset($latest_results)
        @if(count($latest_results) <= 0)
        <tr class="">
                <td colspan="4" class="border border-gray-300 px-4 py-2">No Results found for the LGA</td>
            </tr>
        @else
       
            @foreach($latest_results as $key=>$value)
            <tr class="">
                <td class="border border-gray-300 px-4 py-2">{{$key+1}}</td>
                <td class="border border-gray-300 px-4 py-2">{{$value->party_abbreviation}}</td>
                <td class="border border-gray-300 px-4 py-2">{{$value->party_score}}</td>
                <td class="border border-gray-300 px-4 py-2 flex flex-row space-x-5">
                    <a href="{{ route('pu.results.edit', $key)}}" class="bg-indigo-600 text-white px-4 py-2 font-semibold text-lg rounded-lg">Edit</a>
                    <form action="{{ route('pu.results.destroy', $key)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class=" bg-red-600 text-white px-4 py-2 font-semibold text-lg rounded-lg" id="search">Delete</button>
                    </form>    
                </td>
            </tr>
            @endforeach
        @endif
        @endisset
        </tbody>
    </table>
@endif


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