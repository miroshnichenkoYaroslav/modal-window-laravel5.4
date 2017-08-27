// add a new post
$(document).on('click', '.add-modal', function () {
    $('#addModal').modal('show');
});
$(document).on('click', '.add', function () {
    $.ajax({
        type: 'POST',
        url: 'admin',
        data: {
            '_token': $('input[name=_token]').val(),
            'fio': $('#fio-add').val(),
            'login': $('#login-add').val(),
            'email': $('#email-add').val(),
            'role': $('#role-add').val(),
            'password': $('#password-add').val(),
            'password_confirmation': $('#password-confirm-add').val()
        },
        success: function (data) {
            console.log(data.html);
            toastr.success('Пользователь успешно сохранен.', 'Уведомление об успехе!', {timeOut: 5000});
            $('.index').each(function (index) {
                $(this).html(index + 1);
            });
            //$('').append(data.html);

        },
        error: function (data) {
            setTimeout(function () {
                $('#addModal').modal('show');
                toastr.error('Возникла ошибка при проверке.', 'Уведомление об ошибке!', {timeOut: 5000});
            }, 500);

            $('.errorAdd').html('').addClass('hidden');
            if (errors.fio) {
                $('.errorFio').removeClass('hidden');
                $('.errorFio').text(errors.fio);
            }
            if (errors.login) {
                $('.errorLogin').removeClass('hidden');
                $('.errorLogin').text(errors.login);
            }
            if (errors.email) {
                $('.errorEmail').removeClass('hidden');
                $('.errorEmail').text(errors.email);
            }
            if (errors.password) {
                $('.errorPassword').removeClass('hidden');
                $('.errorPassword').text(errors.password);
            }
            if (errors.password_confirmation) {
                $('.errorPasswordConfirm').removeClass('hidden');
                $('.errorPasswordConfirm').text(errors.password_confirmation);
            }

        }
    });
});


// Edit a post
$(document).on('click', '.edit-modal', function () {
    $('#id-edit').val($(this).data('id'));
    $('#fio-edit').val($(this).data('fio'));
    $('#login-edit').val($(this).data('login'));
    $('#email-edit').val($(this).data('email'));
    $('#role-edit').val($(this).data('role'));
    id = $('#id-edit').val();

    $('#editModal').modal('show');
});

$(document).on('click', '.edit', function () {
    $.ajax({
        type: 'PUT',
        url: 'admin/' + id,
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $("#id_edit").val(),
            'fio': $('#fio-edit').val(),
            'login': $('#login-edit').val(),
            'email': $('#email-edit').val(),
            'role': $('#role-edit').val()
        },

        success: function (data) {
            $('.errorEdit').html('').addClass('hidden');
            $('.errorFio').addClass('hidden');
            $('.errorLogin').addClass('hidden');
            $('.errorEmail').addClass('hidden');

            toastr.success('Данные пользователя обновлены.', 'Уведомление о успехе!', {timeOut: 5000});
            $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='text-center col1 col-md-1'>" + data.id + "</td><td class='text-center col-md-3'>" + data.fio + "</td><td class='text-center col-md-2'>" + data.login + "</td><td class='text-center col-md-3'>" + data.email + "</td><td class='text-center col-md-2'>" + data.role + "</td><td class='text-center col-md-1'><button class='btn-sm btn btn-primary edit-modal' data-id='" + data.id + "' data-fio='" + data.fio + "' data-login='" + data.login + "' data-email='" + data.email + "' data-role='" + data.role + "'><span class='glyphicon glyphicon-edit'></span></button> <button class='btn-sm btn btn-danger delete-modal' data-id='" + data.id + "' data-fio='" + data.fio + "' data-login='" + data.login + "' data-email='" + data.email + "' data-role='" + data.role + "'><span class='glyphicon glyphicon-trash'></span></button></td></tr>");
            $('.col1').each(function (index) {
                $(this).html(index + 1);
            });
        },

        error: function (data) {
            var errors = data.responseJSON.errors;

            setTimeout(function () {
                $('#editModal').modal('show');
                toastr.error('Возникла ошибка при проверке.', 'Уведомление об ошибке!', {timeOut: 5000});
            }, 500);

            if (errors.fio) {
                $('.errorFio').removeClass('hidden');
                $('.errorFio').text(errors.fio);
            }

            if (errors.login) {
                $('.errorLogin').removeClass('hidden');
                $('.errorLogin').text(errors.login);
            }

            if (errors.email) {
                $('.errorEmail').removeClass('hidden');
                $('.errorEmail').text(errors.email);
            }
        }
    });
});

// delete a post
$(document).on('click', '.delete-modal', function () {
    $('#deleteModal').modal('show');
    id = $(this).data('id')
});
$(document).on('click', '.delete', function () {
    $.ajax({
        type: 'DELETE',
        url: 'admin/' + id,
        data: {
            '_token': $('input[name=_token]').val(),
        },
        success: function () {
            toastr.success('Пользователь успешно удален!', 'Уведомление о успехе!', {timeOut: 5000});
            $('.item' + id).remove();
        }
    });
});

$(document).on('click', '.reload', function () {
    window.location.reload();
});
