<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    <div class="note-container single-note">
        <h1 class="text-3xl py-4">Edit category: {{ $category->name }}</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('category.update', $category) }}" method="POST" class="note">
            <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
            @csrf
            <!-- Dirtective to Override the http method -->
            @method('PUT')
            <input name="name" id="name" type="text" class="note-body" value="{{ $category->name }}" />
            <div class="note-buttons">
                <a href="{{ route('category.index') }}" class="note-cancel-button">Cancel</a>
                <button class="note-submit-button">Submit</button>
            </div>        
        </form>        
    </div>
</x-app-layout>