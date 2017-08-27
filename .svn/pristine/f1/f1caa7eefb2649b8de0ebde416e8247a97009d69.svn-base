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
                                {{--1--}} <th rowspan="2">ID</th>
                                {{--2--}} <th rowspan="2">Фамилия</th>
                                {{--3--}} <th rowspan="2">Имя</th>
                                {{--4--}} <th rowspan="2">Отчество</th>
                                {{--5--}} <th rowspan="2">Год</th>
                                {{--6--}} <th rowspan="2">Субъект</th>
                                {{--7--}} <th rowspan="2">Муниципалитет</th>
                                {{--8--}} <th rowspan="2">Школа</th>
                                {{--9--}} <th rowspan="2">Класс</th>
                                {{--10--}}<th rowspan="2">Предмет</th>
                                {{--11--}}<th rowspan="2">Дата экзамена</th>
                                {{--12--}}<th rowspan="2">Всего баллов</th>
                                {{--12--}}<th colspan="24">Результаты</th>
                            </tr>
                            <tr>
                                {{--13--}}<th>Задание 1</th>
                                {{--13--}}<th>Задание 2</th>
                                {{--13--}}<th>Задание 3</th>
                                {{--13--}}<th>Задание 4</th>
                                {{--13--}}<th>Задание 5</th>
                                {{--13--}}<th>Задание 6</th>
                                {{--13--}}<th>Задание 7</th>
                                {{--13--}}<th>Задание 8</th>
                                {{--13--}}<th>Задание 9</th>
                                {{--13--}}<th>Задание 10</th>
                                {{--13--}}<th>Задание 11</th>
                                {{--13--}}<th>Задание 12</th>
                                {{--13--}}<th>Задание 13</th>
                                {{--13--}}<th>Задание 14</th>
                                {{--13--}}<th>Задание 15</th>
                                {{--13--}}<th>Задание 16</th>
                                {{--13--}}<th>Задание 17</th>
                                {{--13--}}<th>Задание 18</th>
                                {{--13--}}<th>Задание 19</th>
                                {{--13--}}<th>Задание 20</th>
                                {{--13--}}<th>Задание 21</th>
                                {{--13--}}<th>Задание 22</th>
                                {{--13--}}<th>Задание 23</th>
                                {{--13--}}<th>Задание 24</th>
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
                                <th>7</th>
                                <th>8</th>
                                <th>9</th>
                                <th>10</th>
                                <th>11</th>
                                <th>12</th>
                                <th>13</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
                                {{--13--}}<th>1</th>
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
                    {data: 'DT_Row_Index',          name:'index', searchable: false, orderable: false},
                    {data: 'id',                    name:'id', visible: true},
                    {data: 'first_name',            name:'first_name'},
                    {data: 'last_name',             name:'last_name'},
                    {data: 'middle_name',           name:'middle_name'},
                    {data: 'diagnostic_file.year',  name:'diagnosticFile.year'},
                    {data: 'region.name',           name:'region.name'},
                    {data: 'municipality.name',     name:'municipality.name'},
                    {data: 'school.name',           name:'school.name'},
                    {data: 'class',                 name:'class'},
                    {data: 'subject.name',          name:'subject.name'},
                    {data: 'diagnostic_file.exam_date', name:'diagnosticFile.exam_date', searchable: false},
                    {data: 'total_result',      name:'total_result'},

                    {data: 'test.0',  name:'test.0',  searchable: false, orderable: false},
                    {data: 'test.1',  name:'test.1',  searchable: false, orderable: false},
                    {data: 'test.2',  name:'test.2',  searchable: false, orderable: false},
                    {data: 'test.3',  name:'test.3',  searchable: false, orderable: false},
                    {data: 'test.4',  name:'test.4',  searchable: false, orderable: false},
                    {data: 'test.5',  name:'test.5',  searchable: false, orderable: false},
                    {data: 'test.6',  name:'test.6',  searchable: false, orderable: false},
                    {data: 'test.7',  name:'test.7',  searchable: false, orderable: false},
                    {data: 'test.8',  name:'test.8',  searchable: false, orderable: false},
                    {data: 'test.9',  name:'test.9',  searchable: false, orderable: false},
                    {data: 'test.10', name:'test.10', searchable: false, orderable: false},
                    {data: 'test.11', name:'test.11', searchable: false, orderable: false},
                    {data: 'test.12', name:'test.12', searchable: false, orderable: false},
                    {data: 'test.13', name:'test.13', searchable: false, orderable: false},
                    {data: 'test.14', name:'test.14', searchable: false, orderable: false},
                    {data: 'test.15', name:'test.15', searchable: false, orderable: false},
                    {data: 'test.16', name:'test.16', searchable: false, orderable: false},
                    {data: 'test.17', name:'test.17', searchable: false, orderable: false},
                    {data: 'test.18', name:'test.18', searchable: false, orderable: false},
                    {data: 'test.19', name:'test.19', searchable: false, orderable: false},
                    {data: 'test.20', name:'test.20', searchable: false, orderable: false},
                    {data: 'test.21', name:'test.21', searchable: false, orderable: false},
                    {data: 'test.22', name:'test.22', searchable: false, orderable: false},
                    {data: 'test.23', name:'test.23', searchable: false, orderable: false}
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
