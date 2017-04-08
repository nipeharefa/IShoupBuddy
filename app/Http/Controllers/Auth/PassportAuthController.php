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

class PassportAuthController extends Controller
{

    private $oauth;



    public function __construct(AuthorizationServer $server,
    							TokenRepository $tokens,
                                JwtParser $jwt)
    {
        
        $this->oauth = new AccessTokenController($server, $tokens, $jwt);
    }

    public function login(ServerRequestInterface $request) {
    	
    	return $this->oauth->issueToken($request);
    	
    }

    public function register(Request $request) {
        
        $proxy = Request::create(
            'oauth/login',
            'POST'
        );

        return Route::dispatch($proxy);
    }
}
