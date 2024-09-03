<script>
    let reportModal = $('#reportModal');
    let reportForm = $('#reportForm');

    body.on('click', '.page-report', function() {
        let id = $(this).data('page');
        let url = `{{ route('page.report', ':id') }}`.replace(':id', id);
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


    body.on('click', '.leave-page', function(event) {
        event.preventDefault();
        let id = $(this).data('page');
        let url = `{{ route('page.leave', ':id') }}`.replace(':id', id);

        // Call the leavePage function with named parameters
        leavePage({
            url: url,
            method: 'DELETE'
        }).done(function(response) {
            if (response.success) {
                newNotificationSound();
                toastr.success(response.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                errorNotificationSound();
                toastr.error(response.message || 'An error occurred while processing your request.');
            }
        }).fail(function(xhr) {
            errorNotificationSound();
            let errorMessage = xhr.responseJSON?.message ||
                'An error occurred while processing your request.';
            toastr.error(errorMessage);
        });
    });

    function leavePage({
        url,
        formData = null,
        method = 'POST'
    }) {
        return $.ajax({
            url: url,
            type: method,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token in headers
            },
            data: formData,
            processData: false,
            contentType: false,
        });
    }
</script>
