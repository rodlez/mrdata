<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    <!-- Full-width fluid until the `md` breakpoint, then lock to container -->
    <div class="md:container md:mx-auto">
        <h1 class="text-3xl">Create new category</h1>

        <form action="{{ route('category.store') }}" method="POST">
            <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
            @csrf
            <!-- Category -->
            <div class="flex py-4 mr-8">
                <input name="name" id="name" type="text" placeholder="Enter category"></input>
            </div>
            <!-- Errors -->
            @if ($errors->any())
            <div class="pb-4">
                <ul class="text-red-400">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!-- Buttons -->
            <div class="flex items-center gap-4">
                <button class="text-white bg-green-600 hover:bg-green-500 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>

                <a href="{{ route('category.index') }}" class="text-white bg-black hover:bg-slate-800 focus:ring-4 focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
            </div>
        </form>
    </div>
</x-app-layout>