<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    <!-- Categories -->    
    <div class="note-container py-12">
        <!-- 2 ways to generate the routes, hardcoded or use the name defined in the routes -->
        <!-- <a href="note/create" class="new-note-btn">Create Note</a> -->
        <a href="{{ route('category.create') }}" class="new-note-btn">Create Category</a>
        <h1 class="py-6">Categories</h1>
        <div class="notes">
            @foreach ($categories as $category)
            <div class="note">
                <div class="note-body">
                {{ $category->name }}
                </div>
                <div class="note-buttons">
                    <!-- To include the id -> Laravel resolve note passing the id key if we include the object, or we can pass it specifically -->
                    <a href="{{ route('category.show', $category) }}" class="note-view-button">View</a>
                    <a href="{{ route('category.edit', $category) }}" class="note-edit-button">Edit</a>
                    <form action="{{ route('category.destroy', $category) }}" method="POST">
                        <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                        @csrf
                        <!-- Dirtective to Override the http method -->
                        @method('DELETE')
                        <button class="note-delete-button">Delete</button>
                    </form>
                </div>
            </div>
            @endforeach            
        </div>
        <!-- Add pagination -->
        <div class="p-6">
            {{ $categories->links() }}
        </div>
    </div>
</x-app-layout>