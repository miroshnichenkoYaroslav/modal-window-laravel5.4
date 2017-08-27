@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Действия</div>
                    <div class="panel-body">
                        <a class="btn btn-primary" href="{{ route('loader/load') }}" role="button">Загрузить</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Список загруженых файлов результатов диагностики</div>
                    <div class="panel-body">

                        <table id="example" class="display" cellspacing="0">
                            <thead>
                            <tr>
                                <th>№ п/п</th>
                                <th>ID</th>
                                <th>Диагностика</th>
                                <th>Предмет</th>
                                <th>Год</th>
                                <th>Файл</th>
                                <th>Пользователь</th>
                                <th>Дата загрузки</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                                <th>6</th>
                                <th>7</th>
                                <th>8</th>
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
                        <input id="deleteFileID" type="hidden" name="file_id" value="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button form="deleteFileForm" id="deleteConfirmationSubmit" type="submit" class="btn btn-danger"><span id="" class='glyphicon glyphicon-trash'></span>Удалить!</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><span class='glyphicon glyphicon-remove'></span>Отмена</button>
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
            width: 100px;
        }
    </style>
@endpush

@push('scripts')
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#example'),
                thFoot = $('tfoot th', table);

            thFoot.each(function () {
                var title = $(this).text();
                if (title === '1' || title === '8') {
                    $(this).html('');
                } else if (title === '7') {
                    $(this).html('<input type="date" style="width: 120px"/>');
                } else {
                    $(this).html('<input type="text" />');
                }
            });

            table = table.DataTable({
                sDom: '<"top">lt<"bottom"ip<"clear">>',
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
                ajax: '/loader/files-list',
                columns: [
                    {data: 'DT_Row_Index', name:'index', searchable: false, orderable: false},
                    {data: 'id', name:'id', visible: false},
                    {data: 'diagnostic_type_name', name: 'diagnostic_types.name'},
                    {data: 'diagnostic_subject_name', name: 'diagnostic_subjects.name'},
                    {data: 'year', name: 'diagnostic_files.year'},
                    {
                        data: 'file_name',
                        name: 'diagnostic_files.file_name',
                        render: function (data, type, row) {
                            return '<a href="/loader/view/'+ row.id +'">' + data + '</a>'
                        }
                    },
//                    {data: 'user_id', name: 'diagnostic_files.user_id'},
                    {data: 'user_fio', name: 'user_fio'},
                    {data: 'created_at', name: 'diagnostic_files.created_at', searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false, "className": 'action-control'}
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


            {{--Обработка кнопки удаления файла--}}
            $('#example tbody').on('click', 'button.deleteBtn', function () {
                var fileID = table.row( $(this).closest('tr') ).data().id;
                    $('#deleteFileID').val(fileID);
            });

            {{--Обработка кнопки редактирования файла--}}
            $('#example tbody').on('click', 'button.editBtn', function () {
                var rowData = table.row( $(this).closest('tr') ).data();
                window.location.href = '{{ route('loader/editFileForm', ['id'=>'']) }}/' + rowData.id
            });

        } );
    </script>
@endpush
