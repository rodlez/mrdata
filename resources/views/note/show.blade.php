<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    <!-- Full-width fluid until the `md` breakpoint, then lock to container -->
    <div class="container w-3/4 mx-auto py-8">

        <div class="mx-auto py-4 px-4 text-start bg-green-600 rounded-sm">
            <h1 class="text-3xl text-white px-0 pt-4 pb-2">Note Info</h1>
        </div>

        <div class="mx-auto py-4 px-4 text-start bg-green-200">
            <p><b>Created:</b> {{ date_format($note->created_at, 'd-m-Y') }} <b>Updated:</b> {{ date_format($note->updated_at, 'd-m-Y') }}</p>
        </div>

        <div class="flex flex-col md:flex-row border-b-2 border-white">
            <div class="md:w-1/4 uppercase flex-auto bg-green-600 text-white p-4">Title</div>
            <div class="md:w-3/4 flex-auto bg-zinc-300 text-black p-4">{{ $note->title }}</div>
        </div>

        <div class="flex flex-col md:flex-row border-b-2 border-white">
            <div class="md:w-1/4 uppercase flex-auto bg-green-600 text-white p-4">Pending</div>
            <div class="md:w-3/4 flex-auto bg-zinc-300 text-black p-4">{{ $note->pending ? 'Yes' : 'No' }}</div>
        </div>

        <div class="flex flex-col md:flex-row border-b-2 border-white">
            <div class="md:w-1/4 uppercase flex-auto bg-green-600 text-white p-4">Date</div>
            <div class="md:w-3/4 flex-auto bg-zinc-300 text-black p-4">{{ date('m-d-Y', strtotime($note->date)) }} </div>
        </div>

        <div class="flex flex-col md:flex-row border-b-2 border-white">
            <div class="md:w-1/4 uppercase flex-auto bg-green-600 text-white p-4">Date Limit</div>
            <div class="md:w-3/4 flex-auto bg-zinc-300 text-black p-4">{{ date('m-d-Y', strtotime($note->date_limit)) }}</div>
        </div>

        <div class="flex flex-col md:flex-row border-b-2 border-white">
            <div class="md:w-1/4 uppercase flex-auto bg-green-600 text-white p-4">Category</div>
            <div class="md:w-3/4 flex-auto bg-zinc-300 text-black p-4">{{ $note->category->name }}</div>
        </div>

        <div class="flex flex-col md:flex-row border-b-2 border-white">
            <div class="md:w-1/4 uppercase flex-auto bg-green-600 text-white p-4">Tags</div>
            <div class="md:w-3/4 flex-auto bg-zinc-300 text-black p-4">
                @foreach ($tagsNames as $tagName)
                    {{ $tagName }}
                @endforeach
            </div>
        </div>

        <div class="flex flex-col md:flex-row border-b-2 border-white">
            <div class="md:w-1/4 uppercase flex-auto bg-green-600 text-white p-4">Rating</div>
            <div class="md:w-3/4 flex-auto bg-zinc-300 text-black p-4">{{ $note->rating }}</div>
        </div>

        <div class="flex flex-col md:flex-row border-b-2 border-white">
            <div class="md:w-1/4 uppercase flex-auto bg-green-600 text-white p-4">Url</div>
            <div class="md:w-3/4 flex-auto bg-zinc-300 text-black p-4">{{ $note->url }}</div>
        </div>

        <div class="flex flex-col md:flex-row border-b-2 border-white">
            <div class="md:w-1/4 uppercase flex-auto bg-green-600 text-white p-4">Info</div>
            <div class="md:w-3/4 flex-auto bg-zinc-300 text-black p-4">{{ $note->info }}</div>
        </div>

        <div class="flex flex-col md:flex-row border-b-2 border-white">
            <div class="md:w-1/4 uppercase flex-auto bg-green-600 text-white p-4">Comment</div>
            <div class="md:w-3/4 flex-auto bg-zinc-300 text-black p-4">{{ $note->comment }}</div>
        </div>

        <div class="flex flex-col md:flex-row border-b-2 border-white">

            <div class="md:w-1/4 uppercase flex-auto bg-green-600 text-white p-4">Files ({{ $images->count() }})</div>


            <div class="md:w-3/4 flex-auto bg-zinc-300 text-black p-4">
                @if ($images->count() !== 0)
                    <table class="table-fixed w-full bg-white">
                        <thead class="text-center text-white bg-orange-500">
                            <th></th>
                            <th class="py-2">Created</th>
                            <th class="py-2">Size</th>
                            <th></th>
                        </thead>

                        @foreach ($images as $image)
                            <tr class="bg-white border-b-2 text-center">
                                <td class="py-2">
                                    @if ($image->media_type === 'application/pdf')
                                        <a href="{{ asset('storage/' . $image->storage_filename) }}">
                                            <i class="fa-regular fa-file-pdf fa-2xl"></i>
                                        </a>
                                    @else
                                        {{-- <a href="{{ url($image->path)}}">
                            <img src="{{ url($image->path)}}" alt="{{$image->original_filename}}" width="250">                     
                        </a> --}}
                                        <a href="{{ asset('storage/' . $image->storage_filename) }}">
                                            <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->original_filename }}" width="250">
                                        </a>
                                    @endif
                                </td>
                                <td class="py-2">{{ $image->created_at->format('d-m-Y') }}</td>
                                <td class="py-2">{{ round($image->size / 1000) }} KB</td>
                                <td class="py-2">
                                    <div class="flex justify-center gap-2">
                                        <form action="{{ route('image.destroy', [$note->id, $image->id]) }}" method="POST">
                                            <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                                            @csrf
                                            <!-- Dirtective to Override the http method -->
                                            @method('DELETE')
                                            <button class="p-2 rounded-full  group transition-all duration-500">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>

                                        <button class="p-2 rounded-full  group transition-all duration-500">
                                            <a href="{{ route('image.download', [$note->id, $image->id]) }}">
                                                <i class="fa-solid fa-file-arrow-down"></i>
                                            </a>
                                        </button>
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                        <tr class="bg-white border-b-2 text-center">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="py-6">
                                <!-- Upload Image -->
                                <a href="{{ route('image.index', $note->id) }}" class="w-full text-white text-center bg-violet-600 hover:bg-violet-500 focus:ring-4 focus:ring-violet-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Upload File</a>
                            </td>
                        </tr>

                    </table>
                @endif
            </div>

        </div>

        <!-- Buttons -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 py-4">
            <!-- Edit -->
            <a href="{{ route('note.edit', $note->id) }}" class="w-full text-white text-center bg-blue-600 hover:bg-green-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</a>
            <!-- Delete -->
            <form action="{{ route('note.destroy', $note) }}" method="POST" class="w-full">
                <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                @csrf
                <!-- Dirtective to Override the http method -->
                @method('DELETE')
                <button class="w-full text-white bg-red-600 hover:bg-red-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Delete</button>
            </form>
            <!-- Back -->
            <a href="{{ route('note.index') }}" class="w-full text-white text-center bg-black hover:bg-slate-800 focus:ring-4 focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
        </div>

    </div>
</x-app-layout>
