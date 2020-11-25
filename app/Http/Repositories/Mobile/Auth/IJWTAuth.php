<?php


namespace App\Http\Repositories\Mobile\Auth;
use Illuminate\Http\Request;

interface IJWTAuth
{
    public function login(Request $request , $email , $password , $expectedRole);

    public function signUp($values);

    public function isOwner($user);

    public function isClient($user);

    public function checkPassedRole($passedRole , $userRole);

}
