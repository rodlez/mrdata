<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
// Model
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Database\QueryException;

class CreateCategory extends Component
{
    public $inputs;

    public function mount()
    {
        $this->fill([
            'inputs' => collect([['name' => '']])
        ]);
    }

    public function remove($key)
    {
        //dd($key);
        $this->inputs->pull($key);
    }

    public function add()
    {
        //dd($key);
        $this->inputs->push(['name' => '']);
    }

    public function save()
    {
        $validated = $this->validate(
            [
                'inputs.*.name' => 'required|min:3|unique:categories,name|distinct',
            ],
            [
                'inputs.*.name.required' => 'The name is required',
                'inputs.*.name.min' => 'The name at least 3 characters',
                'inputs.*.name.unique' => 'The name is already created',
                'inputs.*.name.distinct' => 'The name has a duplicate'
            ]
        );

        //dd($validated);
        foreach ($this->inputs as $input) {

            try {

                Category::create(['name' => $input['name']]);
            } catch (QueryException $exception) {

                $errorInfo = $exception->errorInfo;

                // Return the response to the client..
                return to_route('category.index')->with('message', 'Error(' . $errorInfo[0] . ') creating the category (' . $input['name'] . ')');
            }
        }

        return to_route('category.index')->with('message', $this->inputs->count() . ' new Category(es) created');
    }

    public function render()
    {
        return view('livewire.create-category');
    }
}
