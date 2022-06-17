$(function () {

    let status;
    let currentElement;

    $('.serrated-teeth').on('change', function () {
        status = $(this).prop('checked');
        currentElement = $(this);
        $('.confirm-change-serrated-teeth').data('id', $(this).closest('tr').attr('id'));
    });

    $('.cancel-serrated-teeth').on('click', function () {
        if (status) {
            currentElement.prop('checked', false);
        } else {
            currentElement.prop('checked', true);
        }
    });

    $('.confirm-change-serrated-teeth').on('click', function () {
        let _this = $(this);
        $.ajax({
            url: _this.data('url'),
            type: 'PUT',
            dataType: 'JSON',
            data: 'id=' + $('.confirm-change-serrated-teeth').data('id'),
            success: function (data) {
                console.log(data);
                if (data.pigStatus == 1) {
                    currentElement.prop('checked', true);
                    console.log('true');
                } else {
                    currentElement.prop('checked', false);
                    console.log('false');
                }

            },
            error: function (error) {
                console.log(error.responseText);
                //falta resolver como voltar o checkbox para o estado anterior
            }
        });
    });

    $('.vaccination').on('change', function () {
        status = $(this).prop('checked');
        currentElement = $(this);
        $('.confirm-change-vaccination').data('id', $(this).closest('tr').attr('id'));
    });

    $('.cancel-vaccination').on('click', function () {
        if (status) {
            currentElement.prop('checked', false);
        } else {
            currentElement.prop('checked', true);
        }
    });

    $('.confirm-change-vaccination').on('click', function () {
        let _this = $(this);
        $.ajax({
            url: _this.data('url'),
            type: 'PUT',
            dataType: 'JSON',
            data: 'id=' + $('.confirm-change-vaccination').data('id'),
            success: function (data) {
                console.log(data);
                if (data.pigStatus == 1) {
                    currentElement.prop('checked', true);
                    console.log('true');
                } else {
                    currentElement.prop('checked', false);
                    console.log('false');
                }
            },
            error: function (error) {
                console.log(error.responseText);
                //falta resolver como voltar o checkbox para o estado anterior
            }
        });
    });

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
                if (data.deletedpig) {
                    $(`#${$('.confirm-delete').data('id')}`).fadeOut().remove();
                }
            },
            error: function (error) {
                console.log(error.responseText);
            }
        });
    });
});