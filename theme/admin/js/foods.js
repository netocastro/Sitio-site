$(function () {

    $('.delete').on('click', function () {
        $('.confirm-delete').data('id', $(this).closest('tr').attr('id'));
    });

    $('.confirm-delete').on('click', function (e) {

        let _this = $(this);
        $.ajax({
            url: _this.data('url'),
            type: 'DELETE', 
            dataType: 'JSON',
            data: 'id=' + $('.confirm-delete').data('id'),
            success: function (data) {
                console.log(data);
                if (data.deletedfood) {
                    $(`#${$('.confirm-delete').data('id')}`).fadeOut().remove();
                }
            },
            error: function (error) {
                console.log(error.responseText);
            }
        });
    });
});
