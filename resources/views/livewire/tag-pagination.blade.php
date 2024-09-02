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
                            <p class="text-green-600">{{ ($found > 0) ? $found . ' tags found with name ['.$search.']': '' }}</p>
                        </div>

                        <!-- New Tag -->
                        <div>
                            <a href="{{ route('tag.create') }}" class="text-white bg-green-600 hover:bg-green-500 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">New Tag</a>
                        </div>

                    </div>    

                <div class="overflow-hidden ">
                    <table class="min-w-full rounded-xl">
                      <thead>
                          <tr class="bg-gray-50">
                              <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize rounded-t-xl" wire:click="sorting('id')">Id {!! $sortLink !!}</th>
                              <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize" wire:click="sorting('name')">name {!! $sortLink !!}</th>
                              <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize" wire:click="sorting('created_at')">created_at {!! $sortLink !!}</th>
                              <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize" wire:click="sorting('updated_at')">updated_at {!! $sortLink !!}</th>
                              <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize rounded-t-xl"> Actions </th>
                          </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-300 ">
                        @if($tags->count())
                        @foreach ($tags as $tag)
                          <tr class="bg-white transition-all duration-500 hover:bg-gray-50">
                              <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ $tag->id }}</td>
                              <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ $tag->name }}</td>
                              <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ date("d-m-Y", strtotime($tag->created_at)) }}</td>
                              <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ date("d-m-Y", strtotime($tag->updated_at)) }}</td>
                              <td class=" p-5 ">
                                  <div class="flex items-center gap-1">
                                        <a href="{{ route('tag.show', $tag) }}">
                                            <button class="p-2 rounded-full  group transition-all duration-500  flex item-center">
                                                <i class="fa-solid fa-eye"></i>                                                                                                   
                                            </button>
                                        </a>
                                        <a href="{{ route('tag.edit', $tag) }}">
                                            <button class="p-2  rounded-full  group transition-all duration-500  flex item-center">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </a>
                                        <form action="{{ route('tag.destroy', $tag) }}" method="POST">
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
                              <td class="p-5 whitespace-nowrap text-xl leading-6 font-medium text-gray-900">No tags found.</td>
                          </tr>          
                          @endif
                      </tbody>
                    </table>                    
                </div>  

                <!-- Pagination Links -->
                <div class="py-2 px-4">
                    {{ $tags->links() }}
                </div>

            </div>
        </div>
    </div>               

</div>
 