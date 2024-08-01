@extends('layouts.dashboard')
@section('title', 'Gallery')
@section('styles')
    <style>
        .galleryCard {
            height: auto;
            /* Ensures card height adjusts to content */
        }
    </style>
@endsection
@section('content')
    <div class="px-0 px-md-2 px-lg-3 ">
        <div class="row mx-0 pt-5">
            <div class="col-lg-12 mb-3">
                <div class="bg-white p-4 dashboardCard">
                    <div class="gallery">
                        <div class="d-flex align-items-center justify-content-between pb-4">
                            <button class="btn btn-primary px-4">Gallery</button>
                            <label for="upload">
                                <input id="upload" type="file" class="px-4 d-none">
                                <div class="btn btn-outline-primary" id="uploadButton">Upload</div>
                            </label>
                        </div>

                        <div class="d-flex align-items-center justify-content-center pt-4 gap-4 flex-wrap bg-light" style="height: auto ;">
                            @forelse($media as $item)
                                <div class="galleryCard text-center d-flex flex-column mb-3">
                                    @if (in_array(pathinfo($item->file_path, PATHINFO_EXTENSION), ['png', 'jpg', 'jpeg', 'svg']))
                                        <img src="{{ $item->file_path }}" alt="{{ $item->name ?? 'gallery image' }}"
                                            class="img-fluid">
                                    @else
                                        <!-- Optional: Use a placeholder image for unsupported file types -->
                                        <img src="/path/to/default/image.png" alt="default image" class="img-fluid">
                                    @endif
                                    <span class="pt-1">{{ $item->name ?? 'Unnamed Media' }}</span>
                                </div>
                            @empty
                                <x-no-data-found />
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // Handle file selection
            $('#upload').on('change', function() {
                var fileInput = $('#upload')[0];

                if (fileInput.files.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please select files to upload!'
                    });
                    return;
                }

                var formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                for (let i = 0; i < fileInput.files.length; i++) {
                    formData.append('media[]', fileInput.files[i]);
                }

                Swal.fire({
                    title: 'Uploading...',
                    html: '<progress id="progressBar" value="0" max="100" style="width: 100%;"></progress>',
                    showCancelButton: false,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: "{{ route('media.upload') }}", // Replace with your server-side upload URL
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(event) {
                            if (event.lengthComputable) {
                                var percentComplete = event.loaded / event.total;
                                percentComplete = parseInt(percentComplete * 100);
                                $('#progressBar').attr('value', percentComplete);
                            }
                        }, false);
                        return xhr;
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success == true) {
                            Swal.close();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Files uploaded successfully!'
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            Swal.close();
                            Swal.fire({
                                icon: 'error',
                                title: 'Upload Failed',
                                text: 'An error occurred while uploading the files.'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Upload Failed',
                            text: 'An error occurred while uploading the files.'
                        });
                    }
                });

            });
        });
    </script>
@endsection
