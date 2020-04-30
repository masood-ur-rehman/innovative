<?php
namespace App\Http\Controllers\WEB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{

    /**
     * PURPOSE: MAKE REQUEST FROM API
     * @param string $url
     * @param string $method
     * @param array $payload
     * @return mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public static function getRequest($url='films', $method='GET', $payload= array() ){

        /*ACCESS TOKEN IS STORED FOR AN HOUR*/
        $token = Cache::store('file')->get('access_token');

        $client = new \GuzzleHttp\Client(['base_uri' => env('BASE_URI'), 'http_errors'=>false] );
        $headers = self::headers($token);

        $response = $client->request($method, $url, [
            'headers' => $headers
        ]);

        /*IF TOKEN HAS EXPIRED */
        if($response->getStatusCode() == 401){

            //MAKE A REQUEST
            $response = $client->request('POST', 'login', [
                'headers' => $headers,
                'form_params' => ['email'=>env('ACCOUNT_EMAIL'),'password'=> env('ACCOUNT_PASS')],
            ]);
            $loginResponse = json_decode($response->getBody(), true);

            if(isset($loginResponse['token'])){
                //UPDATE TOKEN
                $token = $loginResponse['token'];

                /*UPDATE TOKEN IN CACHE FOR AN HOUR*/
                Cache::put('access_token', $token, now()->addMinutes(60));

                //UPDATE TOKEN & MAKE REQUEST
                $headers = self::headers($token);
                $response = $client->request($method, $url, [
                    'headers' => $headers
                ]);
            }
        }

        $responseJSON = json_decode($response->getBody(), true);
        return $responseJSON;

    }


    private static function headers($token){
        /* REQUEST HEADER */
        return $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
            'Content-Type'        => 'application/x-www-form-urlencoded',
        ];
    }

}
