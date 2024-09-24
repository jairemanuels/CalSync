<?php

namespace App\Livewire\Platform;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class ModelTable extends Component
{
    use WithPagination;

    public $title = '';

    public $model;

    public $primaryKey = 'id';

    public $allowSearch = true;

    public array $columns = [];

    #[Url]
    public $sortBy = 'id';

    #[Url]
    public $sortDirection = 'asc';

    #[Url]
    public $paginate = 15;

    #[Url]
    public $search = '';

    public array $selectedItems = [];

    public bool $hasCreateModal = false;

    public array $createModal = [];

    public array $createParams;

    public $massColumnCount = 3;

    public $selectAllInQuery = false;

    public $cardHeader = true;

    public $cardTop = true;

    public $allowMassActions = true;

    public $changableColumns = true;

    public function mount()
    {
        $this->primaryKey = (new $this->model)->getKeyName();

        $this->hasCreateModal = !empty($this->createModal);
    }

    public function fieldSortBy($field)
    {
        if ($this->sortBy == $field) {
            $this->sortDirection = ($this->sortDirection == 'asc') ? 'desc' : 'asc';
            return;
        }

        $this->sortBy = $field;
        $this->sortDirection = 'asc';
    }

    public function selectItem($id)
    {
        if (in_array($id, $this->selectedItems)) {
            $this->selectedItems = array_diff($this->selectedItems, [$id]);
            return;
        }

        $this->selectedItems[] = $id;
    }

    public function selectAllInQueryFn()
    {
        $this->selectAllInQuery = !$this->selectAllInQuery;

        // if false then clear all selected items
        if(!$this->selectAllInQuery) {
            $this->selectedItems = [];
        }
    }

    public function createItem()
    {
        dd($this->createParams);
    }

    public function deleteItems(array $ids = [])
    {
        if(empty($ids)) {
            $ids = $this->selectedItems;
        }

        foreach($ids as $id) {
            $item = $this->model::find($id);

            if($item) {
                $item->delete();
            }
        }

        $this->selectedItems = [];
        $this->selectAllInQuery = false;
    }

    public function updateColumn($column, $state)
    {
        if(!array_key_exists($column, $this->columns) OR !$this->changableColumns) {
            return;
        }

        if($state == 'hide') {
            // find column with array key $column and set show on array to false
            $this->columns[$column]['show'] = false;
            return;
        }

        $this->columns[$column]['show'] = true;
    }

    public function render()
    {
        $query = $this->model::query();

        // search
        if($this->allowSearch) {
            $query = $query->search($this->search);
        }

        // sort
        $query = $query->orderBy($this->sortBy, $this->sortDirection);

        // paginate
        $query = $query->paginate($this->paginate);

        if($this->selectAllInQuery) {
            $this->selectedItems = $query->pluck($this->primaryKey)->toArray();
        }

        return view('platform::livewire.model-table', [
            'query' => $query
        ]);
    }
}
