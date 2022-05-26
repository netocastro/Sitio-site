$(function () {

    $('#date').on('change', function () {

        let date = $('#date').val();

        $.ajax({
            url: $('#form').attr('action'),
            type: $('#form').attr('method'),
            dataType: $('#form').attr('data-type'),
            data: 'date=' + date,
            beforeSend: function () {

            },
            success: (data) => {
                console.log(data);
                $('tbody').html('');
                dailyFoods(data);
            },
            error: (error) => {
                console.log(error.responseText);
            }
        }).always(function () {

        });

    });

    $('.delete').on('click', function () {
        console.log($('.confirm-delete').data('id'));
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
                console.log($('.confirm-delete').data('id'));
                if (data.deletedDailyFood) {
                    $(`#${$('.confirm-delete').data('id')}`).fadeOut().remove();
                }
            },
            error: function (error) {
                console.log(error.responseText);
            }
        });
    });
});

function dailyFoods(data) {
    $('tbody').hide();
    data.forEach(element => {

        $('tbody').append(`
            <tr id="${element.pig_id}">
                <td class="fw-bold">${element.pig_id}</td>
                <td>${element.foodName}</td>
                <td>${element.amount}</td>
                
                <td><a href="#"><i class="fas fa-edit"></i></a></td>
                <td><button data-bs-target="#delete" data-bs-toggle="modal" class="btn delete"><i class="fas fa-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Apagar mensagem"></i></button></td>
            </tr>
        `).fadeIn();
    });

}