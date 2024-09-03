<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>    
    <!-- Full-width fluid until the `md` breakpoint, then lock to container -->
    <div class="container mx-auto bg-red-400">
        <h1 class="text-3xl text-center py-4">Create new Note</h1>

        
        <form class="w-3/4 py-4 mx-auto bg-slate-100 rounded-md" action="{{ route('note.store') }}" method="POST">
            <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
            @csrf                    
            <!-- title -->
            <div class="flex flex-wrap mx-4 mb-6">
                <div class="w-full px-3">
                  <label class="block uppercase tracking-wide text-gray-700 text-md font-bold mb-2" for="title">
                    Title
                  </label>
                  <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="title" id="title" type="text" placeholder="Title" value="{{ old('title') }}"></input>
                  @error('title')
                    <p class="text-red-600 text-md italic">{{ $message }}</p>
                  @enderror                  
                </div>
            </div>
            <!-- date / date limit / pending -->
            <div class="flex flex-col md:flex-row mx-7 mb-6 gap-6 justify-between items-stretch">
                <div>
                    <label class="block uppercase tracking-wide text-gray-700 text-md font-bold mb-2" for="date">
                        Date
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="date" id="date" type="date" min="2024-01-01" value="{{ old('date') }}"></input>
                    @error('date')
                        <p class="text-red-600 text-md italic">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block uppercase tracking-wide text-gray-700 text-md font-bold mb-2" for="date_limit">
                        Date Limit
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="date_limit" id="date_limit" type="date" min="2024-01-01" value="{{ old('date_limit') }}"></input>
                    @error('date_limit')
                        <p class="text-red-600 text-md italic">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block uppercase tracking-wide text-gray-700 text-md font-bold mb-2" for="pending">
                        Pending
                    </label>
                    <div class="md:text-center py-2">
                        <input class="appearance-none rounded-sm text-green-600 focus:ring-green-600 outline-none focus:ring-2 checked:bg-green-500" name="pending" id="pending" type="checkbox" value="true" 
                        @if(old('pending') == 'true') 
                            checked
                        @endif
                        ></input>
                    </div>
                    @error('pending')
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
                  <select class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="category_id" id="category_id">
                    <?php foreach ($categories as $category) : ?>
                        <option value="{{$category->id}}" 
                            @if(old('category_id') == $category->id) 
                                        selected
                            @endif  
                            >{{$category->name}}</option>
                    <?php endforeach; ?>
                  </select>
                  @error('category_id')
                    <p class="text-red-600 text-md italic">{{ $message }}</p>
                  @enderror                  
                </div>
            </div>
            <!-- Tag -->
            <div class="flex flex-wrap mx-4 mb-6">
                  <label class="block uppercase tracking-wide text-gray-700 text-md font-bold mb-2" for="category_id">
                    Tags
                  </label>
                  <ul class="flex flex-wrap justify-between">
                    @foreach($tags as $x => $tag)
                        <li class="inline-flex items-center gap-x-2 py-2 px-1 text-sm font-medium bg-white border text-gray-600 mb-1">
                            <div class="relative flex items-start w-full">
                                <div class="flex items-center h-5">    
                                    <input class="appearance-none rounded-sm text-green-600 focus:ring-green-600 outline-none focus:ring-2 checked:bg-green-500" type="checkbox" id="<?php echo $tag->name; ?>" name="tag[]" value="<?php echo $tag->id; ?>" 
                                        @if(old('tag'))
                                            @for($i=0; $i<=count(old('tag')); $i++) 
                                                @if(old('tag.'.$i) == (int)$tag->id) 
                                                    checked
                                                @endif                                                                                                                                
                                            @endfor
                                        @endif
                                    >
                                </div>
                                <label for="<?php echo $tag->name; ?>" class="ml-3.5 block text-sm font-normal text-gray-600 cursor-pointer "> <?php echo $tag->name; ?> </label>
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
                  <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="rating" id="rating" step="any" type="number" placeholder="Rating" value="{{ old('rating') }}"></input>
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
                  <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="url" id="url" type="text" placeholder="Url" value="{{ old('url') }}"></input>
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
                  <textarea rows="8" cols="50" name="info" id="info" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Info" >{{ old('info') }}</textarea>
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
                  <textarea rows="8" cols="50" name="comment" id="comment" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Comment" >{{ old('comment') }}</textarea>
                  @error('comment')
                    <p class="text-red-600 text-md italic">{{ $message }}</p>
                  @enderror                  
                </div>
            </div>                       
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