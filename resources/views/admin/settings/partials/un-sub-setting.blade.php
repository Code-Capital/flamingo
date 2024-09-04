<div class="tab-pane fade account-settings-tab" id="un-sub-settings" role="tabpanel" aria-labelledby="un-sub-settings-tab">
    <form action="{{ route('settings.update.un.sub') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label class="mb-1 required">
                        <span>Event Creation Count</span>
                    </label>
                    <div class="form-control form-control-lg">
                        <div class="d-flex align-items-center justify-content-between">
                            <input class="w-100" name="un_sub_event_create_count" type="text"
                                value="{{ old('un_sub_event_create_count', $setting->un_sub_event_create_count ?? 0) }}"
                                required placeholder="10">
                        </div>
                    </div>
                    @error('un_sub_event_create_count')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label class="mb-1 required">
                        <span>Event Joining Count</span>
                    </label>
                    <div class="form-control form-control-lg">
                        <div class="d-flex align-items-center justify-content-between">
                            <input class="w-100" name="un_sub_event_join_count" type="text"
                                value="{{ old('un_sub_event_join_count', $setting->un_sub_event_join_count ?? 0) }}"
                                required placeholder="10">
                        </div>
                    </div>
                    @error('un_sub_event_join_count')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label class="mb-1 required">
                        <span>Page Creation Count</span>
                    </label>
                    <div class="form-control form-control-lg">
                        <div class="d-flex align-items-center justify-content-between">
                            <input class="w-100" name="un_sub_page_create_count" type="text"
                                value="{{ old('un_sub_page_create_count', $setting->un_sub_page_create_count ?? 0) }}"
                                required placeholder="10">
                        </div>
                    </div>
                    @error('un_sub_page_create_count')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label class="mb-1 required">
                        <span>Page Joining Count</span>
                    </label>
                    <div class="form-control form-control-lg">
                        <div class="d-flex align-items-center justify-content-between">
                            <input class="w-100" name="un_sub_page_join_count" type="text"
                                value="{{ old('un_sub_page_join_count', $setting->un_sub_page_join_count ?? 0) }}"
                                required placeholder="10">
                        </div>
                    </div>
                    @error('un_sub_page_join_count')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100 mt-3">
            Update
        </button>
    </form>
</div>
