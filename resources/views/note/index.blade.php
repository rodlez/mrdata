<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    
    <div class="container">
        <a href="{{ route('note.create') }}" class="text-white bg-black hover:bg-slate-800 focus:ring-4 focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create</a>
    </div>
    
</x-app-layout>