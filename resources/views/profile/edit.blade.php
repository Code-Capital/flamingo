@extends('layouts.dashboard')
@section('title', 'Profile')
@section('styles')
@endsection
@section('content')
    <div class="container px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5 eventsInfoWrap">
            <div class="col-lg-12 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <nav class="mb-0">
                        <div class="nav nav-tabs border-0 mb-0" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="Profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#Profile" type="button" role="tab" aria-controls="Profile"
                                    aria-selected="false"><span class="px-1 px-md-2 px-lg-3">Profile</span>
                            </button>
                            <button class="nav-link " id="Info-tab" data-bs-toggle="tab"
                                    data-bs-target="#Update-Profile" type="button" role="tab" aria-controls="Info"
                                    aria-selected="true"><span class="px-1 px-md-2 px-lg-3">Update password</span>
                            </button>
                            <button class="nav-link" id="suggestions-tab" data-bs-toggle="tab"
                                    data-bs-target="#Delete-Account" type="button" role="tab"
                                    aria-controls="Photos" aria-selected="false"><span
                                    class="px-1 px-md-2 px-lg-3">Delete Account</span>
                            </button>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="tab-content p-0 border-0" id="nav-tabContent">
                    <div class="tab-pane fade active show" id="Profile" role="tabpanel" aria-labelledby="Profile-tab">
                        <div class="bg-white p-4 dashboardCard">
                            <div class="profile">
                                <div class="profile_upload">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <form action="{{ route('avatar.upload') }}" method="post" id="form-image"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <input type='file' id="imageUpload" name="avatar"
                                                       accept=".png, .jpg, .jpeg"/>
                                                <label for="imageUpload">
                                                    <img src="{{ asset('assets/icon16.svg') }} " alt="add file icon">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="avatar-preview">
                                            <img class="profile-user-img img-responsive img-circle"
                                                 id="imagePreview"
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
                                                    <label
                                                        class="mb-1 d-flex align-items-center justify-content-between">
                                                        <span>Name</span>
                                                        <span
                                                            class="d-flex align-items-center gap-2">
                                                            <img src="{{ asset('assets/icon11.svg') }}"
                                                                 alt="public email">Public
                                                        </span>
                                                    </label>
                                                    <div class="form-control form-control-lg">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <input class="w-100" type="text" name="name"
                                                                   value="{{ $user->name }}"
                                                                   placeholder="Muhammad Usama">
                                                            <a class="text-decoration-none"
                                                               href="javascript:void(0)"><img
                                                                    src="{{ asset('assets/pencil.svg') }}" alt="pencil"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="mb-1 d-flex align-items-center justify-content-between">
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
                                                                        @if($user->gender == 'male') selected @endif>
                                                                    Male
                                                                </option>
                                                                <option value="female"
                                                                        @if($user->gender == 'female') selected @endif>
                                                                    Female
                                                                </option>
                                                                <option value="other"
                                                                        @if($user->gender == 'other') selected @endif>
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
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between">
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
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between">
                                                                    <input class="w-100" type="text"
                                                                           placeholder="California">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label
                                                        class="mb-1 d-flex align-items-center justify-content-between">
                                                        <span>Define yourself</span>
                                                    </label>
                                                    <div class="form-control form-control-lg">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <textarea rows="6" class="w-100"
                                                                      placeholder="Type you message"></textarea>
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
                    </div>
                    <div class="tab-pane fade " id="Update-Profile" role="tabpanel"
                         aria-labelledby="Info-tab">
                        <div class="bg-white p-4 dashboardCard">
                            <div class="row mx-0">
                                <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                                    @csrf
                                    @method('patch')
                                    <div class="col-lg-6 mb-3 mx-auto">
                                        <div class="profileForm bg-white p-3 p-md-3 p-lg-4">
                                            <div class="form-group mb-3">
                                                <label
                                                    class="mb-1 d-flex align-items-center justify-content-between">
                                                    <span>Name</span>
                                                    <span
                                                        class="d-flex align-items-center gap-2">
                                                            <img src="{{ asset('assets/icon11.svg') }}"
                                                                 alt="public email">Public
                                                        </span>
                                                </label>
                                                <div class="form-control form-control-lg">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <input class="w-100" type="text" name="name"
                                                               value="{{ $user->name }}"
                                                               placeholder="Muhammad Usama">
                                                        <a class="text-decoration-none"
                                                           href="javascript:void(0)"><img
                                                                src="{{ asset('assets/pencil.svg') }}" alt="pencil"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label
                                                    class="mb-1 d-flex align-items-center justify-content-between">
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
                                                                    @if($user->gender == 'male') selected @endif>
                                                                Male
                                                            </option>
                                                            <option value="female"
                                                                    @if($user->gender == 'female') selected @endif>
                                                                Female
                                                            </option>
                                                            <option value="other"
                                                                    @if($user->gender == 'other') selected @endif>
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
                                                            <div
                                                                class="d-flex align-items-center justify-content-between">
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
                                                            <div
                                                                class="d-flex align-items-center justify-content-between">
                                                                <input class="w-100" type="text"
                                                                       placeholder="California">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label
                                                    class="mb-1 d-flex align-items-center justify-content-between">
                                                    <span>Define yourself</span>
                                                </label>
                                                <div class="form-control form-control-lg">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                            <textarea rows="6" class="w-100"
                                                                      placeholder="Type you message"></textarea>
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
                    <div class="tab-pane fade" id="Delete-Account" role="tabpanel"
                         aria-labelledby="Photos-tab">
                        <div class="bg-white p-4 dashboardCard">
                            <div class="row mx-0">
                                <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                                    @csrf
                                    @method('patch')
                                    <div class="col-lg-6 mb-3 mx-auto">
                                        <div class="profileForm bg-white p-3 p-md-3 p-lg-4">
                                            <div class="form-group mb-3">
                                                <label
                                                    class="mb-1 d-flex align-items-center justify-content-between">
                                                    <span>Name</span>
                                                    <span
                                                        class="d-flex align-items-center gap-2">
                                                            <img src="{{ asset('assets/icon11.svg') }}"
                                                                 alt="public email">Public
                                                        </span>
                                                </label>
                                                <div class="form-control form-control-lg">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <input class="w-100" type="text" name="name"
                                                               value="{{ $user->name }}"
                                                               placeholder="Muhammad Usama">
                                                        <a class="text-decoration-none"
                                                           href="javascript:void(0)"><img
                                                                src="{{ asset('assets/pencil.svg') }}" alt="pencil"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label
                                                    class="mb-1 d-flex align-items-center justify-content-between">
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
                                                                    @if($user->gender == 'male') selected @endif>
                                                                Male
                                                            </option>
                                                            <option value="female"
                                                                    @if($user->gender == 'female') selected @endif>
                                                                Female
                                                            </option>
                                                            <option value="other"
                                                                    @if($user->gender == 'other') selected @endif>
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
                                                            <div
                                                                class="d-flex align-items-center justify-content-between">
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
                                                            <div
                                                                class="d-flex align-items-center justify-content-between">
                                                                <input class="w-100" type="text"
                                                                       placeholder="California">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label
                                                    class="mb-1 d-flex align-items-center justify-content-between">
                                                    <span>Define yourself</span>
                                                </label>
                                                <div class="form-control form-control-lg">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                            <textarea rows="6" class="w-100"
                                                                      placeholder="Type you message"></textarea>
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
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            let form = document.getElementById('form-image');
            $("#imageUpload").change(function (data) {
                let imageFile = data.target.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(imageFile);
                reader.onload = function (evt) {
                    let ele = $('#imagePreview');
                    ele.attr('src', evt.target.result);
                    ele.hide();
                    ele.fadeIn(650);
                }
                form.submit();
            });
        });
    </script>

@endsection
