<div>
    <div class="bg-yellow-300">

        <div class="bg-red-200">
            <!-- Search box -->
            <input type="text" class="form-control my-6" placeholder="Search by name" style="width: 250px;" wire:model.live="search">
        </div>

        <table class="table-auto">
            <thead class="bg-lime-400">
                <tr>
                    <th class="sort" wire:click="sortOrderito('id')">Id {!! $sortLink !!}</th>
                    <th class="sort" wire:click="sortOrderito('name')">name {!! $sortLink !!}</th>
                    <th class="sort" wire:click="sortOrderito('created_at')">created_at {!! $sortLink !!}</th>
                    <th class="sort" wire:click="sortOrderito('updated_at')">updated_at {!! $sortLink !!}</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($categories->count())
                @foreach ($categories as $category)
                <tr>
                    <td class="p-4">{{ $category->id }}</td>
                    <td class="p-4">{{ $category->name }}</td>
                    <td class="p-4">{{ date("d-m-Y", strtotime($category->created_at)) }}</td>
                    <td class="p-4">{{ date("d-m-Y", strtotime($category->updated_at)) }}</td>
                    <td class="p-4 flex flex-row items-stretch space-x-4">
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
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td>No categories found.</td>
                </tr>

                @endif
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="py-6 bg-lime-400">
        {{ $categories->links() }}
    </div>

</div>