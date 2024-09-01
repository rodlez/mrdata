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
            'inputs' => collect([['name' => '', 'email' => '', 'phone' => '']])
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
        $this->inputs->push(['name' => '', 'email' => '', 'phone' => '']);
    }

    public function save()
    {
        $validated = $this->validate(
            [
                'inputs.*.name' => 'required|min:5|unique:categories,name|distinct',
                'inputs.*.email' => 'nullable|min:3',
                'inputs.*.phone' => 'nullable|min:3'
            ],
            [
                'inputs.*.name.required' => 'The name is required',
                'inputs.*.name.min' => 'The name at least 5 characters',
                'inputs.*.name.unique' => 'The name is already created',
                'inputs.*.name.distinct' => 'The name has a duplicate',
                'inputs.*.email.min' => 'Email 3 al menos tete',
                'inputs.*.phone.min' => 'Phone 3 al menos tete'
            ]
        );

        //dd($validated);
        foreach ($this->inputs as $input) {

            try {
                Category::create(
                    [
                        'name' => $input['name']
                    ]
                );
            } catch (QueryException $exception) {
                // You can check get the details of the error using `errorInfo`:
                $errorInfo = $exception->errorInfo;
                //dd($exception);

                // Return the response to the client..
                return to_route('category.index')->with('message', 'Error(' . $errorInfo[0] . ') creating the category (' . $input['name'] . ')');
            }
        }
        //$this->js("alert('categories saved')");
        return to_route('category.index')->with('message', $this->inputs->count() . ' new Categories created');
    }

    public function render()
    {
        return view('livewire.create-category');
    }
}
