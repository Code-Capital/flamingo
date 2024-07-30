<div class="tab-pane fade " id="Update-Password" role="tabpanel" aria-labelledby="Info-tab">
    <div class="bg-white p-4 dashboardCard">
        <div class="row mx-0">
            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('patch')
                <div class="col-lg-6 mb-3 mx-auto">
                    <div class="profileForm bg-white p-3 p-md-3 p-lg-4">
                        <div class="form-group mb-3">
                            <label class="mb-1 d-flex align-items-center justify-content-between">
                                <span>Name</span>
                                <span class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('assets/icon11.svg') }}"
                                        alt="public email">Public
                                </span>
                            </label>
                            <div class="form-control form-control-lg">
                                <div class="d-flex align-items-center justify-content-between">
                                    <input class="w-100" type="text" name="name"
                                        value="{{ $user->name }}" placeholder="Muhammad Usama">
                                    <a class="text-decoration-none" href="javascript:void(0)"><img
                                            src="{{ asset('assets/pencil.svg') }}"
                                            alt="pencil"></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1 d-flex align-items-center justify-content-between">
                                <span>Email</span>
                            </label>
                            <div class="form-control form-control-lg">
                                <div class="d-flex align-items-center justify-content-between">
                                    <input class="w-100" type="email" name="email"
                                        value="{{ $user->email }}"
                                        placeholder="i.e. support@peopleconnect.com">
                                </div>
                            </div>
                        </div>
                        <div class="row mx-0">
                            <div class="col-lg-6 ps-0">
                                <div class="form-group mb-3">
                                    <label class="mb-1"><span>Gender</span></label>
                                    <select class="form-select form-select-lg">
                                        <option value="">Please Select Gender</option>
                                        <option value="male"
                                            @if ($user->gender == 'male') selected @endif>
                                            Male
                                        </option>
                                        <option value="female"
                                            @if ($user->gender == 'female') selected @endif>
                                            Female
                                        </option>
                                        <option value="other"
                                            @if ($user->gender == 'other') selected @endif>
                                            TransGender
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 pe-0">
                                <div class="form-group mb-3">
                                    <label
                                        class="mb-1 d-flex align-items-center justify-content-between">
                                        <span>Age</span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" type="number"
                                                value="{{ $user->age }}" placeholder="24">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mx-0">
                            <div class="col-lg-6 ps-0">
                                <div class="form-group mb-3">
                                    <label class="mb-1">Country</label>
                                    <select class="form-select form-select-lg" name="">
                                        <option selected>USA</option>
                                        <option value="1">UK</option>
                                        <option value="2">UAE</option>
                                        <option value="3">EUROPE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 pe-0">
                                <div class="form-group mb-3">
                                    <label
                                        class="mb-1 d-flex align-items-center justify-content-between">
                                        <span>State</span>
                                    </label>
                                    <div class="form-control form-control-lg">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="w-100" type="text"
                                                placeholder="California">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1 d-flex align-items-center justify-content-between">
                                <span>Define yourself</span>
                            </label>
                            <div class="form-control form-control-lg">
                                <div class="d-flex align-items-center justify-content-between">
                                    <textarea rows="6" class="w-100" placeholder="Type you message"></textarea>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary w-100 mt-3">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
