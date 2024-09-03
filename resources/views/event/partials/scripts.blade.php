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
            sendReport(url, formData)
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
            joinEvent(eventId, false, $(this));
        });

        function joinEvent(eventId, reload = false, button = null) {
            $.ajax({
                url: "{{ route('event.join', ':id') }}".replace(':id', eventId),
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        newNotificationSound();
                        if (button) {
                            button.html(
                                '<span class="px-2 py-1 bg-success text-white rounded">Request sent</span>'
                                );
                            button.attr('disabled', true);
                        }
                    } else {
                        toastr.error(response.message ||
                            'Joining limit Exceed or an error occurred while joining the event');
                        errorNotificationSound();
                    }

                    if (reload) {
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                },
                error: function(xhr) {
                    // Check if the response has a specific error message
                    const errorMessage = xhr.responseJSON?.message || 'Something went wrong';
                    toastr.error(errorMessage);
                    errorNotificationSound();
                }
            });
        }

    });
</script>
