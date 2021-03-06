<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

class AdministrationController extends Controller
{
    /**
     * Вывает middleware admin.
     *
     * AdministrationController constructor.
     */
    public function __construct()
    {
        $this->middleware('userRole');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
            ->orderBy('fio', 'ASC')
            ->paginate(10);

        return view('admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fio' => 'required|min:6|max:255',
            'email' => 'required|min:4|max:255|unique:users,email|email',
            'login' => 'required|min:4|max:255',
            'role' => 'required',
            'password' => 'required|min:6|max:32|confirmed',
            'password_confirmation' => 'required|min:6|max:32',
        ]);

        $html = view('admin.td')->with(
            'user',
            User::create($request->all())
        )->render();

        return response()->json([
            'html' => $html
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $admin
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, User $admin)
    {
        $this->validate($request, [
            'fio' => 'required|min:6|max:255',
            'email' => 'required|min:4|max:255|unique:users,email,' . request()->admin->id,
            'login' => 'required|min:4|max:255',
            'role' => 'required',
        ]);

        $admin->update($request->all());

        return response()->json($admin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json();
    }

}
