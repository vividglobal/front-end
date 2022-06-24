$(document).ready(function() {
    let dataId;
    let currentRow;

    $('.btn-danger').click(async function() {
        let isConfirm = confirm("Do you want to delete this data ?");
        if(isConfirm) {
            currentRow = $(this).parents('tr');
            dataId = currentRow.attr('data-id')
            let response = await $.ajax({
                headers: {
                    'X-CSRF-TOKEN': CSRF,
                },
                url : BASE_URL + '/' + dataId,
                method : 'DELETE',
            });
            if(response.success) {
                currentRow.fadeOut('slow');
                show_success(response.message)
            }
        }
    });
})

async function updateData(url, data) {
    let response = await $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF,
        },
        url : url + '?method=PUT',
        method : 'PUT',
        data : data
    });
    if(response.success) {
        show_success(response.message)
    }
}