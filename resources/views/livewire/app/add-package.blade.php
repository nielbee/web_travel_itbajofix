

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
   @foreach ($packages as $p)
        <tr>
            <td class="px-4 py-2">
                <p>{{ $p->title }}</p>
            </td>
            <td class="px-4 py-2">
                <p>{{ $p->description }}</p>
            </td>
            <td class="px-4 py-2">
                <p>Rp. {{ $p->price }}</p>
            </td>
            <td class="px-4 py-2">
                <a href='/packages/delete/{{ $p->id }}'>
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 hover:text-red-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3" />
                     </svg>
                </a>
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
        
        <button 
            @click="open = false" 
            c class="px-2 py-2 rounded bg-red-600 hover:bg-red-700 text-white font-semibold shadow transition"
        >
            X
        </button>
        <h2 class="text-xl font-bold mb-4">Add Packages</h2>
        <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-4 max-w-lg mx-auto p-6 bg-white dark:bg-zinc-900 rounded shadow">
    <div>
        <label class="block text-sm font-bold mb-1 text-zinc-800 dark:text-zinc-100">Title</label>
        <input type="text" wire:model="title" class="w-full border border-gray-300 dark:border-zinc-700 rounded px-3 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div>
        <label class="block text-sm font-bold mb-1 text-zinc-800 dark:text-zinc-100">Description</label>
        <textarea wire:model="description" rows="4" class="w-full border border-gray-300 dark:border-zinc-700 rounded px-3 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
    </div>

    <div>
        <label class="block text-sm font-bold mb-1 text-zinc-800 dark:text-zinc-100">Photo 1</label>
        <input type="file" wire:model="photo1" class="w-full border border-gray-300 dark:border-zinc-700 rounded px-3 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100">
    </div>

    <div>
        <label class="block text-sm font-bold mb-1 text-zinc-800 dark:text-zinc-100">Photo 2</label>
        <input type="file" wire:model="photo2" class="w-full border border-gray-300 dark:border-zinc-700 rounded px-3 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100">
    </div>

    <div>
        <label class="block text-sm font-bold mb-1 text-zinc-800 dark:text-zinc-100">Photo 3</label>
        <input type="file" wire:model="photo3" class="w-full border border-gray-300 dark:border-zinc-700 rounded px-3 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100">
    </div>

    <div>
        <label class="block text-sm font-bold mb-1 text-zinc-800 dark:text-zinc-100">Price</label>
        <input type="number" wire:model="price" class="w-full border border-gray-300 dark:border-zinc-700 rounded px-3 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div>
        <label class="block text-sm font-bold mb-1 text-zinc-800 dark:text-zinc-100">Default Message</label>
        <input type="text" wire:model="default_message" class="w-full border border-gray-300 dark:border-zinc-700 rounded px-3 py-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Save</button>
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