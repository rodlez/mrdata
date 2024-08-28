<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
// Model
use App\Models\Category;



class CatPagination extends Component
{
    use WithPagination;

    //protected $paginationTheme = "bootstrap";
    public $orderColumn = "id";
    public $sortOrder = "desc";
    public $sortLink = '<i class="sorticon fa-solid fa-caret-up"></i>';
    public $search = "";
    // test
    public $perPage = 10;

    public function updated()
    {
        $this->resetPage();
    }

    public function sortOrderito($columnName = "")
    {
        $caretOrder = "up";
        if ($this->sortOrder == 'asc') {
            $this->sortOrder = 'desc';
            $caretOrder = 'down';
        } else {
            $this->sortOrder = 'asc';
            $caretOrder = 'up';
        }

        $this->sortLink = '<i class="sorticon fa-solid fa-caret-' . $caretOrder . '"></i>';
        $this->orderColumn = $columnName;
    }

    public function render()
    {
        //echo "search -> " . $this->search;
        $found = 0;

        $categories = Category::orderby($this->orderColumn, $this->sortOrder)->select('*');
        //->where('name', "like", "%" . 'al' . "%");

        if (!empty($this->search)) {

            // search by id or name
            //$categories->orWhere('id', "like", "%" . $this->search . "%");
            $found = $categories->where('name', "like", "%" . $this->search . "%")->count();
        }

        //$categories = $categories->paginate(10);
        $categories = $categories->paginate($this->perPage);

        return view('livewire.cat-pagination', [
            'categories' => $categories,
            'found' => $found
        ]);
    }
}
