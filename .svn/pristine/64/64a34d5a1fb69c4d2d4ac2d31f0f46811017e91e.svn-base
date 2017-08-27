@extends('layouts.app')
@section('content')
    <div class="container">

        @if (request()->is('admin'))
            {{-- Вывод всех пользователей. --}}
            @component('components.admin.index', [
                'users' => $users
            ])
            @endcomponent
        @endif
    </div>
@endsection