<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    <div class="note-container single-note">
        
        <div class="note-header">
            <h1 class="text-3xl py-4">Category created at: {{ $category->created_at }}</h1>
            <div class="note-buttons">
                <a href="{{ route('category.index') }}" class="note-back-button">Back</a>
                <a href="{{ route('category.edit', $category->id) }}" class="note-edit-button">Edit</a>
                <form action="{{ route('category.destroy', $category) }}" method="POST">
                    <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                    @csrf
                    <!-- Dirtective to Override the http method -->
                    @method('DELETE')
                    <button class="note-delete-button">Delete</button>
                </form>
            </div>
        </div>
        <div class="note">
            <div class="note-body">{{ $category->name }}</div>
        </div>
    </div>
</x-app-layout>