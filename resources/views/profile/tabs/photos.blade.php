<div class="tab-pane fade" id="Photos" role="tabpanel" aria-labelledby="Photos-tab">
    <div class="bg-white p-4 dashboardCard">
        <div class="gallery">
            <div class="d-flex align-items-center justify-content-between pb-4 ">
                <button class="btn btn-primary px-4">Gallery</button>
                <label for="upload_new">
                    <input id="upload_new" type="file" class="px-4 d-none">
                    <div class="btn btn-outline-primary">{{ __('Upload') }}</div>
                </label>
            </div>
            <div class="d-flex align-items-center justify-content-center pt-4 gap-4 flex-wrap">
                @forelse($media as $item)
                    <div class="galleryCard text-center d-flex flex-column mb-3">
                        <img src="{{ $item->file_path }}">
                        {{-- <span class="pt-1">Shine</span> --}}
                    </div>
                @empty
                    <x-no-data-found />
                @endforelse
            </div>

        </div>
    </div>
</div>
