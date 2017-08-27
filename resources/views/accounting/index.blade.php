@extends('layouts.app')
@section('content')
    <div class="container">
        @if (request()->is('accounting'))

            {{-- Данные о загруженных файлах. --}}
            @component('components.accounting.files', [
                'files' => $files
            ])
            @endcomponent

            {{-- Фильтры для обработки данных. --}}
            @component('components.accounting.filters', [
                'regions' => $regions,
                'subjects' => $subjects,
                'diagnostics' => $diagnostics
            ])
            @endcomponent

            @component('components.accounting.result', [
                //'users' => $users
            ])
            @endcomponent

            @component('components.accounting.graphics', [
                //'users' => $users
            ])
            @endcomponent

        @endif
    </div>
@endsection