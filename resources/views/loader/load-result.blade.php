@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Действия над загруженным файлом результатов диагностики</div>
                    <div class="panel-body">
                        <ul>
                            <li>Имя файла: {{ $fileData->file_name }}</li>
                            <li>Диагностика: {{ $fileData->diagnosticType->name }}</li>
                            <li>Предмет: {{ $fileData->diagnosticSubject->name }}</li>
                            <li>Год: {{ $fileData->year }}</li>
                            <li>Дата экзамена: {{ $fileData->exam_date }}</li>
                        </ul>
                        <form name="result" id="result" action="{{ route('loader/processingFile') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="diagnostic_file_id" value="{{ $fileData['id'] }}">
                        </form>
                    </div>
                    <div class="panel-footer">
                        <button form="result" type="submit" id="process_file_result" class="btn btn-primary edit"><span class="glyphicon glyphicon-check"></span>Обработать</button>
                        <button type="button" class="btn btn-primary btn-danger" data-toggle="modal" data-target="#deleteConfirmation" title="Удалить"><span class="glyphicon glyphicon-trash"></span>Отменить(удалить загруженный файл)</button>
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
                        <input id="deleteFileID" type="hidden" name="file_id" value="{{ $fileData['id'] }}">
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
@endsection