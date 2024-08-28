<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    
    <!-- Full-width fluid until the `md` breakpoint, then lock to container -->
    <div class="md:container md:mx-auto">
        <h1 class="text-3xl mb-4">Category Info</h1>
        <h1 class="text-xl py-2 font-bold">Name: {{ $category->name }}</h1>
        <h1 class="text-xl py-2">Created: {{ $category->created_at }}</h1>
        <h1 class="text-xl py-2">Updated: {{ $category->updated_at }}</h1>                
        
                                      
                    <!-- Buttons -->
                    <div class="flex items-center py-8 gap-6">
                        <a href="{{ route('category.index') }}" class="text-white bg-black hover:bg-slate-800 focus:ring-4 focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>

                        <a href="{{ route('category.edit', $category->id) }}" class="text-white bg-green-600 hover:bg-green-500 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</a>
                    
                        <form action="{{ route('category.destroy', $category) }}" method="POST">
                            <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                            @csrf
                            <!-- Dirtective to Override the http method -->
                            @method('DELETE')
                            <button class="text-white bg-red-600 hover:bg-red-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Delete</button>
                        </form>
                    </div>
       
    </div>


</x-app-layout>