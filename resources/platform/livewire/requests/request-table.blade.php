<div>
    <div class="card">
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Team</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Status
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date
                        </th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (auth()->user()->teams as $team)
                        @foreach ($team->requests as $request)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="{{ $request->user->avatar() }}" class="avatar avatar-sm me-3">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-xs">{{ $request->user->name }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ $request->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $team->name }}</p>
                                    <p class="text-xs text-secondary mb-0">{{ $team->description }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if ($request->status == 'pending')
                                        <span class="badge badge-sm badge-warning">Pending</span>
                                    @endif

                                    @if ($request->status == 'active')
                                        <span class="badge badge-sm badge-success">Active</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    <span
                                        class="text-secondary text-xs font-weight-bold">{{ $request->created_at->diffForHumans() }}</span>
                                </td>
                                <td class="align-middle">
                                    @if ($request->status == 'pending')
                                        <button wire:click="accept('{{ $request->id }}')"
                                            class="btn btn-success btn-sm">Accept</button>
                                        <button wire:click="decline('{{ $request->id }}')"
                                            wire:confirm="Are you sure you want to decline {{ $request->user->name }}"
                                            class="btn btn-warning btn-sm">Decline</button>
                                    @endif

                                    @if ($request->status == 'active')
                                        <button wire:click="remove('{{ $request->id }}')"
                                            wire:confirm="Are you sure you want to remove {{ $request->user->name }}"
                                            class="btn btn-danger btn-sm">Remove</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
