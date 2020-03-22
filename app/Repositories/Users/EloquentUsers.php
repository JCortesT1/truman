<?php

namespace App\Repositories\Users;

use Illuminate\Support\Facades\DB;
use App\Role;
use App\User;

class EloquentUsers implements UsersInterface
{
    public function getPaginated()
    {
        $users = DB::table('usuario')->get()->paginate(5);
        return $users;
        return User::with(['role', 'sucursal'])
            ->orderBy('created_at', request('sorted', 'ASC'))
            ->paginate(5);
    }

    public function store($request)
    {
        $user = User::create($request->validated());
        $user->role()->associate($request->role);
    }

    public function update($request, $user)
    {
        $user->update($request->only('name', 'email'));
        $user->role()->dissociate();
        $user->role()->associate($request->role);
    }

    public function destroy($user)
    {
        $user->delete();
    }

    public function getRoles()
    {
        return Role::pluck('display_name', 'id');
    }
}
