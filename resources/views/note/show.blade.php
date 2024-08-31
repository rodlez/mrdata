<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>    
    <!-- Full-width fluid until the `md` breakpoint, then lock to container -->
    <div class="md:container md:mx-auto">
        <!-- Info -->
        <h1 class="text-3xl mb-4">Note Info</h1>
        <p class="text-xl py-2 font-bold">Title: {{ $note->title }}</p>
        <p class="text-xl py-2 font-bold">Pending: {{ $note->pending }}</p>
        <p class="text-xl py-2 font-bold">User: {{ $note->user_id }}</p>
        <p class="text-xl py-2 font-bold">Category: {{ $note->category_id }}</p>
        <p class="text-xl py-2 font-bold">Tags: 
            @foreach ($tagsNames as $tagName)
            {{ $tagName }}
            @endforeach
        </p>
        <p class="text-xl py-2 font-bold">Date: {{ $note->date }}</p>
        <p class="text-xl py-2 font-bold">Date Limit: {{ $note->date_limit }}</p>
        <p class="text-xl py-2 font-bold">Rating: {{ $note->rating }}</p>
        <p class="text-xl py-2 font-bold">Url: {{ $note->url }}</p>
        <p class="text-xl py-2 font-bold">Info: {{ $note->info }}</p>
        <p class="text-xl py-2 font-bold">Comment: {{ $note->comment }}</p>
        <p class="text-xl py-2">Created: {{ $note->created_at }}</p>
        <p class="text-xl py-2">Updated: {{ $note->updated_at }}</p>  
        
        <p class="text-xl py-2">Images: 
            @foreach ($images as $image)
            <div class="flex flex-column py-2">
                <div>Created - {{$image->created_at}}</div>
                <div>Name - {{$image->original_filename}}</div>
                <div>Size - {{$image->size / 1000}} KB</div>
                <div>
                    @if ($image->media_type === 'application/pdf')
                        <a href="{{ asset('storage/'.$image->storage_filename) }}">    
                            <i class="fa-regular fa-file-pdf fa-2xl"></i>
                        </a>
                    @else                            
                        {{-- <a href="{{ url($image->path)}}">
                            <img src="{{ url($image->path)}}" alt="{{$image->original_filename}}" width="250">                     
                        </a> --}}  
                        <a href="{{ asset('storage/'.$image->storage_filename) }}">            
                        <img src="{{ asset('storage/'.$image->path) }}" alt="{{$image->original_filename}}" width="250">
                        </a>
                    @endif                    
                </div>
                <div>
                    <form action="{{ route('image.destroy', [$note->id, $image->id]) }}" method="POST">
                        <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                        @csrf
                        <!-- Dirtective to Override the http method -->
                        @method('DELETE')
                        <button class="p-2 rounded-full  group transition-all duration-500  flex item-center">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
                <div>
                    <button class="p-2 rounded-full  group transition-all duration-500  flex item-center">
                        <a href="{{ route('image.download', [$note->id, $image->id]) }}">
                            <i class="fa-solid fa-file-arrow-down"></i>
                        </a>
                    </button>
                </div>

            </div>
            @endforeach
        </p>  
       
        <!-- Buttons -->
        <div class="flex items-center py-8 gap-6">
            <!-- Back -->
            <a href="{{ route('note.index') }}" class="text-white bg-black hover:bg-slate-800 focus:ring-4 focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
            <!-- Upload Image -->
            <a href="{{ route('image.index', $note->id) }}" class="text-white bg-violet-600 hover:bg-violet-500 focus:ring-4 focus:ring-violet-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Upload File</a>
            <!-- Edit -->
            <a href="{{ route('note.edit', $note->id) }}" class="text-white bg-green-600 hover:bg-green-500 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</a>
            <!-- Delete -->
            <form action="{{ route('note.destroy', $note) }}" method="POST">
                <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                @csrf
                <!-- Dirtective to Override the http method -->
                @method('DELETE')
                <button class="text-white bg-red-600 hover:bg-red-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Delete</button>
            </form>
        </div>
       
    </div>
</x-app-layout>