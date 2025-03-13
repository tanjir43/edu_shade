function openFullImage() {
    var imgSrc = document.getElementById("profilePreview").src;
    document.getElementById("fullImage").src = imgSrc;
    document.getElementById("fullImageModal").style.display = "flex";
}

function closeFullImage() {
    document.getElementById("fullImageModal").style.display = "none";
}

function previewProfileImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById("profilePreview");
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

$(document).ready(function() {
    // Initialize select2 if available
    if($.fn.select2) {
        $('.select2').select2({
            theme: 'bootstrap4',
            width: '100%'
        });
    }

    // Handle delete confirmation
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        const id = $(this).data('id');

        if(confirm('Are you sure you want to delete this class?')) {
            $(`#delete-form-${id}`).submit();
        }
    });

    // Handle status toggle
    $(document).on('click', '.toggle-status', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        const status = $(this).data('status');
        const newStatus = status === 1 ? 0 : 1;

        $.ajax({
            url: `/admin/sclClasses/${id}`,
            type: 'PATCH',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                active_status: newStatus
            },
            success: function(response) {
                if(response.success) {
                    // Reload datatable
                    $('#dataTableBuilder').DataTable().ajax.reload(null, false);
                    toastr.success('Status updated successfully');
                } else {
                    toastr.error('Error updating status');
                }
            },
            error: function() {
                toastr.error('An error occurred');
            }
        });
    });
});
