<div class="col-lg-6 mb-3">
    <div class="announcementCard p-2 d-flex align-items-start gap-4">
        <img src="{{ $event->thumbnail_url }}">
        <div class="content w-100">
            <div class="d-flex align-items-center">
                <span>{{ __('Starts from') }} :{{ $event->formatted_start_date }} {{ __('To') }}:
                    {{ $event->formatted_end_date }} </span>
                <div class="ms-auto dropdown">
                    <button class="btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        ...
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                            <a class="dropdown-item" href="{{ route('events.show', $event->slug) }}">View</a>
                        </li>
                        @if ($user && $event->isOwner($user))
                            @if ($event->isUpcoming() || $event->isOngoing())
                                <li>
                                    <a class="dropdown-item" href="{{ route('events.edit', $event->slug) }}">Edit</a>
                                </li>
                                <li>
                                    <form action="{{ route('events.destroy', $event->slug) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this event?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item">{{ __('Delete') }}</button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('events.close', $event->slug) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this event?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item">Close Event</button>
                                    </form>
                                </li>
                            @endif
                        @endif
                        @if (!$event->isOwner($user))
                            <li>
                                <a class="dropdown-item event-report" data-event="{{ $event->id }}"
                                    href="javascript:void(0)">Report</a>
                            </li>
                        @endif
                        @if (Request::routeIs('events.joined'))
                            <li>
                                <a class="dropdown-item leave-event" data-event="{{ $event->id }}"
                                    href="javascript:void(0)">Leave</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="tags mb-2">
                @if ($event->isUpcoming())
                    <span class="px-1 py-1 fw-bold bg-success text-white">Upcoming</span>
                @elseif ($event->isOngoing())
                    <span class="px-1 py-1 fw-bold bg-warning text-white">{{ __('Ongoing') }}</span>
                @else
                    <span class="px-1 py-1 fw-bold bg-danger text-white">Ended</span>
                @endif
            </div>

            <a href="{{ $url ?? route('events.show', $event->slug) }}" class="text-decoration-none">
                <h5 class="mb-1"> {{ $event->title }} </h5>
                <p class="mb-2"> {{ limitString($event->description, 50) }} </p>
                <div class="text mb-2"># Interests</div>
                <div class="tags d-flex gap-3 align-items-center flex-wrap">
                    @forelse ($event->interests as $interest)
                        <span class="px-2 py-1">{{ $interest->name }}</span>
                    @empty
                        <span class="px-2 py-1">No interests</span>
                    @endforelse
                </div>
            </a>
            @if ($joiningCount > 0)
                @if ($event->isPast())
                    <div class="tags d-flex align-items-center pt-2">
                        <span class="px-2 py-1 bg-light text-white rounded">Unable to join</span>
                    </div>
                @else
                    @if (!$event->allMembers()->where('user_id', $user->id)->exists())
                        <div class="d-flex align-items-center pt-2">
                            <a class="join-event text-decoration-none" data-id="{{ $event->id }}"
                                href="javascript:void(0)">
                                <small class="text-white p-1 rounded bg-primary">Join Event</small>
                            </a>
                        </div>
                    @else
                        <div class="tags d-flex align-items-center pt-2">
                            <span class="px-2 py-1 bg-success text-white rounded">Request sent</span>
                        </div>
                    @endif
                @endif
            @endif
        </div>
    </div>
</div>
