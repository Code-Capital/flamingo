<script>
    $(document).ready(function() {
        let body = $('body');
        let reportModal = $('#reportModal');
        let reportForm = $('#reportForm');

        body.on('click', '.event-report', function() {
            let id = $(this).data('event');
            let url = `{{ route('event.report', ':id') }}`.replace(':id', id);
            reportForm.attr('action', url);
            reportModal.modal('show');
        });

        body.on('submit', '#reportForm', function(event) {
            event.preventDefault();
            let formData = new FormData(this);
            let url = $(this).attr('action');

            // Call the reportPost function and handle the result
            reportEvent(url, formData)
                .done(function(response) {
                    if (response.success) {
                        newNotificationSound();
                        toastr.success(response.message);
                        reportModal.modal('hide');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        errorNotificationSound();
                        toastr.error(response.message);
                    }
                })
                .fail(function(xhr) {
                    errorNotificationSound();
                    let errorMessage = xhr.responseJSON.message ||
                        'An error occurred while processing your request.';
                    toastr.error(errorMessage);
                });
        });

        body.on('click', '.join-event', function() {
            let eventId = $(this).data('id');
            joinEvent(eventId);
        });

        function joinEvent(eventId) {
            $.ajax({
                url: "{{ route('event.join', ':id') }}".replace(':id', eventId),
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success == true) {
                        toastr.success(response.message);
                        newNotificationSound();
                    } else {
                        toastr.error(response.message);
                        errorNotificationSound();
                    }

                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                },
                error: function(error) {
                    toastr.error('Something went wrong');
                    errorNotificationSound();
                }
            });
        }
    });
</script>
