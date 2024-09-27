<div>
    <div class="col-12">
        <div class="card">
            @if($cardHeader)
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                    <div class="card-actions">
                        @if($changableColumns)
                            <div>
                                @foreach($columns as $column => $field)
                                    <div class="form-selectgroup">
                                        <label class="form-selectgroup-item">
                                            <input type="checkbox" name="name" value="HTML" class="form-selectgroup-input" @if($field['show'] ?? true) checked wire:click="updateColumn('{{$column}}', 'hide')" @else wire:click="updateColumn('{{$column}}', 'show')"  @endif />
                                            <span class="form-selectgroup-label" style="font-size: 10px;">{!! $field['label'] !!}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            @if($cardTop)
                <div class="card-body border-bottom py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column">
                            <div class="text-secondary me-2 mb-3">
                                Show
                                <div class="mx-2 d-inline-block">
                                    <input type="text" class="form-control form-control-sm" wire:model.live="paginate" value="" size="3" aria-label="Count" />
                                </div>
                                entries
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="dropdown" style="margin-right: 20px;">
                                <a href="#" class="btn dropdown-toggle mb-0 @if(count($selectedItems) == 0) disabled @endif" data-bs-toggle="dropdown">Mass Actions</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">
                                        Action
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        Another action
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <button class="dropdown-item text-red"type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#massDeleteModal">Delete All</button>
                                </div>
                            </div>

                            @if($allowSearch)
                                <div class="ms-auto text-secondary">
                                    Search:
                                    <div class="ms-2 d-inline-block">
                                        <input type="text" wire:model.live.debounce.300ms="search" class="form-control form-control-sm" aria-label="Search" />
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            <div class="table-responsive">
                @if($query->count() > 0)
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                        <tr>
                            @if($allowMassActions)
                                <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" wire:click="selectAllInQueryFn" aria-label="Select all invoices" /></th>
                            @endif
                            @foreach($columns as $column => $field)
                                @if(isset($field['show']) AND !$field['show']) @else
                                    <th wire:click="fieldSortBy('{{ $column }}')">
                                        {!! $field['label'] !!}
                                        @if($field['sortable'] ?? false)
                                            @if($sortDirection == 'asc' && $sortBy == $column)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-sm icon-thickn">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M6 15l6 -6l6 6" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-sm icon-thickn">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M6 9l6 6l6 -6" />
                                                </svg>
                                            @endif
                                        @endif
                                    </th>
                                @endif
                            @endforeach
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($query as $model)
                            <tr>
                                @if($allowMassActions)
                                    <td><input class="form-check-input m-0 align-middle" @if(in_array($model->{$primaryKey}, $selectedItems)) checked @endif wire:click="selectItem('{{ $model->{$primaryKey} }}')" type="checkbox" aria-label="Select invoice" /></td>
                                @endif
                                @foreach($columns as $column => $field)
                                    @if(isset($field['show']) AND !$field['show']) @else
                                        <td {!! $field['attributes'] ?? '' !!}>
                                            @if($field['render'] ?? false)
                                                {!! Blade::render($field['render'], ['model' => $model]) !!}
                                            @else
                                                {{ $model->{$column} }}
                                            @endif
                                        </td>
                                    @endif
                                @endforeach
                                <td class="text-end">
                                <span class="dropdown">
                                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <button class="dropdown-item text-red" wire:confirm="Are you sure you want to delete this user?" wire:click="deleteItems([{{ $model->getKey() }}])">Delete</button>
                                    </div>
                                </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty d-flex align-items-center flex-column mt-4">
                        <p class="empty-title">No results found</p>
                        <p class="empty-subtitle text-secondary">
                            Try adjusting your search or filter to find what you're looking for.
                        </p>
                        <div class="empty-action">
                            <x-platform::button wire:click="$refresh">
                                Search again
                            </x-platform::button>
                        </div>
                    </div>
                @endif
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <p class="m-0 text-secondary">Showing <span>{{ $query->firstItem() }}</span> to <span>{{ $query->lastItem() }}</span> of <span>{{ $model::count() }}</span> entries</p>
                {{ $query->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    @if(count($selectedItems) > 0)
        <div class="modal modal-blur" id="massDeleteModal" tabindex="-1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-danger"></div>
                    <div class="modal-body text-center py-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 9v2m0 4v.01" />
                            <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                        </svg>
                        <h3>Are you sure?</h3>
                        <div class="text-secondary mb-2">Do you really want to remove {{ count($selectedItems) }} records? What you've done cannot be undone.</div>
                        <div>
                            <div class="table-responsive">
                                <table class="table table-vcenter">
                                    <thead>
                                    <tr>
                                        @foreach(collect($columns)->take($massColumnCount) as $column => $field)
                                            <th>{!! $field['label'] !!}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($selectedItems as $item)
                                        @php
                                            $selectedItemModal = $this->model::find($item);

                                            if(!$selectedItemModal) {
                                                continue;
                                            }
                                        @endphp
                                        <tr>
                                            @foreach(collect($columns)->take($massColumnCount) as $column => $field)
                                                <td>
                                                    @if($field['render'] ?? false)
                                                        {!! Blade::render($field['render'], ['model' => $selectedItemModal]) !!}
                                                    @else
                                                        {{ $selectedItemModal->{$column} }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col">
                                    <x-platform::button color="default" class="w-100" data-bs-dismiss="modal">
                                        Cancel
                                    </x-platform::button>
                                </div>
                                <div class="col">
                                    <x-platform::button color="danger" class="w-100" wire:confirm="Are you sure you want to delete this appointment?" wire:click="deleteItems()" data-bs-dismiss="modal">
                                        Delete {{ count($selectedItems) }} items
                                    </x-platform::button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
