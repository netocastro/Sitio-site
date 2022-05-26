/*
 *Evento que muda status da barra de navegação através do scroll
 */
window.addEventListener('scroll', function () {
    if (window.scrollY > 0 && !$('#header').hasClass("bg-dark")) {
        $('#header').removeClass('bg-transparent');
        $('#header').addClass('menuFixo');
        return false;

    } // > 0 ou outro valor desejado
    if (window.scrollY == 0 && !$('#header').hasClass("bg-transparent")) {

        $('#header').removeClass('menuFixo');
        $('#header').addClass('bg-transparent');
        return false;
    }
});

function validateFields(data, dadosForm) {

    $(dadosForm.find('input, select, textarea')).each(function (index) {
        $(`${$(this).prop('tagName')}[name=${$(this).attr('name')}]`).removeClass('is-invalid');
        $(`#error-${$(this).attr('name')}`).fadeOut().remove();
    });
    $('#success').fadeOut().remove();

    if (data.emptyFields) {
        data.emptyFields.forEach(element => {
            $(`[name=${element}]`).addClass('is-invalid');
            $(`[name=${element}]`).after(`<div id='error-${element}' class='text-danger'>Campo obrigatório</div>`);
            $(`#error-${element}`).hide().fadeIn();
        });
    }

    if (data.validateFields) {
        let fields = data.validateFields;
        for (const field in fields) {
            $(`[name=${field}]`).addClass('is-invalid');
            $(`[name=${field}]`).after(`<div id='error-${field}' class='text-danger'>${fields[field]}</div>`)
        }
    }

    if (data.success) {
        $('button[type=submit]').after(`<h6 id="success" class="bg-success text-light p-2 mt-3 rounded text-center">${data.success}</h6>`).hide().fadeIn();
        $('.form-control').val('');
    }
}
