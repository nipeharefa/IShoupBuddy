<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser as JwtParser;
use Zend\Diactoros\Response as Psr7Response;
use Psr\Http\Message\ServerRequestInterface;
use League\OAuth2\Server\AuthorizationServer;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Route;
use Validator;
use App\Models\User;

class PassportAuthController extends Controller
{

    private $oauth;



    public function __construct(AuthorizationServer $server,
    							TokenRepository $tokens,
                                JwtParser $jwt)
    {
        
        $this->oauth = new AccessTokenController($server, $tokens, $jwt);
    }


    /**
     * URL for login onlu API
     * @param  ServerRequestInterface $request [description]
     * @param  Request                $req     [description]
     * @return [type]                          [description]
     */
    public function login(ServerRequestInterface $request, Request $req) {
        
    	return $this->oauth->issueToken($request);
    	
    }

    public function register(Request $request) {
        

        # Register user here
        
        $validator = Validator::make($request->all(), [
            'name'      => 'required|max:255',
            'email'     => 'required|email|max:255|unique:users',
            'password'  => 'required',
            'phone'     => 'required'
        ]);

        # validate
        $validator->validate();

        # Insert to Database
        


       $user = $this->create($request->all());

       $data= [
            "grant_type"    => "password",
            "client_id"     => env('CLIENT_ID', 2),
            "client_secret" => env('CLIENT_SECRET'),
            "username"      => $request->email,
            "password"      => $request->password
       ];


       # Set Request to OauthServer
       $request->offsetSet('grant_type', 'password');
       $request->offsetSet('username', $request->email);
       $request->offsetSet('password', $request->password);
       $request->offsetSet('client_id', env('CLIENT_ID', 2));
       $request->offsetSet('client_secret', env('CLIENT_SECRET', 2));


       // remove keys email, name, phone
       $request->offsetUnset('email');
       $request->offsetUnset('phone');
       $request->offsetUnset('name');


        $proxy = Request::create(
            'oauth/login',
            'POST'
        );



        return Route::dispatch($proxy);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone']
        ]);
    }
}
