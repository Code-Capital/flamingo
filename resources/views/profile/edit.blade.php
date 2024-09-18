@extends('layouts.dashboard')
@section('title', 'Profile')
@section('styles')
    {{-- <style>
        .select2-container .select2-selection--multiple, .select2-container .select2-selection--single {
            width: 100% !important;
            min-height: 44px !important;
            border: 1px solid #ced4da !important;
            border-radius: 8px !important;
            line-height: 25px !important;
            font-size: 16px !important;
        }
    </style> --}}
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3 ">
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

            $(".intersts").select2({
                placeholder: "Select an interest",
                allowClear: false
            });

            $(".locations").select2({
                placeholder: "Select your location",
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
