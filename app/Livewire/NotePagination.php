<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
// Model
use App\Models\Note;

class NotePagination extends Component
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

        $notes = Note::orderby($this->orderColumn, $this->sortOrder)->select('*');

        if (!empty($this->search)) {
            $found = $notes->where('title', "like", "%" . $this->search . "%")->count();
        }

        $notes = $notes->paginate($this->perPage);

        return view('livewire.note-pagination', [
            'notes' => $notes,
            'found' => $found
        ]);
    }
}
