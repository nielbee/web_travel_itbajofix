

<div>
    <script src="https://cdn.tailwindcss.com"></script>


<div class="grid grid-cols-1 gap-4">
    <div class ="p-4">
        <button wire:click="openModal" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Add
        </button>
        
    </div>

</div>

<br><br>

<table class="min-w-full border border-gray-200">
    <thead>
        <td>NUMBER</td>
        <td>Brand</td>
        <td>Model</td>
        <td>Price</td>
        <td>Available</td>
        <td>Action</td> 
    </thead>
    <tbody>

        
        @foreach ($vehicles as $v)
            <tr>

             
                <td class="px-4 py-2">{{$v->plate_number}}</td>
                <td class="px-4 py-2">{{$v->brand}}</td>
                <td class="px-4 py-2">{{$v->model}}</td>
                <td class="px-4 py-2">Rp. {{$v->price}}</td>
                <td class="px-4 py-2">
                    @if ($v->availability)
                        <span class="text-green-600">Available</span>
                    @else
                        <span class="text-red-600">Not Available</span>
                    @endif
                </td>
                <td class="px-4 py-2">
                    <a  href='vehicles/toogleavailability/{{ $v->plate_number }}' class    
                        ="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 transition"
                    >
                        Toggle Availability
                    </a>
                    <a href='vehicles/delete/{{ $v->plate_number }}' onclick= "return confirmLink()"     
                       class ="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 transition"
                    >  
                        Delete
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- 
@foreach ($vehicles as $v )
    <p>{{$v->brand}} - {{$v->model}}  Rp. {{$v->price}}</p>
    <hr>
@endforeach --}}





<!-- modal begin -->
<div 
    x-data="{ open: @entangle('showModal') }"
    x-show="open"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
>

    <!-- Modal content -->
    <div @click.away="open = false" class="bg-white dark:bg-zinc-900 p-6 rounded shadow max-w-lg w-full">
        
        <button 
            @click = "open = false" 
            c class="px-2 py-2 rounded bg-red-600 hover:bg-red-700 text-white font-semibold shadow transition"
        >
            X
        </button>
    
        <h2 class="text-xl font-bold mb-4">Add Vehicles</h2>
        <form method = "POST" action="{{route('vehicles.save')}}" enctype="multipart/form-data" class="space-y-4 max-w-lg mx-auto p-6 bg-white dark:bg-zinc-900 rounded shadow">
             @csrf
            <div>
        <label class="block text-sm font-bold mb-1 text-zinc-800 dark:text-zinc-100">License Number</label>
        <input type="text" name="id" class="w-full border border-gray-300 dark:border-zinc-700 rounded px-3 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div>
        <label class="block text-sm font-bold mb-1 text-zinc-800 dark:text-zinc-100">Brand</label>
        <input type="text" name="brand" class="w-full border border-gray-300 dark:border-zinc-700 rounded px-3 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div>
        <label class="block text-sm font-bold mb-1 text-zinc-800 dark:text-zinc-100">Model</label>
        <input type="text" name="model" class="w-full border border-gray-300 dark:border-zinc-700 rounded px-3 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
   

    <div>
        <label class="block text-sm font-bold mb-1 text-zinc-800 dark:text-zinc-100">Photo 1</label>
        <input type="file" name="pict1" class="w-full border border-gray-300 dark:border-zinc-700 rounded px-3 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100">
    </div>

    <div>
        <label class="block text-sm font-bold mb-1 text-zinc-800 dark:text-zinc-100">Photo 2</label>
        <input type="file" name="pict2" class="w-full border border-gray-300 dark:border-zinc-700 rounded px-3 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100">
    </div>

    <div>
        <label class="block text-sm font-bold mb-1 text-zinc-800 dark:text-zinc-100">Photo 3</label>
        <input type="file" name="pict3" class="w-full border border-gray-300 dark:border-zinc-700 rounded px-3 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100">
    </div>

    <div>
        <label class="block text-sm font-bold mb-1 text-zinc-800 dark:text-zinc-100">Price</label>
        <input type="number" name="price" class="w-full border border-gray-300 dark:border-zinc-700 rounded px-3 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

<div>
    <label class="block text-sm font-bold mb-1 text-zinc-800 dark:text-zinc-100">Availibility</label>
    <div class="flex gap-2">
        <input type="radio" name="available" value="1"  wire:model="available" class="mr-1">
        <label class="text-zinc-800 dark:text-zinc-100">Available</label>
        <input type="radio" name="available" value="0" wire:model="available" class="mr-1">
        <label class="text-zinc-800 dark:text-zinc-100">Not Available</label>
    </div>
</div>

    <div>
        <button wire:click="save" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Save</button>
    </div>
</form>
        
    </div>
</div>
<!-- modal end -->





@if (session()->has('message'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 2000)" 
        x-show="show"
        class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow transition-opacity duration-500"
    >
        {{ session('message') }}
    </div>
@endif

</div>



<script>
  function confirmLink() {
    return confirm("Are you sure you want to delete this package?");
  }
</script>