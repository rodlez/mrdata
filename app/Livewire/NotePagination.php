<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
// Model
use App\Models\Note;
use App\Models\Image;
// Services
use App\Services\NoteService;
use App\Services\ImageService;

class NotePagination extends Component
{
    use WithPagination;

    //protected $paginationTheme = "bootstrap";
    public $orderColumn = "id";
    public $sortOrder = "desc";
    public $sortLink = '<i class="fa-solid fa-circle-chevron-up"></i>';
    public $search = "";
    public $perPage = 10;
    // test
    public $pendingNote = 2;
    public $cat = 0;
    public $min = 0;
    public $max = 10;
    public $dateFrom = '';
    public $dateTo = '';
    // multiselection
    public $selections = [];

    // Service Injection in Livewire use the boot function
    // https://dev.to/iamkirillart/how-to-implement-dependency-injection-in-laravel-livewire-con
    public function boot(
        NoteService $noteService,
        ImageService $imageService
    ) {
        $this->noteService = $noteService;
        $this->imageService = $imageService;
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->orderColumn = "id";
        $this->sortOrder = "desc";
        $this->sortLink = '<i class="fa-solid fa-circle-chevron-up"></i>';
        $this->search = "";
        $this->perPage = 10;
        // test
        $this->pendingNote = 2;
        $this->cat = 0;
        $this->min = 0;
        $this->max = 10;
        $this->dateFrom = '';
        $this->dateTo = '';
        $this->selections = [];
    }

    public function bulkDelete()
    {

        foreach ($this->selections as $selection) {
            $note = Note::find($selection);
            $images = $this->noteService->getImages($note);
            if ($images->count() > 0) {
                $this->imageService->deleteImages($images, $note);
            }
            $note->delete();
        }

        return to_route('note.index')->with('message', 'Notes: deleted.');
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

        $this->sortLink = '<i class="fa-solid fa-circle-chevron-' . $caretOrder . '"></i>';
        $this->orderColumn = $columnName;
    }

    public function render()
    {
        $found = 0;

        $categories = Category::orderBy('name', 'asc')->get();

        //showNice($this->pendingNote, 'PENDING');

        //$notes = Note::orderby($this->orderColumn, $this->sortOrder)->select('*');
        // JOIN TO order category by name
        $notes = Note::select(
            'notes.id as id',
            'categories.name as category_name',
            'notes.title as title',
            'notes.user_id as user_id',
            'notes.pending as pending',
            'notes.date as date',
            'notes.rating as rating',
            'notes.created_at as created_at',
            // test
            //'images.id as image_id'
        )
            ->join('categories', 'notes.category_id', '=', 'categories.id')
            //->join('images', 'notes.id', '=', 'images.id')
            ->orderby($this->orderColumn, $this->sortOrder);

        //showNice($notes);

        // interval rating    
        if ($this->min <= $this->max) {
            $notes = $notes->whereBetween('rating', [$this->min, $this->max]);
            //$notes = $notes->where('rating', '<=', $this->max);
        }

        // interval date
        /* if (isset($dateFrom)) {
        if ($this->dateFrom <= $this->dateTo) {
            $notes = $notes->whereBetween('date', [$this->dateFrom, $this->dateTo]);
            //$notes = $notes->where('rating', '<=', $this->max);
        }
        // } */

        // category
        if ($this->cat != 0) {
            $notes = $notes->where('categories.id', '=', $this->cat);
        }

        // pending
        if ($this->pendingNote != 2) {
            $notes = $notes->where('pending', '=', $this->pendingNote);
        }

        if (!empty($this->search)) {
            $found = $notes->where('title', "like", "%" . $this->search . "%")->count();
        }

        $notes = $notes->paginate($this->perPage);

        $totalNotes = $notes->count();


        return view('livewire.note-pagination', [
            'notes' => $notes,
            'found' => $found,
            'total' => $totalNotes,
            'categories' => $categories,
            'orderColumn' => $this->orderColumn
        ]);
    }
}
