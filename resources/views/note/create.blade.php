<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>    
    <!-- Full-width fluid until the `md` breakpoint, then lock to container -->
    <div class="md:container md:mx-auto">
        <h1 class="text-3xl">Create new Note</h1>

        
        <form action="{{ route('note.store') }}" method="POST">
            <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
            @csrf                    
            <!-- title -->
            <div class="flex py-4">
                <input name="title" id="title" type="text" class="form-control" placeholder="Title" value="{{ old('title') }}"></input>
            </div>
            @error('title')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
            <!-- date -->
            <div class="flex">
                Date
            </div>
            <div class="flex">
                <input name="date" id="date" type="date" class="form-control" min="2024-01-01" value="{{ old('date') }}"></input>
            </div>
            @error('date')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
            <!-- pending -->
            <div class="flex">
                Pending
            </div>
            <div class="flex">
                <input name="pending" id="pending" type="checkbox" value="true" 
                    @if(old('pending') == 'true') 
                        checked
                    @endif
                ></input>
            </div>
            @error('pending')
                <div class="text-red-600">{{ $message }}</div>
            @enderror 
            <!-- Category -->
            <div class="flex">
                Category
            </div>
            <div class="flex">
                <select name="category_id" id="category_id" class="form-control">
                    <?php foreach ($categories as $category) : ?>
                        <option value="{{$category->id}}" 
                            @if(old('category_id') == $category->id) 
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
            <div class="flex">
                Tags
            </div>
            <div class="py-4 mr-8">
                    
                    @foreach($tags as $x => $tag)
                        
                            <input class="form-check-input" type="checkbox" id="<?php echo $tag->name; ?>" name="tag[]" value="<?php echo $tag->id; ?>" 
                            @if(old('tag'))
                                @for($i=0; $i<=count(old('tag')); $i++) 
                                    @if(old('tag.'.$i) == (int)$tag->id) 
                                        checked
                                    @endif                                                                                                                                
                                @endfor
                            @endif
                            >
                            <label class="form-check-label" for="<?php echo $tag->name; ?>"><?php echo $tag->name; ?></label>
                        
                    @endforeach
            </div>
            @error('tag')
            <div class="text-red-600">{{ $message }}</div>
            @enderror                    
            <!-- rating -->
            <div class="flex">
                <input name="rating" id="rating" step="any" type="number" class="form-control" placeholder="Rating" value="{{ old('rating') }}"></input>
            </div>
            @error('rating')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
            <!-- date_limit -->
            <div class="flex">
                Date Limit
            </div>
            <div class="flex">
                <input name="date_limit" id="date_limit" type="date" class="form-control" min="2024-01-01" value="{{ old('date_limit') }}"></input>
            </div>
            @error('date_limit')
                <div class="text-red-600">{{ $message }}</div>
            @enderror            
            <!-- url -->
            <div class="flex">
                <input name="url" id="url" type="text" placeholder="Url" value="{{ old('url') }}"></input>
            </div>
            @error('url')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
            <!-- info -->
            <div class="flex">
                <textarea rows="8" cols="50" name="info" id="info" type="text" class="form-control" placeholder="Info" >{{ old('info') }}</textarea>
            </div>
            @error('info')
                <div class="text-red-600">{{ $message }}</div>
            @enderror
            <!-- comment -->
            <div class="flex">
                <textarea rows="8" cols="50" name="comment" id="comment" type="text" class="form-control" placeholder="Comment" >{{ old('comment') }}</textarea>
            </div>
            @error('comment')
                <div class="text-red-600">{{ $message }}</div>
            @enderror           
            <!-- Buttons -->
            <div class="flex items-center gap-4 mt-8">
                <!-- Submit -->
                <button class="text-white bg-green-600 hover:bg-green-500 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
                <!-- Back -->
                <a href="{{ route('note.index') }}" class="text-white bg-black hover:bg-slate-800 focus:ring-4 focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
            </div>
        </form>
    </div>
</x-app-layout>