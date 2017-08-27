@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Список строк файла имеющие ошибки</div>

                    <div class="panel-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#acceptConfirmation" title="Удалить"><span class="glyphicon glyphicon-check"></span>Принять файл с ошибками</button>
                        <button class="btn btn-primary btn-danger" data-toggle="modal" data-target="#deleteConfirmation" title="Удалить"><span class="glyphicon glyphicon-trash"></span>Отменить (удалить загруженный файл)</button>
                    </div>

                    <div class="panel-body">

                        <table id="example" class="display" cellspacing="0">
                            <thead>
                                <tr>
                                    {{--1--}} <th>+</th>
                                    {{--2--}} <th>№ п/п</th>
                                    {{--3--}} <th>ID</th>
                                    {{--4--}} <th>Фамилия</th>
                                    {{--5--}} <th>Имя</th>
                                    {{--6--}} <th>Отчество</th>
                                    {{--7--}} <th>Год</th>
                                    {{--8--}} <th>Субъект</th>
                                    {{--9--}} <th>Муниципалитет</th>
                                    {{--10--}} <th>Школа</th>
                                    {{--11--}}<th>Класс</th>
                                    {{--12--}}<th>Дата экзамена</th>
                                    {{--13--}}<th>Всего баллов</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    {{--1--}} <th>1</th>
                                    {{--2--}} <th>1</th>
                                    {{--3--}} <th>ID</th>
                                    {{--4--}} <th>Фамилия</th>
                                    {{--5--}} <th>Имя</th>
                                    {{--6--}} <th>Отчество</th>
                                    {{--7--}} <th>Год</th>
                                    {{--8--}} <th>Субъект</th>
                                    {{--9--}} <th>Муниципалитет</th>
                                    {{--10--}}<th>Школа</th>
                                    {{--11--}}<th>Класс</th>
                                    {{--12--}}<th>1</th>
                                    {{--13--}}<th>Всего баллов</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ++Подтверждение удаления файла --}}
    <div class="modal fade" id="deleteConfirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Подтверждение удаления файла!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Файл и все связанные с ним данные будут удалены!</strong><br>
                    <strong style="color: red">Вы подтверждаете удаление файла?</strong>
                    <form name="deleteFileForm" id="deleteFileForm" action="{{ route('loader/deleteFile') }}" method="post">
                        {{ csrf_field() }}
                        <input id="deleteFileID" type="hidden" name="file_id" value="{{ $fileID }}">
                    </form>
                </div>
                <div class="modal-footer">
                    <button form="deleteFileForm" id="deleteConfirmationSubmit" type="submit" class="btn btn-primary">Удалить!</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                </div>
            </div>
        </div>
    </div>
    {{-- ==Подтверждение удаления файла --}}

    {{-- ++Подтверждение принятия файла с ошибками --}}
    <div class="modal fade" id="acceptConfirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Подтверждение принятия файла с ошибками!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Файл будет внесен в базу данных со всеми показанными ошибками!</strong><br>
                    <strong style="color: red">Вы подтверждаете принятие файла?</strong>
                    <form name="acceptFileForm" id="acceptFileForm" action="{{ route('loader/acceptFile') }}" method="post">
                        {{ csrf_field() }}
                        <input id="acceptFileID" type="hidden" name="id" value="{{ $fileID }}">
                    </form>
                </div>
                <div class="modal-footer">
                    <button form="acceptFileForm" id="acceptConfirmationSubmit" type="submit" class="btn btn-primary">Принять!</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                </div>
            </div>
        </div>
    </div>
    {{-- ==Подтверждение удаления файла --}}
@endsection

@push('styles')
<link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
<style>
    table.dataTable tfoot th {
        padding: 10px 5px 6px 5px;
    }
    table.dataTable tfoot th input{
        width: 50px;
    }
    .errors-details {
        padding: 10px;
    }
    .errors-details,
    .errors-details * {
        background-color: #2ab27b !important;
    }
    td.details-control {
        background: url('../../../images/details_open.png') no-repeat center center;
        cursor: pointer;
        width: 18px;
    }
    tr.shown td.details-control {
        background: url('../../../images/details_close.png') no-repeat center center;
    }
</style>
@endpush

@push('scripts')
<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.10/handlebars.min.js"></script>

<script id="details-template" type="text/x-handlebars-template">
    <div class="errors-details">
        <h3>Ошибки, возникшие при обработке:</h3>
        <ul>
            @{{#each errors }}
            <li>
                @{{this}}
            </li>
            @{{/each}}
        </ul>
        @{{#if duplicates}}
        <table class="table details-table" id="duplicates-@{{id}}">
            <thead>
            <tr>
                {{--2--}} <th>№ п/п</th>
                {{--3--}} <th>ID</th>
                {{--4--}} <th>Фамилия</th>
                {{--5--}} <th>Имя</th>
                {{--6--}} <th>Отчество</th>
                {{--7--}} <th>Год</th>
                {{--8--}} <th>Субъект</th>
                {{--9--}} <th>Муниципалитет</th>
                {{--10--}} <th>Школа</th>
                {{--11--}}<th>Класс</th>
                {{--12--}}<th>Дата экзамена</th>
                {{--13--}}<th>Действия</th>
            </tr>
            </thead>
        </table>
        @{{/if}}
    </div>
</script>

<script>
    var template = Handlebars.compile($("#details-template").html());

    $(document).ready(function() {
        var table = $('#example'),
            thFoot = $('tfoot th', table);

        thFoot.each(function () {
            var title = $(this).text();
            if (title === '1' || title === '12') {
                $(this).html('');
            } else if (title === '12') {
                $(this).html('<input type="date" style="width: 120px"/>');
            } else {
                $(this).html('<input type="text" />');
            }
        });

        table = table.DataTable({
            sDom: '<"top">lt<"bottom"ip<"clear">>',
            "scrollX": true,
            "language": {
                "processing": "Подождите...",
                "search": "Поиск:",
                "lengthMenu": "Показать _MENU_ записей",
                "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                "infoEmpty": "Записи с 0 до 0 из 0 записей",
                "infoFiltered": "(отфильтровано из _MAX_ записей)",
                "infoPostFix": "",
                "loadingRecords": "Загрузка записей...",
                "zeroRecords": "Записи отсутствуют.",
                "emptyTable": "В таблице отсутствуют данные",
                "paginate": {
                    "first": "Первая",
                    "previous": "Предыдущая",
                    "next": "Следующая",
                    "last": "Последняя"
                },
                "aria": {
                    "sortAscending": ": активировать для сортировки столбца по возрастанию",
                    "sortDescending": ": активировать для сортировки столбца по убыванию"
                }
            },
            serverSide: true,
            processing: true,
            ajax: {
                url: '{{ route('loader/processingResultData') }}',
                method: 'POST',
                data: {
                    id: '{{ $fileID }}',
                    _token: '{{ csrf_token() }}'
                }
            },
            columns: [
                {
                    "className": 'details-control',
                    "orderable": false,
                    "searchable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {data: 'DT_Row_Index', name:'index', searchable: false, orderable: false},
                {data: 'id', name:'id', visible: true},
                {data: 'first_name', name:'first_name'},
                {data: 'last_name', name:'last_name'},
                {data: 'middle_name', name:'middle_name'},
                {data: 'diagnostic_file.year', name:'diagnosticFile.year'},
                {data: 'region.name', name:'region.name'},
                {data: 'municipality.name', name:'municipality.name'},
                {data: 'school.name', name:'school.name'},
                {data: 'class', name:'class'},
                {data: 'diagnostic_file.exam_date', name:'diagnosticFile.exam_date', searchable: false},
                {data: 'total_result', name:'total_result'}
            ]
        });

        // Apply the search
        table.columns().every( function () {
            var that = this;
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
        // Add event listener for opening and closing details
        $('#example tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr'),
                row = table.row( tr ),
                tableId = 'duplicates-' + row.data().id;

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( template(row.data())).show();
                if (row.data().duplicates !== '') {
                    initTable(tableId, row.data());
                }
                tr.addClass('shown');
                tr.next().find('td').addClass('no-padding bg-gray');
            }
        });

        function initTable(tableId, data) {
            $('#' + tableId).DataTable({
//                sDom: '<"top">lt<"bottom"ip<"clear">>',
                searching: false,
                ordering: false,
//                "scrollX": true,
                "language": {
                    "processing": "Подождите...",
                    "search": "Поиск:",
                    "lengthMenu": "Показать _MENU_ записей",
                    "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                    "infoEmpty": "Записи с 0 до 0 из 0 записей",
                    "infoFiltered": "(отфильтровано из _MAX_ записей)",
                    "infoPostFix": "",
                    "loadingRecords": "Загрузка записей...",
                    "zeroRecords": "Записи отсутствуют.",
                    "emptyTable": "В таблице отсутствуют данные",
                    "paginate": {
                        "first": "Первая",
                        "previous": "Предыдущая",
                        "next": "Следующая",
                        "last": "Последняя"
                    },
                    "aria": {
                        "sortAscending": ": активировать для сортировки столбца по возрастанию",
                        "sortDescending": ": активировать для сортировки столбца по убыванию"
                    }
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('loader/processingResultDuplicatesData') }}',
                    method: 'POST',
                    data: {
                        file_id: data.diagnostic_file_id,
                        row_id: data.id,
                        _token: '{{ csrf_token() }}'
                    }
                },
                columns: [
                    {data: 'DT_Row_Index', name:'index', searchable: false, orderable: false},
                    {data: 'id', name:'id', visible: true},
                    {data: 'first_name', name:'first_name'},
                    {data: 'last_name', name:'last_name'},
                    {data: 'middle_name', name:'middle_name'},
                    {data: 'diagnostic_file.year', name:'diagnosticFile.year'},
                    {data: 'region.name', name:'region.name'},
                    {data: 'municipality.name', name:'municipality.name'},
                    {data: 'school.name', name:'school.name'},
                    {data: 'class', name:'class'},
                    {data: 'diagnostic_file.exam_date', name:'diagnosticFile.exam_date', searchable: false},
                    {data: 'action', name:'action'}
                ]
            })
        }
    } );
</script>

@endpush
