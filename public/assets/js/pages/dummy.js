$(document).ready(function() {
    let dataId;
    let currentRow;

    $('.btn-danger').click(async function() {
        let isConfirm = confirm("Do you want to delete this data ?");
        if(isConfirm) {
            currentRow = $(this).parents('tr');
            dataId = currentRow.attr('data-id')
            return await $.ajax({
                url : BASE_URL + '/' + dataId,
                method : 'DELETE',
            });
        }
    })
})