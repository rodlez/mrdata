<div class="px-8">
    
    <div class="text-xl py-4">
        Create New Tag
    </div>

    <div class="my-4">
        @foreach ($inputs as $key=>$value)
            <div class="flex my-2">
                <div class="flex flex-column">
                    {{-- Wire the input using an array --}}
                    <input wire:model="inputs.{{$key}}.name" type="text" class="form-control" placeholder="enter tag">                       
                </div>                
                <div class="flex flex-column mx-4">
                    <button wire:click="remove({{$key}})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Remove
                    </button>
                </div>
            </div>
            <div class="flex">
                @error('inputs.'.$key.'.name')
                    <div class="text-red-500">{{$message}}</div>                        
                @enderror
            </div>
        @endforeach
    </div>

    <div class="py-6">
        <button wire:click="add" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-8 rounded">
            Add
        </button>    
        <button wire:click="save" class="bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-8 mx-4 rounded">
            Save 
        </button>
        <a href="{{ route('tag.index') }}">
            <button class="bg-slate-700 hover:bg-slate-600 text-white font-bold py-2 px-8 mx-0 rounded">
                Back
            </button>
        </a>       
    </div>
    
</div>
