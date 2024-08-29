<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    
    <div class="container">
        <h1>Upload image for the Note - {{$note->title}}</h1>
    </div>
                     
    <form action="{{ route('image.store', $note->id) }}" method="POST" enctype="multipart/form-data">
        <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
        @csrf        
        <div>
            <label for="image">Image</label>
        </div>
        <div>
            <input type="file" name="image" id="image">
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
        @error('image')
            <div class="text-red-600">{{ $message }}</div>
        @enderror
    </form>
   
    
</x-app-layout>