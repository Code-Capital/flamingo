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
                    <div class="col-lg-12 mb-3 mx-auto">
                        <div class="profileForm bg-white">
                            <div class="row">
                                <div class=" col-lg-6 form-group mb-3">
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
                                <div class=" col-lg-6 form-group mb-3">
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
                                <div class=" col-lg-6 form-group mb-3">
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
                                <div class=" col-lg-6 form-group mb-3">
                                    <label class="mb-1 ">
                                        <span>Email</span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <input class="w-100" type="email" name="email" value="{{ $user->email }}"
                                            placeholder="i.e. support@flamingo.com">
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group mb-3">
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
                                <div class="col-lg-6 form-group mb-3">
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
                                <div class="col-lg-6 form-group mb-3">
                                    <label class="mb-1"><span> Locations</span></label>
                                    <select class="form-select locations" name="location_id">
                                        <option value="">Select location</option>
                                        @forelse ($locations as $location)
                                            <option value="{{ $location->id }}"
                                                @if ($user?->location?->id == $location->id) selected @endif>
                                                {{ $location->name }}</option>
                                        @empty
                                            <option value="3">No location found</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group mb-3">
                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                        <span>Municipality</span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" type="text" name="municipality"
                                                value="{{ $user?->userInfo?->municipality }}"
                                                placeholder="municipality">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group mb-3">
                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                        <span>Breed of dog</span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" type="text" name="dog_breed"
                                                value="{{ $user?->userInfo?->dog_breed }}"
                                                placeholder="Breed of dog">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group mb-3">
                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                        <span>Dog's gender</span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" type="text" name="dog_gender"
                                                value="{{ $user?->userInfo?->dog_gender }}"
                                                placeholder="Dog's gender">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group mb-3">
                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                        <span>Kennel club</span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" type="text" name="kennel_club"
                                                value="{{ $user?->userInfo?->kennel_club }}"
                                                placeholder="Kennel club">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group mb-3">
                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                        <span>Working dog club
                                        </span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" type="text" name="dog_working_club"
                                                value="{{ $user?->userInfo?->dog_working_club }}"
                                                placeholder="Working dog club">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group mb-3">
                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                        <span>Height at the withers
                                        </span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" type="text" name="dog_withers_height"
                                                value="{{ $user?->userInfo?->dog_withers_height }}"
                                                placeholder="Height at the withers">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group mb-3">
                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                        <span>Weight
                                        </span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" type="text" name="weight"
                                                value="{{ $user?->userInfo?->weight }}" placeholder="Weight">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group mb-3">
                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                        <span>Size
                                        </span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" type="text" name="size"
                                                value="{{ $user?->userInfo?->size }}" placeholder="size">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group mb-3">
                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                        <span>Castrated
                                        </span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" type="text" name="castrated"
                                                value="{{ $user?->userInfo?->castrated }}" placeholder="Castrated">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group mb-3">
                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                        <span>Targeting
                                        </span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" type="text" name="targeting"
                                                value="{{ $user?->userInfo?->targeting }}" placeholder="Targeting">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group mb-3">
                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                        <span>Fur
                                        </span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" type="text" name="furr"
                                                value="{{ $user?->userInfo?->furr }}" placeholder="Furr">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group mb-3">
                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                        <span>Drawing
                                        </span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" type="text" name="drawing"
                                                value="{{ $user?->userInfo?->drawing }}" placeholder="Drawing">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group mb-3">
                                    <label class="mb-1 d-flex align-items-center justify-content-between">
                                        <span>Hills
                                        </span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" type="text" name="hills"
                                                value="{{ $user?->userInfo?->hills }}" placeholder="hills">
                                        </div>
                                    </div>
                                </div>


                                {{-- Descriptions --}}
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
                                {{-- Interests --}}
                                <div class="form-group mb-3">
                                    <label class="mb-1">
                                        <span>{{ __('Interest') }} (from 1 to 5)</span>
                                    </label>
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
