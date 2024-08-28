<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
// Model
use App\Models\Tag;

class TagPagination extends Component
{
    use WithPagination;

    //protected $paginationTheme = "bootstrap";
    public $orderColumn = "id";
    public $sortOrder = "desc";
    public $sortLink = '<i class="sorticon fa-solid fa-caret-up"></i>';
    public $search = "";
    public $perPage = 10;

    public function updated()
    {
        $this->resetPage();
    }

    public function sorting($columnName = "")
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
        $found = 0;

        $tags = Tag::orderby($this->orderColumn, $this->sortOrder)->select('*');

        if (!empty($this->search)) {
            $found = $tags->where('name', "like", "%" . $this->search . "%")->count();
        }

        $tags = $tags->paginate($this->perPage);

        return view('livewire.tag-pagination', [
            'tags' => $tags,
            'found' => $found
        ]);
    }
}
