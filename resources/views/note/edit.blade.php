<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    <!-- Full-width fluid until the `md` breakpoint, then lock to container -->
    <div class="container mx-auto bg-green-600 pb-8">

        <div class="w-3/4 mx-auto py-4 text-start">
            <h1 class="text-3xl text-white px-6 pt-4 pb-2">Edit Note</h1>
        </div>

        <form class="w-3/4 py-4 mx-auto bg-white shadow-lg rounded-md pb-2 mb-2" action="{{ route('note.update', $note) }}" method="POST">
            <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
            @csrf
            <!-- Dirtective to Override the http method -->
            @method('PUT')
            <!-- title -->
            <div class="flex flex-wrap mx-4 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-black font-bold text-md mb-2" for="title">
                        Title
                    </label>
                    <input class="appearance-none block w-full placeholder-gray-400 bg-gray-100 text-black border-2 border-green-600 rounded py-3 px-4 mb-3 leading-tight focus:ring-0 focus:border-green-800" name="title" id="title" type="text" placeholder="Title" value="{{ $note->title }}"></input>
                    @error('title')
                        <p class="text-red-600 text-md italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- date / date limit / pending -->
            <div class="flex flex-col md:flex-row mx-7 mb-6 gap-6 justify-between items-stretch">
                <div>
                    <label class="block uppercase tracking-wide text-black text-md font-bold mb-2" for="pending">
                        Pending
                    </label>
                    <div class="md:text-center py-2">
                        <input class="appearance-none rounded-sm border-2 border-green-600 text-green-600 focus:ring-green-600 outline-none focus:ring-0 checked:bg-green-500" name="pending" id="pending" type="checkbox" value="true"
                               @if ($note->pending === 1) checked @endif></input>
                    </div>
                    @error('pending')
                        <p class="text-red-600 text-md italic">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block uppercase tracking-wide text-black text-md font-bold mb-2" for="date">
                        Date
                    </label>
                    <input class="appearance-none block w-full placeholder-gray-400 bg-gray-100 text-black border-2 border-green-600 rounded py-3 px-4 mb-3 leading-tight focus:ring-0 focus:border-green-800" name="date" id="date" type="date" min="2024-01-01" value="{{ $note->date }}"></input>
                    @error('date')
                        <p class="text-red-600 text-md italic">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block uppercase tracking-wide text-gray-700 text-md font-bold mb-2" for="date_limit">
                        Date Limit
                    </label>
                    <input class="appearance-none block w-full placeholder-gray-400 bg-gray-100 text-black border-2 border-green-600 rounded py-3 px-4 mb-3 leading-tight focus:ring-0 focus:border-green-800" name="date_limit" id="date_limit" type="date" min="2024-01-01" value="{{ $note->date_limit }}"></input>
                    @error('date_limit')
                        <p class="text-red-600 text-md italic">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            <!-- Category -->
            <div class="flex flex-wrap mx-4 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-md font-bold mb-2" for="category_id">
                        Category
                    </label>
                    <select class="appearance-none block w-full placeholder-gray-400 bg-gray-100 text-black border-2 border-green-600 rounded py-3 px-4 mb-3 leading-tight focus:ring-0 focus:border-green-800" name="category_id" id="category_id">
                        <?php foreach ($categories as $category) : ?>
                        <option value="{{ $category->id }}"
                                @if ($note->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                        <?php endforeach; ?>
                    </select>
                    @error('category_id')
                        <p class="text-red-600 text-md italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>


            <!-- Tag -->
            <div class="flex flex-wrap mx-7 mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-md font-bold mb-4" for="category_id">
                    Tags
                </label>
                <ul class="flex flex-wrap justify-start">
                    @foreach ($tags as $x => $tag)
                        <li class="inline-flex items-center gap-x-2 py-2 px-1 text-sm font-medium rounded-md bg-gray-200 border-2 border-gray-400 m-1">
                            <div class="relative flex items-start w-full">
                                <div class="flex items-center h-5 ">
                                    <label for="<?php echo $tag->name; ?>" class="mr-2 block text-sm font-normal text-black cursor-pointer "> <?php echo $tag->name; ?> </label>
                                    <input class="appearance-none rounded-sm text-green-600 outline-none focus:ring-0 checked:bg-green-500" type="checkbox" id="<?php echo $tag->name; ?>" name="tag[]" value="<?php echo $tag->id; ?>"
                                           @foreach ($tagsSelected as $tagSelected)
                                    @if ($tagSelected == $tag->id)
                                checked
                                @endif @endforeach>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                @error('tag')
                    <p class="text-red-600 text-md italic">{{ $message }}</p>
                @enderror
            </div>
            <!-- rating -->
            <div class="flex flex-wrap mx-4 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-md font-bold mb-2" for="rating">
                        rating
                    </label>
                    <input class="appearance-none block w-full placeholder-gray-400 bg-gray-100 text-black border-2 border-green-600 rounded py-3 px-4 mb-3 leading-tight focus:ring-0 focus:border-green-800" name="rating" id="rating" step="any" type="number" placeholder="Rating" value="{{ $note->rating }}"></input>
                    @error('rating')
                        <p class="text-red-600 text-md italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- url -->
            <div class="flex flex-wrap mx-4 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-md font-bold mb-2" for="url">
                        Url
                    </label>
                    <input class="appearance-none block w-full placeholder-gray-400 bg-gray-100 text-black border-2 border-green-600 rounded py-3 px-4 mb-3 leading-tight focus:ring-0 focus:border-green-800" name="url" id="url" type="text" placeholder="http://" value="{{ $note->url }}"></input>
                    @error('url')
                        <p class="text-red-600 text-md italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- info -->
            <div class="flex flex-wrap mx-4 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-md font-bold mb-2" for="info">
                        Info
                    </label>
                    <textarea rows="8" cols="50" name="info" id="info" type="text" class="appearance-none block w-full bg-gray-100 text-black border-2 border-green-600 rounded py-3 px-4 mb-3 leading-tight focus:ring-0 focus:border-green-800">{{ $note->info }}</textarea>
                    @error('info')
                        <p class="text-red-600 text-md italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- comment -->
            <div class="flex flex-wrap mx-4 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-md font-bold mb-2" for="comment">
                        Comment
                    </label>
                    <textarea rows="8" cols="50" name="comment" id="comment" type="text" class="appearance-none block w-full bg-gray-100 text-black border-2 border-green-600 rounded py-3 px-4 mb-3 leading-tight focus:ring-0 focus:border-green-800">{{ $note->comment }}</textarea>
                    @error('comment')
                        <p class="text-red-600 text-md italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- Buttons -->
            <div class="flex flex-col mx-7 mb-6 gap-4">
                <!-- Submit -->
                <button class="text-white uppercase bg-green-600 hover:bg-green-500 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-lg py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
                <!-- Back -->
                <a href="{{ route('note.index') }}" class="text-white text-center uppercase bg-black hover:bg-slate-800 focus:ring-4 focus:ring-slate-800 font-medium rounded-lg text-lg py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>

            </div>
        </form>
    </div>
</x-app-layout>
