<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    <!-- Full-width fluid until the `md` breakpoint, then lock to container -->
    <div class="md:container md:mx-auto">
        <h1 class="text-3xl">Edit new Note</h1>


        <form action="{{ route('note.update', $note) }}" method="POST">
            <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
            @csrf
            <!-- Dirtective to Override the http method -->
            @method('PUT')
            <!-- Category -->
            <div class="flex py-4 mr-8">
                Category
            </div>
            <div class="flex py-4 mr-8">
                <select name="category_id" id="category_id" class="form-control">
                    <?php foreach ($categories as $category) : ?>
                        <option value="{{$category->id}}"
                            @if($note->category_id == $category->id)
                            selected
                            @endif
                            >{{$category->name}}</option>
                    <?php endforeach; ?>
                </select>
            </div>
            @error('category_id')
            <div class="text-red-600">{{ $message }}</div>
            @enderror

            <!-- Tag -->
            <div class="flex py-4 mr-8">
                Tags
            </div>
            <div class="py-4 mr-8">

                @foreach($tags as $x => $tag)

                <input class="form-check-input" type="checkbox" id="<?php echo $tag->name; ?>" name="tag[]" value="<?php echo $tag->id; ?>"
                    @foreach($tagsSelected as $tagSelected)
                    @if($tagSelected==$tag->id)
                checked
                @endif
                @endforeach
                >
                <label class="form-check-label" for="<?php echo $tag->name; ?>"><?php echo $tag->name; ?></label>

                @endforeach
            </div>
            @error('tag')
            <div class="text-red-600">{{ $message }}</div>
            @enderror

            <!-- pending -->
            <div class="flex py-4 mr-8">
                Pending
            </div>
            <div class="flex py-4 mr-8">
                <input name="pending" id="pending" type="checkbox" value="true"
                    @if($note->pending === 1)
                checked
                @endif
                ></input>
            </div>
            @error('pending')
            <div class="text-red-600">{{ $message }}</div>
            @enderror
            <!-- rating -->
            <div class="flex py-4 mr-8">
                <input name="rating" id="rating" step="any" type="number" class="form-control" placeholder="Rating" value="{{ $note->rating }}"></input>
            </div>
            @error('rating')
            <div class="text-red-600">{{ $message }}</div>
            @enderror

            <!-- <input type="date" id="start" name="trip-start" value="2018-07-22" min="2018-01-01" max="2018-12-31" /> -->


            <!-- date -->
            <div class="flex py-4 mr-8">
                Date
            </div>
            <div class="flex py-4 mr-8">
                <input name="date" id="date" type="date" class="form-control" min="2024-01-01" value="{{ $note->date }}"></input>
            </div>
            @error('date')
            <div class="text-red-600">{{ $message }}</div>
            @enderror

            <!-- date_limit -->
            <div class="flex py-4 mr-8">
                Date Limit
            </div>
            <div class="flex py-4 mr-8">
                <input name="date_limit" id="date_limit" type="date" class="form-control" min="2024-01-01" value="{{ $note->date_limit }}"></input>
            </div>
            @error('date_limit')
            <div class="text-red-600">{{ $message }}</div>
            @enderror

            <!-- title -->
            <div class="flex py-4 mr-8">
                <input name="title" id="title" type="text" class="form-control" placeholder="Title" value="{{ $note->title }}"></input>
            </div>
            @error('title')
            <div class="text-red-600">{{ $message }}</div>
            @enderror
            <!-- url -->
            <div class="flex py-4 mr-8">
                <input name="url" id="url" type="text" placeholder="Url" value="{{ $note->url }}"></input>
            </div>
            @error('url')
            <div class="text-red-600">{{ $message }}</div>
            @enderror
            <!-- info -->
            <div class="flex py-4 mr-8">
                <textarea rows="8" cols="50" name="info" id="info" type="text" class="form-control" placeholder="Info">{{ $note->info }}</textarea>
            </div>
            @error('info')
            <div class="text-red-600">{{ $message }}</div>
            @enderror
            <!-- comment -->
            <div class="flex py-4 mr-8">
                <textarea rows="8" cols="50" name="comment" id="comment" type="text" class="form-control" placeholder="Comment">{{ $note->comment }}</textarea>
            </div>
            @error('comment')
            <div class="text-red-600">{{ $message }}</div>
            @enderror
            <!-- Buttons -->
            <div class="flex items-center gap-4 mt-8">
                <button class="text-white bg-green-600 hover:bg-green-500 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>

                <a href="{{ route('note.index') }}" class="text-white bg-black hover:bg-slate-800 focus:ring-4 focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
            </div>
        </form>
    </div>
</x-app-layout>