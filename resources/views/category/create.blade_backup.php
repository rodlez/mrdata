<!-- To use the layout.blade.php in views/components as a Template to render in the slot variable -->
<x-app-layout>
    <div class="note-container single-note">
        <h1>Create new category</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('category.store') }}" method="POST" class="note">
            <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
            @csrf
            <input name="name" id="name" type="text" class="note-body" placeholder="Enter category"></input>
            <div class="note-buttons">
                <a href="{{ route('category.index') }}" class="note-cancel-button">Cancel</a>
                <button class="note-submit-button">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>