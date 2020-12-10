<?php


namespace App\Http\Repositories\Mobile\Auth;

use App\Http\Requests\SignupRequest;
use Illuminate\Http\Request;

interface IJWTAuth
{
    public function login(Request $request , $email , $password , $expectedRole);

    public function signUp(Request $request , $values , $roleId);

    public function checkPassedRole($passedRole , $userRole);

    public function checkUserStatus($user);

}
