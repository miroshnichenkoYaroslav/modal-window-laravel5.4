@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Редактирование информации о файле</div>
                    <div class="panel-body">
                        <form id="file_form" class="form-horizontal" method="POST"
                              action="{{ route('loader/editFile') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="file_id" value="{{ $file->id }}">

                            <div class="form-group{{ $errors->has('file_name') ? ' has-error' : '' }}">
                                <label for="file" class="col-md-4 control-label">Файл отчета</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control"
                                           value="{{ old('file_name', $file->file_name) }}" disabled>

                                    @if ($errors->has('file_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('file_name') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('diagnostic_type_id') ? ' has-error' : '' }}">
                                <label for="file" class="col-md-4 control-label">Диагностика</label>

                                <div class="col-md-6">

                                    <select id="diagnostic_type_id" class="form-control" name="diagnostic_type_id"
                                            >
                                        <option value="">Выбрать</option>
                                        @foreach($types as $type)
                                            @if (old('diagnostic_type_id', $file->diagnostic_type_id) == $type['id'])
                                                <option value="{{ $type['id'] }}" selected>{{ $type['name'] }}</option>
                                            @else
                                                <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('diagnostic_type_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('diagnostic_type_id') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('diagnostic_subject_id') ? ' has-error' : '' }}">
                                <label for="file" class="col-md-4 control-label">Предмет</label>

                                <div class="col-md-6">

                                    <select id="diagnostic_subject_id" class="form-control"
                                            name="diagnostic_subject_id">
                                        <option value="">Выбрать</option>
                                        @foreach($subjects as $subject)
                                            @if (old('diagnostic_subject_id', $file->diagnostic_subject_id) == $subject['id'])
                                                <option value="{{ $subject['id'] }}"
                                                        selected>{{ $subject['name'] }}</option>
                                            @else
                                                <option value="{{ $subject['id'] }}">{{ $subject['name'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('diagnostic_subject_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('diagnostic_subject_id') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                <label for="file" class="col-md-4 control-label">Год</label>

                                <div class="col-md-6">

                                    <select id="year" class="form-control" name="year" required>
                                        <option value="">Выбрать</option>
                                        @foreach($years as $year)
                                            @if (old('year', $file->year) == $year)
                                                <option value="{{ $year }}" selected>{{ $year }}</option>
                                            @else
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('year'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('exam_date') ? ' has-error' : '' }}">
                                <label for="file" class="col-md-4 control-label">Дата экзамена</label>

                                <div class="col-md-6">
                                    <input id="exam_date" type="date" class="form-control" name="exam_date"
                                           value="{{ old('exam_date', $file->exam_date) }}" autofocus>

                                    @if ($errors->has('exam_date'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('exam_date') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <input id="submitForm" type="submit" class="btn btn-primary" value="Отправить">
                                    <a href="{{ route('loader/index') }}" class="btn btn-primary" role="button">
                                        Отменить
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(function () {
        var fileForm = $('#file_form'),
            inputElements = fileForm.find('input, select');

        inputElements.bind('change blur', function () {
            validateCurrentElement(this);
        });

        inputElements.bind('focus', function () {
            deleteErrorMsg(this);
        });

        $('#submitForm').bind('click', function (event) {
            console.log(11111)
            var error = 0,
                firstBadElement = false;
            inputElements.each(function () {
                console.log(22222)
                if (validateCurrentElement(this) > 0) {
                    if (!firstBadElement) {
                        firstBadElement = this;
                    }
                    error++;
                }
            });
            if (error > 0) {
                event.preventDefault();

                // сперва получаем позицию элемента относительно документа
                var scrollTop = $(firstBadElement).offset().top - 120;
                // скроллим страницу на значение равное позиции элемента
                $(document).scrollTop(scrollTop);

                return false;
            } else {
                fileForm.submit();
            }
        })
    })


    function insertErrorMsg(inputElement, msg) {
        var inputElementName = inputElement.attr('name'),
            msgList = {
                'diagnostic_type_id': 'Необходимо выбрать тип диагностики',
                'year': 'Необходимо выбрать год',
                'exam_date': 'Необходимо указать дату экзамена'
            };

        if (msg == '') {
            msg = msgList[inputElementName];
        }

        inputElement.css('border', '1px solid red');
        if (inputElement.siblings('div.error').length < 1) {
            inputElement.after('<div class="error">' + msg + '</div>')
        }
    }

    //Валидация формы
    function validateCurrentElement(element) {
        var errorCaunt = 0;
        var currentElement = $(element);
        if (currentElement.prop('required') && !currentElement.prop('disabled')) {

            var currentValue = currentElement.val().trim(),
                currentType = currentElement.attr('type');

            if (currentValue === '' || currentValue === null) {
                currentElement.css('border', '1px solid red');
                insertErrorMsg(currentElement, '');
                errorCaunt++;
            } else if (currentType === 'file') {
                if (!checkFileSize(element)) {
                    insertErrorMsg(currentElement, 'Выбраный файл слишком большой! Максимальный размер файла 10Мб!');
                    errorCaunt++;
                }
                if (!checkFileType(element)) {
                    insertErrorMsg(currentElement, 'Выбран файл недопустимого типа! Можно загружать только XLSX файлы!');
                    errorCaunt++;
                }
            }
        }

        return errorCaunt;
    }

    //Валидация типа файла
    function checkFileType(fileInput, allowedTypes) {
        if (allowedTypes === undefined) {
            //По умолчанию пропускаются все PDF файлы
            allowedTypes = 'xlsx';
        }

        var fileObj;
        if (typeof ActiveXObject == "function") { // для IE
            fileObj = (new ActiveXObject("Scripting.FileSystemObject")).getFile(fileInput.value);
        } else {
            fileObj = fileInput.files[0];
        }

        //Если файл не выбран или указан пустой список типов - валидация удачна
        if (fileObj === null || fileObj === undefined || allowedTypes == '') {
            return true
        } else {
            var fileName = fileObj.name;
            //Получаем расширение файла в нижнем регистре и валидируем
            var fileExt = fileName.split(".").pop().toLowerCase();
            return !!(allowedTypes.indexOf(fileExt) + 1);
        }
    }

    //Валидация размера файла
    function checkFileSize(fileInput, maxSize) {
        if (maxSize === undefined) {
            maxSize = 10;
        }

        var fileObj,
            fileSize;
        if (typeof ActiveXObject == "function") { // для IE
            fileObj = (new ActiveXObject("Scripting.FileSystemObject")).getFile(fileInput.value);
        } else {
            fileObj = fileInput.files[0];
        }

        //Если файл не выбран - валидация удачна
        if (fileObj === null || fileObj === undefined) {
            return true
        } else {
            fileSize = fileObj.size; // Size returned in bytes.
            if (fileSize > maxSize * 1024 * 1024) {
                return false
            }
        }

        return true;
    }

    //Удаляет блок вывода ошибки валидации возле элемента
    function deleteErrorMsg(element) {
        var inputElement = $(element);
        inputElement.css('border', '');
        inputElement.siblings('div.error').remove();
    }

</script>
@endpush
