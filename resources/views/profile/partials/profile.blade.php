<div class="tab-pane fade active show" id="Profile" role="tabpanel" aria-labelledby="Profile-tab">
    <div class="bg-white p-4 dashboardCard">
        <div class="profile">
            <div class="profile_upload">
                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <form action="{{ route('avatar.upload') }}" method="post" id="form-image"
                            enctype="multipart/form-data">
                            @csrf
                            <input type='file' id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg" />
                            <label for="imageUpload">
                                <img src="{{ asset('assets/icon16.svg') }} " alt="add file icon">
                            </label>
                        </form>
                    </div>
                    <div class="avatar-preview">
                        <img class="profile-user-img img-responsive img-circle" id="imagePreview"
                            src="{{ $user->avatar_url }} " alt="User profile picture">
                    </div>
                </div>
            </div>
            <div class="row mx-0">
                <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')
                    <div class="col-lg-6 mb-3 mx-auto">
                        <div class="profileForm bg-white p-3 p-md-3 p-lg-4">
                            <div class="form-group mb-3">
                                <label class="mb-1 required">
                                    <span>First Name</span>
                                </label>
                                <div class="form-control form-control-lg">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <input class="w-100" type="text" name="first_name"
                                            value="{{ $user->first_name }}" placeholder="John doe">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1 ">
                                    <span>Last Name</span>
                                </label>
                                <div class="form-control form-control-lg">
                                    <div class="">
                                        <input class="w-100" type="text" name="last_name"
                                            value="{{ $user->last_name }}" placeholder="John doe">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1 ">
                                    <span>User Name</span>
                                </label>
                                <div class="form-control form-control-lg">
                                    <div class="">
                                        <input class="w-100" type="text" name="user_name"
                                            value="{{ $user->user_name }}" placeholder="John doe">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1 ">
                                    <span>Email</span>
                                </label>
                                <div class="form-control form-control-lg">
                                    <input class="w-100" type="email" name="email" value="{{ $user->email }}"
                                        placeholder="i.e. support@flamingo.com">
                                </div>
                            </div>
                            <div class="form-group mb-3 position-relative">
                                <label class="mb-1">
                                    <span>{{ __('Interest') }} (from 1 to 5)</span>
                                </label>
                                {{--                            <div class="position-absolute arrow"><img src="assets/icon18.svg"></div> --}}
                                <select class="form-select intersts" name="interests[]" multiple required>
                                    @forelse($interests as $interest)
                                        <option value="{{ $interest->id }}"
                                            {{ in_array($interest->id, $selectedInterests) ? 'selected' : '' }}>
                                            {{ $interest->name }}</option>
                                    @empty
                                        <option value="">No interest found</option>
                                    @endforelse
                                </select>
                                @error('interests')
                                    <span class="text-danger mt-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row mx-0">
                                <div class="col-lg-6 ps-0">
                                    <div class="form-group mb-3">
                                        <label class="mb-1"><span>Gender</span></label>
                                        <select class="form-select form-select-lg" name="gender">
                                            <option value="">Please Select Gender</option>
                                            <option value="male" @if ($user->gender == 'male') selected @endif>
                                                Male
                                            </option>
                                            <option value="female" @if ($user->gender == 'female') selected @endif>
                                                Female
                                            </option>
                                            <option value="other" @if ($user->gender == 'other') selected @endif>
                                                TransGender
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 pe-0">
                                    <div class="form-group mb-3">
                                        <label class="mb-1 d-flex align-items-center justify-content-between">
                                            <span>Age</span>
                                        </label>
                                        <div class="form-control form-control-lg">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <input class="w-100" type="number" name="age"
                                                    value="{{ $user->age }}" placeholder="24">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="row mx-0">
                                <div class="col-lg-12 w-100 ps-0">
                                    <div class="form-group mb-3">
                                        <label class="mb-1"><span>Country</span></label>
                                        <select class="form-select countries" name="country">
                                            <option value="">Select country</option>
                                            @forelse ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    @if ($user->country == $country->id) selected @endif>
                                                    {{ $country->name }}</option>
                                            @empty
                                                <option value="3">No country found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 w-100 pe-0">
                                    <div class="form-group mb-3">
                                        <label class="mb-1 "><span>State</span></label>
                                        <div class="form-control form-control-lg">
                                            <div class="">
                                                <input class="w-100" type="text" name="state"
                                                    placeholder="California">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="col-lg-12 w-100 ps-0">
                                <div class="form-group mb-3">
                                    <label class="mb-1"><span> Locations</span></label>
                                    <select class="form-select locations" name="location_id">
                                        <option value="">Select location</option>
                                        @forelse ($locations as $location)
                                            <option value="{{ $location->id }}"
                                                @if ($user?->location->id == $location->id) selected @endif
                                                >
                                                {{ $location->name }}</option>
                                        @empty
                                            <option value="3">No location found</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-1 d-flex align-items-center justify-content-between">
                                    <span>Define yourself</span>
                                </label>
                                <div class="form-control form-control-lg">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <textarea rows="6" class="w-100" placeholder="Type you message" name="about">{{ $user->about }} </textarea>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary w-100 mt-3">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
