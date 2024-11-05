@extends('layouts.dashboard')
@section('title', 'User Profile')
@section('content')


    <div class="px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 py-5 eventsInfoWrap">
            <div class="col-lg-12 mb-3">
                <div class="mb-5 d-flex align-items-center justify-content-between">
                    <h2 class="text-danger fw-bold m-0">
                        {{ $user->user_name }}
                    </h2>
                    <a class="text-danger d-flex align-items-center gap-2"
                        href="{{ route('user.feed.show', $user->user_name) }}">
                        View Feed
                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 6H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6m-7 1l9-9m-5 0h5v5" />
                        </svg>
                    </a>
                </div>

                <div class="bg-white p-4 dashboardCard">

                    {{-- <h2 class="text-center">
                        <a class="text-decoration-none text-danger" href="{{ route('user.feed.show', $user->user_name) }}">
                            {{ $user->user_name }}
                        </a>
                    </h2> --}}

                    <nav class="mb-0">
                        <div class="nav nav-tabs border-0 mb-0" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="Profile-tab" data-bs-toggle="tab" data-bs-target="#Profile"
                                type="button" role="tab" aria-controls="Profile" aria-selected="false"><span
                                    class="px-1 px-md-2 px-lg-3">{{ __('Profile') }}</span>
                            </button>
                            <button class="nav-link " id="Info-tab" data-bs-toggle="tab" data-bs-target="#Pages"
                                type="button" role="tab" aria-controls="Info" aria-selected="true"><span
                                    class="px-1 px-md-2 px-lg-3">Pages</span>
                            </button>
                            {{-- <button class="nav-link" id="suggestions-tab" data-bs-toggle="tab"
                                data-bs-target="#Delete-Account" type="button" role="tab" aria-controls="Photos"
                                aria-selected="false"><span class="px-1 px-md-2 px-lg-3">{{ __('Delete account') }}</span>
                            </button> --}}
                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="tab-content p-0 border-0" id="nav-tabContent">
                    <div class="tab-pane fade active show" id="Profile" role="tabpanel" aria-labelledby="Profile-tab">
                        <div class="bg-white p-4 dashboardCard">
                            <div class="profile">
                                <div class="container">
                                    <div class="profile-detail-info mt-5">
                                        <div class="row g-4">
                                            <div class="col-12 text-center">
                                                @if ($user->avatar_url != '')
                                                    <img src="{{ $user->avatar_url }}" class="profile-image"
                                                        alt="Profile Picture">
                                                @else
                                                    <img src="{{ asset('assets/avatar.jpg') }}" class="profile-image"
                                                        alt="Profile Picture">
                                                @endif
                                            </div>
                                            <div class="col-12 d-flex align-items-center gap-4 justify-content-end">
                                                <h6 class="fw-bold m-0 text-secondary">Account Status:</h6>
                                                <span
                                                    class="badge rounded-pill {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="fw-bold">First Name:</h6>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $user->first_name }}">
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="fw-bold">Last Name:</h6>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $user->last_name }}">
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="fw-bold">User Name:</h6>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $user->user_name }}">
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="fw-bold">Email:</h6>
                                                <input type="email" disabled class="form-control"
                                                    value="{{ $user->email }}">
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="fw-bold">Gender:</h6>
                                                <input type="email" disabled class="form-control"
                                                    value="{{ $user->gender }}">
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="fw-bold">Age:</h6>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $user->age }}">
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="fw-bold">Country:</h6>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $user->country?->name }}">
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="fw-bold">County:</h6>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $user->county?->name }}">
                                            </div>


                                            {{-- Dog Information --}}
                                            <div class="col-md-6">
                                                <h6 class="fw-bold">{{ __('Breed of dog') }}</h6>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $user->userInfo?->dog_breed }}">
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="fw-bold">{{ __("Dog's gender") }}</h6>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $user->userInfo?->dog_gender }}">
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="fw-bold">{{ __('Kennel club') }}</h6>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $user->userInfo?->kennel_club }}">
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="fw-bold">{{ __('Working dog club') }}</h6>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $user->userInfo?->dog_working_club }}">
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="fw-bold">{{ __('Height at the withers') }}</h6>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $user->userInfo?->dog_withers_height }}">
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="fw-bold">{{ __('Weight') }}</h6>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $user->userInfo?->weight }}">
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="fw-bold">{{ __('Size') }}</h6>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $user->userInfo?->size }}">
                                            </div>


                                            <div class="col-md-6">
                                                <h6 class="fw-bold">{{ __('Castrated') }}</h6>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $user->userInfo?->castrated }}">
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="fw-bold">{{ __('Targeting') }}</h6>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $user->userInfo?->target }}">
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="fw-bold">{{ __('Furr') }}</h6>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $user->userInfo?->furr }}">
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="fw-bold">{{ __('Drawing') }}</h6>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $user->userInfo?->drawing }}">
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="fw-bold">{{ __('Hills') }}</h6>
                                                <input type="text" disabled class="form-control"
                                                    value="{{ $user->userInfo?->hills }}">
                                            </div>

















                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Pages" role="tabpanel" aria-labelledby="Pages-tab">
                        <div class="bg-white p-4 dashboardCard">
                            <div class="profile">
                                <div class="row mx-0">
                                    @forelse ($pages as $page)
                                        <div class="col-lg-6 mb-3">
                                            <a href="" class="text-decoration-none">
                                                <div class="marketPlaceCard p-3 d-flex align-items-start gap-4">
                                                    <img src=" {{ $page->profile_image_url }} ">
                                                    <div class="content w-100">
                                                        <div class="d-flex align-items-center">
                                                            <span>{{ __('Starts from') }}
                                                                :{{ $page->formatted_start_date }}
                                                                {{ __('To') }}:
                                                                {{ $page->formatted_end_date }} </span>

                                                        </div>

                                                        @if ($page->isPrivate())
                                                            <div class="tags mb-2">
                                                                <span
                                                                    class="px-1 py-1 fw-bold bg-info text-white">Private</span>
                                                            </div>
                                                        @endif

                                                        <a href="{{ route('pages.show', $page->slug) }}"
                                                            class="text-decoration-none">
                                                            <h5 class="mb-1">{{ $page->name }}</h5>
                                                            <p class="mb-2"> {{ limitString($page->description) }} </p>
                                                        </a>
                                                        <div class="owners">
                                                            <div class="text mb-2">{{ __('Other Owners') }}</div>
                                                            <div class="tags d-flex gap-3 align-items-center flex-wrap">
                                                                @forelse ($page->users as $user)
                                                                    <span class="px-2 py-1">{{ $user->user_name }}</span>
                                                                @empty
                                                                    <span class="px-2 py-1">No
                                                                        {{ __('other owners') }}</span>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                        <div class="interests">
                                                            <div class="text mb-2">Interests</div>
                                                            <div class="tags d-flex gap-3 align-items-center flex-wrap">
                                                                @forelse ($page->interests as $interest)
                                                                    <span class="px-2 py-1">{{ $interest->name }}</span>
                                                                @empty
                                                                    <span class="px-2 py-1">No interest</span>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @empty
                                        <x-no-data-found />
                                    @endforelse
                                </div>
                                <div class="paginator p-2">
                                    {{ $pages->onEachSide(2)->links() }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $(".intersts").select2({
                placeholder: "{{ __('Please select interests') }}",
                allowClear: false
            });

            $(".locations").select2({
                placeholder: "{{ __('Please select location') }}",
                allowClear: false
            });

            let form = document.getElementById('form-image');
            $("#imageUpload").change(function(data) {
                let imageFile = data.target.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(imageFile);
                reader.onload = function(evt) {
                    let ele = $('#imagePreview');
                    ele.attr('src', evt.target.result);
                    ele.hide();
                    ele.fadeIn(650);
                }
                form.submit();
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteAccountForm = document.getElementById('deleteAccountForm');
            const passwordInput = document.getElementById('password');
            const deleteAccountButton = document.getElementById('deleteAccountButton');

            // Optional: Validate password input
            deleteAccountForm.addEventListener('submit', function(e) {
                if (!passwordInput.value) {
                    e.preventDefault();
                    alert('Please enter your password.');
                }
            });

            // Optional: Custom actions when the modal is shown
            var deleteAccountModal = new bootstrap.Modal(document.getElementById('deleteAccountModal'));
            deleteAccountModal._element.addEventListener('shown.bs.modal', function() {
                // Custom code to run when the modal is shown
                console.log('Modal is shown');
            });

            // Optional: Custom actions when the modal is hidden
            deleteAccountModal._element.addEventListener('hidden.bs.modal', function() {
                // Reset the form when the modal is hidden
                deleteAccountForm.reset();
            });

            // Attach event to button to manually show the modal (if needed)
            if (deleteAccountButton) {
                deleteAccountButton.addEventListener('click', function() {
                    deleteAccountModal.show();
                });
            }
        });
    </script>

@endsection
