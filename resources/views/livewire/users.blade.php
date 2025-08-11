<div>
   

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
   @foreach ($users as $p)
        <tr>
            <td class="px-4 py-2">
                <p>{{ $p->name }}</p>
            </td>
            <td class="px-4 py-2">
                <p>{{ $p->email }}</p>
            </td>

          
            <td class="px-4 py-2">
                <button wire:click="delete('{{ $p->id }}')"  onclick='return confirmLink()'>
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 hover:text-red-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3" />
                     </svg>
                </button>
            </td>
        </tr> 
    <hr>
    @endforeach 
</table>







<!-- modal begin -->
<div 
    x-data="{ open: @entangle('showModal') }"
    x-show="open"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
>

    <!-- Modal content -->
    <div @click.away="open = false" class="bg-white dark:bg-zinc-900 p-6 rounded shadow max-w-lg w-full">
        @csrf
        <button 
            @click = "open = false" 
            c class="px-2 py-2 rounded bg-red-600 hover:bg-red-700 text-white font-semibold shadow transition"
        >
            X
        </button>
        <h2 class="text-xl font-bold mb-4">Add Users</h2>
    <div>
        <label class="block text-sm font-bold mb-1 text-zinc-800 dark:text-zinc-100">email</label>
        <input type="text" wire:model="email" class="w-full border border-gray-300 dark:border-zinc-700 rounded px-3 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div>
        <label class="block text-sm font-bold mb-1 text-zinc-800 dark:text-zinc-100">name</label>
        <input type="text" wire:model="name" class="w-full border border-gray-300 dark:border-zinc-700 rounded px-3 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div>
        <label class="block text-sm font-bold mb-1 text-zinc-800 dark:text-zinc-100">password</label>
        <input type="text" wire:model="password" class="w-full border border-gray-300 dark:border-zinc-700 rounded px-3 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    <div>
        <button wire:click="save" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Save</button>
    </div>
        
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
</div>
