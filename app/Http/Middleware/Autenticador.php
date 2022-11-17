<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class Autenticador
{
    public function handle(Request $request, \Closure $next)
    {
        try{
            if (!$request->hasHeader('Authorization')) {
                throw new \Exception();
            }
            $authorizationHeader = $request->header(('Authorization'));
            $token = str_replace('Bearer ','', $authorizationHeader);
            $atenticacao = JWT::decode($token, new Key(env('JWT_KEY'), 'HS256'));

            $user = User::where('email', $atenticacao->email)->first();

            if(is_null($user)){
                throw new \Exception();
            }

            return $next($request);
        } catch(\Exception $e){
            return response()->json('Não autorizado');
        }
    }
}
