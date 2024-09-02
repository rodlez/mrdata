<div>


    <select wire:model.live="perPage">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>
    
      
    <div class="flex flex-col">
        <div class=" overflow-x-auto">
          <div class="min-w-full inline-block align-middle">
                
                <!-- Search -->
                <div class="relative text-gray-500 focus-within:text-gray-900 mb-4">
                    <div class="absolute inset-y-0 left-1 flex items-center pl-3 pointer-events-none ">
                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.5 17.5L15.4167 15.4167M15.8333 9.16667C15.8333 5.48477 12.8486 2.5 9.16667 2.5C5.48477 2.5 2.5 5.48477 2.5 9.16667C2.5 12.8486 5.48477 15.8333 9.16667 15.8333C11.0005 15.8333 12.6614 15.0929 13.8667 13.8947C15.0814 12.6872 15.8333 11.0147 15.8333 9.16667Z" stroke="#9CA3AF" stroke-width="1.6" stroke-linecap="round" />
                            <path d="M17.5 17.5L15.4167 15.4167M15.8333 9.16667C15.8333 5.48477 12.8486 2.5 9.16667 2.5C5.48477 2.5 2.5 5.48477 2.5 9.16667C2.5 12.8486 5.48477 15.8333 9.16667 15.8333C11.0005 15.8333 12.6614 15.0929 13.8667 13.8947C15.0814 12.6872 15.8333 11.0147 15.8333 9.16667Z" stroke="black" stroke-opacity="0.2" stroke-width="1.6" stroke-linecap="round" />
                            <path d="M17.5 17.5L15.4167 15.4167M15.8333 9.16667C15.8333 5.48477 12.8486 2.5 9.16667 2.5C5.48477 2.5 2.5 5.48477 2.5 9.16667C2.5 12.8486 5.48477 15.8333 9.16667 15.8333C11.0005 15.8333 12.6614 15.0929 13.8667 13.8947C15.0814 12.6872 15.8333 11.0147 15.8333 9.16667Z" stroke="black" stroke-opacity="0.2" stroke-width="1.6" stroke-linecap="round" />
                        </svg>
                    </div>
                    <!-- Search box -->
                    <input type="search" class="my-6 block w-80 h-11 pr-5 pl-12 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none" placeholder="Search by name" style="width: 250px;" wire:model.live="search">
                </div>
                    

                    <div class="flex p-4 justify-between">

                        <div>
                            <!-- Search Results -->                
                            <p class="text-green-600">{{ ($found > 0) ? $found . ' categories found with name ['.$search.']': '' }}</p>
                        </div>

                        <!-- New Category -->
                        <div>
                            <a href="{{ route('category.create') }}" class="text-white bg-green-600 hover:bg-green-500 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">New Category</a>
                        </div>

                    </div>    

                <div class="overflow-hidden ">
                    <table class="min-w-full rounded-xl">
                      <thead>
                          <tr class="bg-gray-50">
                              <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize rounded-t-xl" wire:click="sortOrderito('id')">Id {!! $sortLink !!}</th>
                              <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize" wire:click="sortOrderito('name')">name {!! $sortLink !!}</th>
                              <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize" wire:click="sortOrderito('created_at')">created_at {!! $sortLink !!}</th>
                              <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize" wire:click="sortOrderito('updated_at')">updated_at {!! $sortLink !!}</th>
                              <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize rounded-t-xl"> Actions </th>
                          </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-300 ">
                        @if($categories->count())
                        @foreach ($categories as $category)
                          <tr class="bg-white transition-all duration-500 hover:bg-gray-50">
                              <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ $category->id }}</td>
                              <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ $category->name }}</td>
                              <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ date("d-m-Y", strtotime($category->created_at)) }}</td>
                              <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ date("d-m-Y", strtotime($category->updated_at)) }}</td>
                              <td class=" p-5 ">
                                  <div class="flex items-center gap-1">
                                        <a href="{{ route('category.show', $category) }}">
                                            <button class="p-2 rounded-full  group transition-all duration-500  flex item-center">
                                                <i class="fa-solid fa-eye"></i>                                                                                                   
                                            </button>
                                        </a>
                                        <a href="{{ route('category.edit', $category) }}">
                                            <button class="p-2  rounded-full  group transition-all duration-500  flex item-center">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </a>
                                        <form action="{{ route('category.destroy', $category) }}" method="POST">
                                            <!-- Add Token to prevent Cross-Site Request Forgery (CSRF) -->
                                            @csrf
                                            <!-- Dirtective to Override the http method -->
                                            @method('DELETE')
                                            <button class="p-2 rounded-full  group transition-all duration-500  flex item-center">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>                                        
                                  </div>
                              </td>
                          </tr>
                          @endforeach
                          @else
                          <tr>
                              <td class="p-5 whitespace-nowrap text-xl leading-6 font-medium text-gray-900">No categories found.</td>
                          </tr>          
                          @endif
                      </tbody>
                    </table>                    
                </div>  

                <!-- Pagination Links -->
                <div class="py-2 px-4">
                    {{ $categories->links() }}
                </div>

            </div>
        </div>
    </div>               

</div>
    
    
    
    
 {{-- 
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
--}}