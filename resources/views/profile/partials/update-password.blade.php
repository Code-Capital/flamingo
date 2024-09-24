<div class="tab-pane fade " id="Update-Password" role="tabpanel" aria-labelledby="Info-tab">
    <div class="bg-white p-4 dashboardCard">
        <div class="row mx-0">
            <form method="post" action="{{ route('profile.password.update') }}" class="mt-6 space-y-6">
                @csrf
                <div class="col-lg-6 mb-3 mx-auto">
                    <div class="profileForm bg-white p-3 p-md-3 p-lg-4">
                        <div class="form-group mb-3">
                            <label class="mb-1">
                                <span> Current password </span>
                            </label>
                            <div class="form-control form-control-lg">
                                <input class="w-100" type="password" name="current_password" value=""
                                    placeholder="Enter current password">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1">
                                <span>New Password</span>
                            </label>
                            <div class="form-control form-control-lg">
                                <input class="w-100" type="password" name="password" value=""
                                    placeholder="Enter new Password">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-1">
                                <span>Password Confirmation</span>
                            </label>
                            <div class="form-control form-control-lg">
                                <input class="w-100" type="password" name="password_confirmation" value=""
                                    placeholder="Confirm password">
                            </div>
                        </div>

                        <button class="btn btn-primary w-100 mt-3">
                            Update password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
