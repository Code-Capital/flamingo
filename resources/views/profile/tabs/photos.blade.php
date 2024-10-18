<div class="tab-pane fade" id="Photos" role="tabpanel" aria-labelledby="Photos-tab">
    <div class="bg-white p-4 dashboardCard">
        <div class="gallery">
            <div class="d-flex align-items-center justify-content-between pb-4 ">
                <button class="btn btn-primary px-4">{{ __('Gallery') }}</button>
                <label for="upload_new">
                    <input id="upload_new" type="file" class="px-4 d-none">
                    <div class="btn btn-outline-primary">{{ __('Upload') }}</div>
                </label>
            </div>
            <div class="d-flex align-items-center pt-4 gap-4 flex-wrap">
                @forelse($media as $item)
                    <div class="galleryCard position-relative text-center d-flex flex-column">
                        <a class="w-100 h-100 js-gallery" data-gallery="gallery2" href="{{ $item->file_path }}">
                            <img class="w-100 h-100 object-cover" src="{{ $item->file_path }}">
                        </a>
                        <a class="btn btn-danger position-absolute top-0 end-0 me-2 mt-2 p-0 delete_btn rounded-circle" data-id="{{$item->id}}" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                            </svg>
                        </a>
                        {{-- <span class="pt-1">Shine</span> --}}
                    </div>
                @empty
                    <x-no-data-found />
                @endforelse
            </div>
        </div>
    </div>
</div>
