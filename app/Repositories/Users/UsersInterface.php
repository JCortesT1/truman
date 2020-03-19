<?php

namespace App\Repositories\Users;

interface UsersInterface
{
	public function getPaginated();
	public function store($request);
	public function update($request, $user);
	public function destroy($user);
	public function getRoles();
}
