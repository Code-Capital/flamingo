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
                            <button class="nav-link active" id="Profile-tab" data-bs-toggle="tab" data-bs-target="#Profile"
                                type="button" role="tab" aria-controls="Profile" aria-selected="false"><span
                                    class="px-1 px-md-2 px-lg-3">Profile</span>
                            </button>
                            <button class="nav-link " id="Info-tab" data-bs-toggle="tab" data-bs-target="#Update-Password"
                                type="button" role="tab" aria-controls="Info" aria-selected="true"><span
                                    class="px-1 px-md-2 px-lg-3">Update password</span>
                            </button>
                            <button class="nav-link" id="suggestions-tab" data-bs-toggle="tab"
                                data-bs-target="#Delete-Account" type="button" role="tab" aria-controls="Photos"
                                aria-selected="false"><span class="px-1 px-md-2 px-lg-3">Delete Account</span>
                            </button>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="tab-content p-0 border-0" id="nav-tabContent">

                    @include('profile.partials.profile')

                    @include('profile.partials.update-password')

                    @include('profile.partials.delete-account')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
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

@endsection
