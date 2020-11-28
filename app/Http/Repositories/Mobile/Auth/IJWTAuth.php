<?php


namespace App\Http\Repositories\Mobile\Auth;
use Illuminate\Http\Request;

interface IJWTAuth
{
    public function login(Request $request , $email , $password , $expectedRole);

    public function signUp($values , $roleId);

    public function checkPassedRole($passedRole , $userRole);

    public function checkUserStatus($user);

}
