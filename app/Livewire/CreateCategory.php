<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
// Model
use App\Models\Category;


class CreateCategory extends Component
{

    #[Validate('required|min:5|unique:categories,name')]
    public $name = '';

    public function save()
    {
        $this->validate();

        Category::create(
            $this->only(['name'])
        );

        session()->flash('message', 'Category (' . $this->name . ') successfully creadita.');
        $this->dispatch('alert_remove');
        //return $this->redirect('/category');        
        return to_route('category.index');
    }

    public function render()
    {
        return view('livewire.create-category');
    }
}
