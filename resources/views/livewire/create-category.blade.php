<div class="card">
    
    <div class="card-header bg-green-500">
        Inputs
    </div>

    <div class="card-body">
        @foreach ($inputs as $key=>$value)
            <div class="flex">
                <div class="flex flex-column">
                    {{-- Wire the input array --}}
                    <input wire:model="inputs.{{$key}}.name" type="text" class="form-control" placeholder="name">
                        @error('inputs.'.$key.'.name')
                            <div class="bg-red-500">{{$message}}</div>                        
                        @enderror
                </div>
                <div class="flex flex-column">
                    {{-- Wire the input array --}}
                    <input wire:model="inputs.{{$key}}.email" type="email" class="form-control" placeholder="email">
                        @error('inputs.'.$key.'.email')
                            <div class="bg-red-500">{{$message}}</div>                        
                        @enderror
                </div>
                <div class="flex flex-column">
                    {{-- Wire the input array --}}
                    <input wire:model="inputs.{{$key}}.phone" type="number" class="form-control" placeholder="phone">
                        @error('inputs.'.$key.'.phone')
                            <div class="bg-red-500">{{$message}}</div>                        
                        @enderror
                </div>
                <div class="flex flex-column">
                    <button wire:click="remove({{$key}})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Remove
                    </button>
                </div>
            </div>            
        @endforeach
    </div>
    <div class="card-footer py-6">
        <button wire:click="add" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Add
        </button>
        <button wire:click="save" class="bg-blue-500 hover:bg-red-700 text-blue font-bold py-2 px-4 rounded">
            Save
        </button>
    </div>
    
</div>