<tr class='item{{$user->id}}'>
    <td class='text-center index col-md-1'>{{$user->id}}</td>
    <td class='text-center col-md-3'>{{$user->fio}}</td>
    <td class='text-center col-md-2'>{{$user->login}}</td>
    <td class='text-center col-md-3'>{{$user->email}}</td>
    <td class='text-center col-md-2'>{{$user->role}}</td>
    <td class='text-center col-md-1'>
        <button class='btn-sm btn btn-primary edit-modal' data-id='{{$user->id}}' data-fio='{{$user->fio}}' data-login='{{$user->login}}'
                data-email='{{$user->email}}' data-role='{{$user->role}}'>
            <span class='glyphicon glyphicon-edit'></span>
        </button>
        <button class='btn-sm btn btn-primary delete-modal' data-id='{{$user->id}}' data-fio='{{$user->fio}}' data-login='{{$user->login}}'
                data-email='{{$user->email}}' data-role='{{$user->role}}'>
            <span class='glyphicon glyphicon-trash'></span>
        </button>
    </td>
</tr>
