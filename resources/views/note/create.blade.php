<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>    
    <!-- Full-width fluid until the `md` breakpoint, then lock to container -->
    <div class="md:container md:mx-auto">
        <h1 class="text-3xl">Create new Note</h1>

        
        <form action="{{ route('note.store') }}" method="POST">
            <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
            @csrf
                    
                    <!-- Category -->
                    <div class="flex py-4 mr-8">
                        Category
                    </div>
                    <div class="flex py-4 mr-8">
                        <select name="category" id="category" class="form-control">
                            <?php foreach ($categories as $category) : ?>
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Tag -->
                    <div class="flex py-4 mr-8">
                        Tags
                    </div>
                    <div class="flex py-4 mr-8">
                        <div class="row">
                            <?php
                            $oldTags = [];
                            if (isset($oldFormData['tag'])) $oldTags = $oldFormData['tag'];
                            ?>
                            <?php foreach ($tags as $x => $tag) : ?>

                                <div class="col-lg-3 col-md-4 col-sm-6 px-3">
                                    <input class="form-check-input" type="checkbox" id="<?php echo $tag->name; ?>" name="tag[]" value="<?php echo $tag->id; ?>" <?php
                                                                                                                                                                foreach ($oldTags as $oldTag) :
                                                                                                                                                                    if ((int)$oldTag === (int)$tag->id) :
                                                                                                                                                                        echo "checked";
                                                                                                                                                                    endif;
                                                                                                                                                                endforeach;
                                                                                                                                                                ?>>
                                    <label class="form-check-label" for="<?php echo $tag->name; ?>"><?php echo $tag->name; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
            
                    <!-- title -->
                    <div class="flex py-4 mr-8">
                        <input name="title" id="title" type="text" class="form-control" placeholder="Title" value="{{ old('title') }}"></input>
                    </div>
                    @error('title')
                        <div class="text-red-600">{{ $message }}</div>
                    @enderror
                    <!-- url -->
                    <div class="flex py-4 mr-8">
                        <input name="url" id="url" type="text" placeholder="Url" value="{{ old('url') }}"></input>
                    </div>
                    @error('url')
                        <div class="text-red-600">{{ $message }}</div>
                    @enderror
                    <!-- info -->
                    <div class="flex py-4 mr-8">
                        <textarea rows="8" cols="50" name="info" id="info" type="text" class="form-control" placeholder="Info" >{{ old('info') }}</textarea>
                    </div>
                    @error('info')
                        <div class="text-red-600">{{ $message }}</div>
                    @enderror
                    <!-- comment -->
                    <div class="flex py-4 mr-8">
                        <textarea rows="8" cols="50" name="comment" id="comment" type="text" class="form-control" placeholder="Comment" >{{ old('comment') }}</textarea>
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