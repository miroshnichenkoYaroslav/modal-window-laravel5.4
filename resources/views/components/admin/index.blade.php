<div class="container">
    <div class="row">
        {{ $users->links() }}
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <button class="btn-sm btn btn-primary add-modal"
                    data-toggle="modal" data-target="#create">
                Добавить
            </button>
            <button class="btn-sm btn btn-success reload">
                Обновить данные
            </button>
        </div>

        <div class="panel-body">
            <div class="row">
                <table id="userTable" class="table table-responsive table-striped table-hover table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center col-md-1">#</th>
                        <th class="text-center col-md-3">ФИО</th>
                        <th class="text-center col-md-2">Логин</th>
                        <th class="text-center col-md-3">Email</th>
                        <th class="text-center col-md-2">Роль</th>
                        <th class="text-center col-md-1">Действия</th>
                    </tr>
                    {{ csrf_field() }}
                    </thead>
                    <tbody class="table table-responsive table-hover">
                    @foreach($users as $user)
                        <tr class="item{{$user->id}}">
                            <td class="text-center index col-md-1">{{ isset($i) ? ++$i : $i = ($users->currentPage() - 1) * 10 + 1}}</td>
                            <td class="text-center col-md-3">{{$user->fio}}</td>
                            <td class="text-center col-md-2">{{$user->login}}</td>
                            <td class="text-center col-md-3">{{$user->email}}</td>
                            <td class="text-center col-md-2">{{$user->role}}</td>
                            <td class="text-center col-md-1">
                                <button class="btn-sm btn btn-primary edit-modal"
                                        data-toggle="modal" data-target="#edit" data-id="{{$user->id}}"
                                        data-fio="{{$user->fio}}" data-login="{{$user->login}}"
                                        data-email="{{$user->email}}" data-role="{{$user->role}}">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </button>
                                <button class="btn-sm btn btn-danger delete-modal"
                                        data-toggle="modal" data-target="#delete" data-id="{{$user->id}}">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        {{ $users->links() }}
    </div>
</div>


<!-- Modal form to add a form -->
<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                            <label class="control-label col-sm-3" for="fio-edit">ФИО:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fio-add" autofocus>
                            <p class="errorAdd errorFio text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="login-add">Логин:</label>
                        <div class="col-sm-9">
                            <input class="form-control" id="login-add" cols="40" rows="5">
                            <p class="errorAdd errorLogin text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password-add" class="control-label col-sm-3">Пароль:</label>
                        <div class="col-sm-9">
                            <input id="password-add" type="password" class="form-control" name="password">
                            <p class="errorAdd errorPassword text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm-add" class="control-label col-sm-3">Потверждение:</label>
                        <div class="col-sm-9">
                            <input id="password-confirm-add" type="password" class="form-control"
                                   name="password_confirmation">
                            <p class="errorAdd errorPasswordConfirm text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="email-add">Почта:</label>
                        <div class="col-sm-9">
                            <input class="form-control" id="email-add" cols="40" rows="5">
                            <p class="errorAdd errorEmail text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role-add" class="control-label col-sm-3">Роль</label>
                        <div class="col-sm-9">
                            <select id="role-add" name="role" class="form-control" required>
                                <option value="guest">Гость</option>
                                <option value="admin">Администратор</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary add" data-dismiss="modal">
                        <span class='glyphicon glyphicon-check'></span> Добавить
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Отмена
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal form to edit a form -->
<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group hidden">
                        <label class="control-label col-sm-2" for="id-edit">ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id-edit" autofocus>
                            <p class="errorId text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="fio-edit">ФИО:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fio-edit" autofocus>
                            <p class="errorFio text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="login-edit">Логин:</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="login-edit" cols="40" rows="5">
                            <p class="errorLogin text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email-edit">Почта:</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="email-edit" cols="40" rows="5">
                            <p class="errorEmail text-center alert alert-danger hidden"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role-edit" class="control-label col-sm-2">Роль</label>
                        <div class="col-sm-10">
                            <select id="role-edit" name="role" class="form-control" required cols="40" rows="5">
                                <option value="guest">Гость</option>
                                <option value="admin">Администратор</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary edit" data-dismiss="modal">
                        <span class='glyphicon glyphicon-check'></span> Редактировать
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Отмена
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal form to delete a form -->
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="text-center">Вы уверены, что хотите удалить пользователя?</h3>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger delete" data-dismiss="modal">
                        <span id="" class='glyphicon glyphicon-trash'></span> Удалить
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Отмена
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


