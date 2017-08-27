<div class="row">
    {{$files->links()}}
    <table class="table table-responsive table-hover table-bordered">
        <thead>
        <tr>
            <th class="text-center col-md-4">Вид диагностики</th>
            <th class="text-center col-md-4">Всего загружено</th>
            <th class="text-center col-md-4">Дата последней загрузки</th>
        </tr>
        </thead>
        <tbody class="table table-responsive table-hover">
        @foreach($files as $file)
            <tr>
                <td class="text-center col-md-4">{{$file->name}}</td>
                <td class="text-center col-md-4">{{$file->total}}</td>
                <td class="text-center col-md-4">{{$file->last_created}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="row">
    {{$files->links()}}
</div>