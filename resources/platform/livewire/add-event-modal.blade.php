<div>
    <!-- Button trigger modal -->
    {{-- <button type="button" class="btn bg-gradient-dark" data-bs-toggle="modal" data-bs-target="#createEventModal">
        Add Event
    </button> --}}

    <!-- Modal -->
    <div class="modal fade" id="createEventModal" tabindex="-1" role="dialog" aria-labelledby="createEventModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createEventModalLabel">Create Event</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" wire:model="description" id="description" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="starts_at">Starts at</label>
                        <input type="datetime-local" wire:model="startsAt" class="form-control" id="starts_at"
                            placeholder="Starts At">
                    </div>
                    @if (!$allDay)
                        <div class="form-group">
                            <label for="ends_at">Ends at</label>
                            <input type="datetime-local" wire:model="endsAt" class="form-control" id="ends_at"
                                placeholder="Ends At">
                        </div>
                    @endif
                    <div class="form-check form-switch">
                        <input class="form-check-input" wire:model="allDay" value="1" type="checkbox"
                            id="flexSwitchCheckDefault" @if ($allDay) checked="" @endif>
                        <label class="form-check-label" for="flexSwitchCheckDefault">All Day</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click="createEvent" class="btn bg-gradient-dark">Create</button>
                </div>
            </div>
        </div>
    </div>
</div>
