
// Created new input Bootstrap-4
function addNewInput(className, buttonName) {

    $('#'+ buttonName).click(function (e) {
        e.preventDefault();

        var html = '<div class="form-group form-inline">' +
                        '<input type="text" name="'+ className +'[]" value="" placeholder="new variant" class="form-control col-10">' +
                        '<button type="button" class="btn btn-danger btn_delete_input"><i class="fa fa-minus-circle"></i></button>' +
                   '</div>';


        $('#'+ className).append(html);
    });

}

function deleteInput() {

    $('html').on('click', '.btn_delete_input', function (e) {
        e.preventDefault();

        $(this).parent('.form-group .form-inline').remove();
    });

}

// Start function
addNewInput('variants_attr', 'btn_variants_attr');

// Start function
deleteInput();