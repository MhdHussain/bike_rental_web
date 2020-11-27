<?php


namespace App\Http\Controllers\Api\V1\Mobile\Client;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Mobile\Auth\IJWTAuth;
use App\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientAuthController extends Controller
{

    /**
     * @var IJWTAuth
     */
    private $auth;

    public function __construct(IJWTAuth $auth)
    {
        $this->auth = $auth;
    }

    public function login(Request $request)
    {
        return $this->auth->login($request ,
            $request->get('email') , $request->get('password'),
            'Client'
        );
    }

    public function signUp(Request $request)
    {
        $roleId = Role::where('title' , 'Client')->first()->id;

        $this->auth->signUp($request->all() , $roleId);

        return  response()
        ->setStatusCode(Response::HTTP_CREATED);
    }

}
