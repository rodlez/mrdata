<div class="container max-w-6xl mx-auto px-6 py-2 bg-red-400">

    <div>
        <h2 class="text-xl">Rating</h2>
    </div>

    <div class="flex flex-row justify-start items-center bg-red-300 gap-4">
        <div>From </div>
        <div><input type="text" class="rounded-lg" placeholder="Min" style="width: 250px;" wire:model.live="min"></div>
        <div>To </div>
        <div><input type="text" class="rounded-lg" placeholder="Max" style="width: 250px;" wire:model.live="max"></div>
    </div>

    <div>
        <h2 class="text-xl">Date Interval</h2>
    </div>

    <div class="flex flex-row justify-start items-center bg-green-300 gap-4">
        <div>From </div>
        <div><input type="date" class="rounded-lg" placeholder="Start Date" style="width: 250px;" wire:model.live="dateFrom"></div>
        <div>To </div>
        <div><input type="date" class="rounded-lg" placeholder="End Date" style="width: 250px;" wire:model.live="dateTo"></div>
    </div>

    {{-- <div>
        <h2 class="text-xl">Pending</h2>
        <div class="flex flex-row justify-start items-center bg-green-300 gap-4">
            <div>Pending </div>
            <select wire:model.live="pendingNote"
                    class="rounded-lg">
                <option value="2">All</option>
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>
    </div> --}}

    <div>
        <h2 class="text-xl">Pending</h2>
        <div class="flex flex-row justify-start items-center bg-green-300 gap-4">
            All <input type="radio" value="2" class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-slate-300 checked:border-slate-400 transition-all" wire:model.live="pendingNote">
            No <input type="radio" value="0" class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-slate-300 checked:border-slate-400 transition-all" wire:model.live="pendingNote">
            Pending <input type="radio" value="1" class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-slate-300 checked:border-slate-400 transition-all" wire:model.live="pendingNote">
            </select>
        </div>
    </div>


    <div>
        <h2 class="text-xl">Category</h2>
        <div class="flex flex-row justify-start items-center bg-green-300 gap-4">
            <div>Category </div>
            <select wire:model.live="cat"
                    class="rounded-lg">
                <option value="0">All</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{--     <div class="bg-red-400">
        {{ $dateFrom }} , {{ $dateTo }}
    </div> --}}



    <div>
        <div class="flex flex-row justify-start items-center bg-green-300 gap-4">
            <div>Pagination </div>
            <select wire:model.live="perPage">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>

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
                    <input type="search" class="my-6 block w-80 h-11 pr-5 pl-12 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-transparent border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none" placeholder="Search by title" style="width: 250px;" wire:model.live="search">
                </div>


                <div class="flex p-4 justify-between bg-emerald-700">

                    <div>
                        <!-- Search Results -->
                        <p class="text-green-600">{{ $found > 0 ? $found . ' notes found with name [' . $search . ']' : '' }}</p>
                    </div>

                    <!-- New Note -->
                    <div>
                        <a href="{{ route('note.create') }}" class="text-white bg-green-600 hover:bg-green-500 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">New Note</a>
                    </div>

                </div>

                <div>
                    {{ $search != '' ? '' : 'Total Notes - ' . $total }}
                </div>

                <div>
                    <button type="button" class="bg-black text-white p-2 hover:bg-slate-700 rounded-lg" wire:click="clearFilters">
                        Clear Filters
                    </button>
                </div>

                @if (count($selections) > 0)
                    <div class="flex flex-row justify-start items-center gap-4">
                        <div>Bulk Actions</div>
                        <button type="button" class="bg-red-600 text-white p-2 hover:bg-red-300 rounded-lg"
                                wire:click="bulkDelete"
                                {{-- wire:confirm="Are you sure you want to delete this notes?" --}}>
                            Delete Notes
                        </button>
                    </div>
                @endif


                <div class="bg-orange-500">
                    {{-- json_encode($selections) --}}
                    {{ var_export($selections) }}

                </div>
                {{-- <div>
                    <a href="{{ route('note.index') }}">Clear</a>
                    </div> --}}

                <div class="overflow-hidden ">
                    <table class="min-w-full rounded-xl">
                        <thead>
                            <tr class="bg-gray-50">
                                <th></th>
                                <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize {{ $orderColumn === 'id' ? 'bg-green-200' : '' }}" wire:click="sorting('id')">Id {!! $sortLink !!}</th>
                                <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize {{ $orderColumn === 'title' ? 'bg-green-200' : '' }}" wire:click="sorting('title')">title {!! $sortLink !!}</th>
                                <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize {{ $orderColumn === 'user_id' ? 'bg-green-200' : '' }}" wire:click="sorting('user_id')">user {!! $sortLink !!}</th>
                                <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize {{ $orderColumn === 'pending' ? 'bg-green-200' : '' }}" wire:click="sorting('pending')">pending {!! $sortLink !!}</i></th>
                                <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize {{ $orderColumn === 'category_name' ? 'bg-green-200' : '' }}" wire:click="sorting('category_name')">category {!! $sortLink !!}</th>
                                <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize {{ $orderColumn === 'date' ? 'bg-green-200' : '' }}" wire:click="sorting('date')">date {!! $sortLink !!}</th>
                                <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize {{ $orderColumn === 'rating' ? 'bg-green-200' : '' }}" wire:click="sorting('rating')">rating {!! $sortLink !!}</th>
                                <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize {{ $orderColumn === 'created_at' ? 'bg-green-200' : '' }}" wire:click="sorting('created_at')">created {!! $sortLink !!}</th>
                                <th scope="col" class="p-5 text-center text-sm leading-6 font-semibold text-gray-900 capitalize"> ACTIONS </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300 ">
                            @if ($notes->count())
                                @foreach ($notes as $key => $note)
                                    <tr class="bg-white transition-all duration-500 hover:bg-gray-50">
                                        <td><input wire:model.live="selections" type="checkbox" value={{ $note->id }}></td>
                                        <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ $note->id }}</td>
                                        <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ $note->title }}</td>
                                        <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ $note->user->name }}</td>
                                        <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900 {{ $note->pending === 0 ? 'text-green-400' : 'text-red-400' }}">{{ $note->pending === 0 ? 'No' : 'Yes' }}</td>
                                        <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ $note->category_name }}</td>
                                        <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ $note->date }}</td>
                                        <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900 {{ $note->rating < 5 ? 'text-red-400' : 'text-green-400' }}">{{ $note->rating }}</td>
                                        <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">{{ date('d-m-Y', strtotime($note->created_at)) }}</td>
                                        <td class=" p-5 ">
                                            <!-- ACTIONS -->
                                            <div class="flex justify-center gap-2">
                                                <!-- Upload Image -->
                                                <a href="{{ route('image.index', $note->id) }}">
                                                    <button class="p-2 rounded-full  group transition-all duration-500  flex item-center">
                                                        <i class="fa-solid fa-image"></i>
                                                    </button>
                                                </a>
                                                <!-- See Note -->
                                                <a href="{{ route('note.show', $note) }}">
                                                    <button class="p-2 rounded-full  group transition-all duration-500  flex item-center">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </a>
                                                <!-- Edit Note -->
                                                <a href="{{ route('note.edit', $note) }}">
                                                    <button class="p-2  rounded-full  group transition-all duration-500  flex item-center">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                                <!-- Delete Note -->
                                                <form action="{{ route('note.destroy', $note) }}" method="POST">
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
                                    <td class="p-5 whitespace-nowrap text-xl leading-6 font-medium text-gray-900">No notes found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                <div class="py-2 px-4">
                    {{ $notes->links() }}
                </div>

            </div>
        </div>
    </div>

</div>
