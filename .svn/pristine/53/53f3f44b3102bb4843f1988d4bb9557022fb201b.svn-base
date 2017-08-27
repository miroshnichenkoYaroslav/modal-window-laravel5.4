@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Список загруженых файлов результатов диагностики</div>
                    <div class="panel-body">

                        <table id="example" class="display" cellspacing="0">
                            <thead>
                                <tr>
                                    {{--1--}} <th rowspan="2">№ п/п</th>
                                    {{--2--}} <th rowspan="2">ID</th>
                                    {{--3--}} <th rowspan="2">Фамилия</th>
                                    {{--4--}} <th rowspan="2">Имя</th>
                                    {{--5--}} <th rowspan="2">Отчество</th>
                                    {{--6--}} <th rowspan="2">Год</th>
                                    {{--7--}} <th rowspan="2">Субъект</th>
                                    {{--8--}} <th rowspan="2">Муниципалитет</th>
                                    {{--9--}} <th rowspan="2">Школа</th>
                                    {{--10--}}<th rowspan="2">Класс</th>
                                    {{--11--}}<th rowspan="2">Дата экзамена</th>
                                    {{--12--}}<th rowspan="2">Всего баллов</th>
                                    {{--13--}}{{--<th>Оценка</th>--}}
                                    {{--14--}}<th colspan="6">Количество набранных баллов</th>
                                </tr>
                                <tr>
                                    {{--14--}}<th>ИЧ</th>
                                    {{--15--}}<th>ТЧ</th>
                                    {{--16--}}<th>Р1</th>
                                    {{--17--}}<th>Д</th>
                                    {{--18--}}<th>Р2</th>
                                    {{--19--}}<th>М</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    {{--1--}} <th>1</th>
                                    {{--2--}} <th>ID</th>
                                    {{--3--}} <th>Фамилия</th>
                                    {{--4--}} <th>Имя</th>
                                    {{--5--}} <th>Отчество</th>
                                    {{--6--}} <th>Год</th>
                                    {{--7--}} <th>Субъект</th>
                                    {{--8--}} <th>Муниципалитет</th>
                                    {{--9--}} <th>Школа</th>
                                    {{--10--}}<th>Класс</th>
                                    {{--11--}}<th>1</th>
                                    {{--12--}}<th>Всего баллов</th>
                                    {{--13--}}{{--<th>Оценка</th>--}}
                                    {{--14--}}<th>1</th>
                                    {{--15--}}<th>1</th>
                                    {{--16--}}<th>1</th>
                                    {{--17--}}<th>1</th>
                                    {{--18--}}<th>1</th>
                                    {{--19--}}<th>1</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                url: '{{ route('loader/view-data') }}',
                method: 'POST',
                data: {
                    id: '{{ $fileID }}',
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
                {data: 'total_result', name:'total_result'},
                {data: 'test.0', name:'test.0', searchable: false, orderable: false},
                {data: 'test.1', name:'test.1', searchable: false, orderable: false},
                {data: 'test.2', name:'test.2', searchable: false, orderable: false},
                {data: 'test.3', name:'test.3', searchable: false, orderable: false},
                {data: 'test.4', name:'test.4', searchable: false, orderable: false},
                {data: 'test.5', name:'test.5', searchable: false, orderable: false}
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
    } );
</script>
@endpush
