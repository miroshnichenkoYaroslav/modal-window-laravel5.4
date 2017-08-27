$('.districts').change(function () {
    setTimeout(function () {
        $('.district-hidden').removeClass('hidden');
    }, 500);

    var id = $('#region option:selected').data('id');
    $.ajax({
        method: 'GET',
        url: '/subject',
        data: {
            'id': id
        },
        success: function (data) {
            $('.district').empty().append($("<option></option>")
                .attr("data-id", 'allRegions')
                .text('Все'));

            $.each(data.regions, function(id, name) {
                $('.district').append($("<option></option>")
                    .attr("data-id", name.id)
                    .text(name.name));
            });
        },
    });
});

$(document).on('click', '.send', function () {
    var data = $('#filters').serialize();
    console.log(data);
    // $.ajax({
    //     method: 'GET',
    //     url: '/subject',
    //     data: {
    //         'id': id
    //     },
    //     success: function (data) {
    //         $('.regions').empty().append($("<option></option>")
    //             .attr("data-id", 'allRegions')
    //             .text('Все'));
    //
    //         $.each(data.regions, function(id, name) {
    //             $('.regions').append($("<option></option>")
    //                 .attr("data-id", name.id)
    //                 .text(name.name));
    //         });
    //     },
    //     error: function (errors) {
    //     }
    // });
});