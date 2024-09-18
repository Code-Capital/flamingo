<div class="tab-pane fade" id="Gallery" role="tabpanel" aria-labelledby="Gallery-tab">
    <div class="bg-white p-4 dashboardCard">
        <div class="gallery">
            <h5 class="gallery-heading pb-4 mb-0">Gallery</h5>
            <div class="d-flex align-items-center justify-content-center pt-4 gap-4 flex-wrap bg-light">
                @forelse ($media as $post)
                    <div class="galleryCard text-center d-flex flex-column mb-3">
                        <img src="{{ $post->file_path }}">
                        {{-- <span class="pt-1">{{ $post->filepa }}</span> --}}
                    </div>
                @empty
                    <x-no-data-found />
                @endforelse
            </div>
        </div>
    </div>
</div>
