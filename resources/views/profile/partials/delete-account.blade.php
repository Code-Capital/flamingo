<!-- Button trigger modal -->
<!-- Tab Pane for Delete Account -->
<div class="tab-pane fade" id="Delete-Account" role="tabpanel" aria-labelledby="Photos-tab">
    <div class="bg-white p-4 dashboardCard rounded shadow-sm">
        <div class="row mx-0">
            <div class="col-12">
                <h2 class="text-lg font-semibold text-gray-900 mb-3">
                    {{ __('Delete account') }}
                </h2>

                <p class="text-sm text-gray-600 mb-4">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                </p>

                <!-- Trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#deleteAccountModal">
                    {{ __('Delete account') }}
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form id="deleteAccountForm" action="{{ route('profile.destroy') }}" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountModalLabel">{{ __('Confirm Account Deletion') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Please enter your password to confirm account deletion.') }}</p>
                    @csrf
                    @method('DELETE')
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" name="password" type="password" required class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('Delete Account') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
