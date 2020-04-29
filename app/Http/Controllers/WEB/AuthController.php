<?php
namespace App\Http\Controllers\WEB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{


    public static function getRequest($url='films', $method='GET', $payload= array() ){

        $token = Cache::store('file')->get('access_token');

        $client = new \GuzzleHttp\Client(['base_uri' => env('BASE_URI'), 'http_errors'=>false] );
        $headers = self::headers($token);

        $response = $client->request($method, $url, [
            'headers' => $headers
        ]);
        if($response->getStatusCode() == 401){

            //TOKEN EXPIRED
            $response = $client->request('POST', 'login', [
                'headers' => $headers,
                'form_params' => ['email'=>env('ACCOUNT_EMAIL'),'password'=> env('ACCOUNT_PASS')],
            ]);
            $loginResponse = json_decode($response->getBody(), true);

            if(isset($loginResponse['token'])){
                //UPDATE TOKEN
                $token = $loginResponse['token'];

                Cache::put('access_token', $token, now()->addMinutes(60));

                //UPDATE TOKEN & MAKE REQUEST
                $headers = self::headers($token);
                $response = $client->request($method, $url, [
                    'headers' => $headers
                ]);

            }

        }elseif ($response->getStatusCode() == 200){
            //VALID TOKEN
        }else{
            //ERROR
        }

        $responseJSON = json_decode($response->getBody(), true);
        return $responseJSON;

    }


    private static function headers($token){
        return $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
            'Content-Type'        => 'application/x-www-form-urlencoded',
        ];
    }

}
