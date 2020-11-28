<?php


namespace App\Http\Repositories\Mobile\Auth;


use App\Models\User;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class JWTAuth implements IJWTAuth
{

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login(Request $request , $email, $password , $expectedRole)
    {
        $currentUser = $this->user->whereEmail(request('email'))->first();
        abort_if(!$currentUser, Response::HTTP_NOT_FOUND,
            'wrong email or password');
        abort_if(!Hash::check(request('password'), $currentUser->password),
            Response::HTTP_NOT_FOUND, 'wrong email or password');


        $this->checkUserStatus($currentUser);

        $client = DB::table('oauth_clients')
            ->where('password_client', '=', '1')
            ->first();

        abort_if(!$client, Response::HTTP_BAD_GATEWAY,
            'something wrong with the client , please contact the admin');

        $data = array(
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => request('email'),
            'password' => request('password'),
        );

        $request->request->add($data);
        $req = Request::create('oauth/token', 'POST');
//
        $response = Route::dispatch($req);




        $json = json_decode($response->content());
        $role = $currentUser->roles()->first()->title;

        $this->checkPassedRole($expectedRole , $role);

        return response()->json($json);


    }

    public function checkPassedRole($passedRole , $userRole)
    {
        abort_if(strcasecmp($passedRole , $userRole) != 0 ,
            Response::HTTP_UNAUTHORIZED , 'You are not authorized to use this app' );
    }

    public function signUp($values , $roleId)
    {
        $user = $this->user->whereEmail(request('email'))->first();
        abort_if($user != null , Response::HTTP_NOT_FOUND,
            'Email is already in use , please use another email or sign in');

        $values['status'] = 'Enabled';

        $user = $this->user->create($values);
        $user->roles()->sync($roleId);
    }

    public function checkUserStatus($user)
    {

        abort_if(strcasecmp("Enabled", $user->status) != 0,
            Response::HTTP_CONFLICT, "your user has been disabled , please contact the admin.");

    }

}
