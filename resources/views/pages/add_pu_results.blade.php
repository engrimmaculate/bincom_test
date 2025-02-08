<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" 
          content="width=device-width, initial-scale=1.0">
    <title>Bincom Dev Test</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

</head>

<body class="px-0">
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
        PU Results
      </a>
      <a href="{{route('pu.search')}}" class="block mt-4 lg:inline-block lg:mt-0 text-white font-semibold mr-4">
        TOTAL LG RESULTS 
      </a>
      
    </div>
    <div>
      <a href="{{route('pu.create')}}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-indigo-600 hover:bg-white mt-4 lg:mt-0 font-semibold">ADD NEW POLLING UNITS</a>
    </div>
  </div>
</nav>
@if(!isset($data))
<div class="">
<!-- <div class="mt-10 sm:mx-auto sm:w-full  h-24 sm:max-w-sm mb-10">
    <div class="space-y-6 shadow-lg rounded-lg px-8 py-24 mt-32 h-2/3 TY">
        <a href="{{route('pu.search')}}" class="bg-indigo-600 text-white px-4 py-2 font-semibold rounded-lg">ADD NEW POLLING UNIT</a>  
    </div>
</div> -->


    <!-- Summed Results by a Local Government -->
     
     <div class="sm:mx-auto sm:w-full sm:max-w-xl mb-10 bg-gray-50">
        <h2 class="text-center font-bold mt-10">CREATE NEW POLLING UNIT</h2>
        <form class="space-y-6 shadow-lg rounded-lg px-8 py-6 mt-10" action="{{route('pu.store')}}" method="POST">
        @csrf
        <div class="flex flex-wrap -mx-3 mb-6">    
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    POLLING UNIT ID
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                    id="search" autocomplete="pu" name="pu"  type="text" placeholder="POLLING UNIT ID">
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                    id="id" autocomplete="id"  type="hidden" placeholder="POLLING UNIT ID" name="polling_unit_uniqueid">
                
                <!-- <p class="text-red-500 text-xs italic">Please fill out this field.</p> -->
                </div>
                <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    PARTY ABREVIATION
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                id="grid-last-name" type="text" placeholder="UNIQUE WARD ID" name="party_abreviation">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label for="email" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
               PARTY SCORE
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
            id="grid-party-score" type="text" placeholder="Party Score" name="party_score">
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label for="pu no" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">ENTERED BY</label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                id="grid-first-name" type="text" placeholder="Entered By" name="entered_by">
            </div>
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label for="email" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                DATE ENTERED
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
            id="grid-party-score" type="date" placeholder="Date Entered" name="date_entered">
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label for="pu no" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">USER IP</label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
                    id="grid-first-name" type="text" placeholder="USER IP"
                    value="{{request()->ip()}}"
                    name="user_ip_address"
                    >
            </div>
        </div>
        
        
        <div>
            <button type="submit" 
            onclick="" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">UPLOAD RESULTS</button>
        </div>
    </div>
    </form>
    </div>
    </div>
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