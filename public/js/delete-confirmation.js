// Add this to a new file public/js/delete-confirmation.js
$(document).ready(function() {
    // Generic confirmation for delete actions
    $('.btn-delete').on('click', function(e) {
        e.preventDefault();

        var form = $(this).closest('form');
        var record = $(this).data('record') || 'record';

        // Use SweetAlert if available, otherwise use native confirm
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        } else {
            if (confirm('Are you sure you want to delete this ' + record + '?')) {
                form.submit();
            }
        }
    });

    // AJAX delete support
    $('.btn-ajax-delete').on('click', function(e) {
        e.preventDefault();

        var button = $(this);
        var url = button.data('url');
        var record = button.data('record') || 'record';
        var token = $('meta[name="csrf-token"]').attr('content');

        if (confirm('Are you sure you want to delete this ' + record + '?')) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    "_token": token
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        // Reload or remove row
                        button.closest('tr').fadeOut(500, function() {
                            $(this).remove();
                        });
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                    toastr.error('An error occurred while deleting the record.');
                }
            });
        }
    });
});
