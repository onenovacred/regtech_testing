<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use Exception;
use Auth;
use App\Models\ApiMaster;
use App\Models\SchemeMaster;
use App\Models\HitCountMaster;
use App\Models\SchemeTypeMaster;
use App\Models\User;
use Redirect;
use App\Models\Transaction;


class ItrController1 extends Controller
{
    private $sandbox_url = 'https://sandbox.flowboard.in/api/v1';
    private $sandbox_token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE2MjUzOTIyMTYsImp0aSI6IjhkOWZmNTFiLTJiYmItNDc4My1iYmI5LTg5ZWMzNGY3MDNmZiIsImlkZW50aXR5IjoiZGV2LmRvY2JveXpAYWFkaGFhcmFwaS5pbyIsImZyZXNoIjpmYWxzZSwiaWF0IjoxNTkzODU2MjE2LCJuYmYiOjE1OTM4NTYyMTYsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJyZWFkIl19LCJ0eXBlIjoiYWNjZXNzIn0.f0Ea5UmL_DQsSCBF6sWJzU-n7NPT9TL_IkKFY_a-3KQ';

    private $base_url = 'https://kyc-api.flowboard.in/api/v1';
    private $token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDI3Njc0NDUsIm5iZiI6MTYwMjc2NzQ0NSwianRpIjoiNzRjNzRmNjMtNGZhNS00N2I0LTkxYmYtNjcyYjZiMmRjNzYyIiwiZXhwIjoxOTE4MTI3NDQ1LCJpZGVudGl0eSI6ImRldi5kb2Nib3l6QGZsb3dib2FyZC5pbiIsImZyZXNoIjpmYWxzZSwidHlwZSI6ImFjY2VzcyIsInVzZXJfY2xhaW1zIjp7InNjb3BlcyI6WyJyZWFkIl19fQ.2vNK9AhqCAk5Vz3K9rAZ_YtxIzTLoxK8zejh-ES4Meo';
    private $tokenitr = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDU3NjQ1MDUsIm5iZiI6MTYwNTc2NDUwNSwianRpIjoiYzViMmQ5YTAtOWJhOC00Y2ZlLWExOGEtYzZmZWZjNGE2NDQzIiwiZXhwIjoxOTIxMTI0NTA1LCJpZGVudGl0eSI6ImRldi5kb2Nib3l6QGFhZGhhYXJhcGkuaW8iLCJmcmVzaCI6ZmFsc2UsInR5cGUiOiJhY2Nlc3MiLCJ1c2VyX2NsYWltcyI6eyJzY29wZXMiOlsicmVhZCJdfX0.x9bcGLDzz9UdaOpEI_gQsKv930Up_J4DPWVIMCHTBz8';
    public function itr_initiate(Request $request)
    {
        // Fetch user by access token
        $user = User::where('access_token', $request->header('AccessToken'))->first();

        // If user not found, return unauthorized response
        if (!$user) {
            return response()->json([
                'status_code' => 401,
                'message' => 'Unauthorized: Invalid Access Token'
            ]);
        }

        $statusCode = null;
        $itr_initiate = null;
        $hit_limits_exceeded = 0;

        $client = new Client();
        $headers = [
            'Authorization' => 'Bearer ' . $request->header('AccessToken'),
            'Accept' => 'application/json',
        ];

        $body = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if ($user->scheme_type != 'demo') {
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'itrinitiate')->first();
                if ($apiamster) {
                    $api_id = $apiamster->id;
                }
            }

            try {
                $res = $client->post('https://sandbox.aadhaarkyc.io/api/v1/itr/create-client', [
                    'headers' => $headers,
                    'json' => $body
                ]);
                $itr_initiate = json_decode($res->getBody(), true);

                if ($user->role_id == 1 && isset($apiamster)) {
                    $updateHitCount = SchemeMaster::where('user_id', $user->id)
                        ->where('api_id', $api_id)
                        ->first();

                    $addHitCount = new HitCountMaster();
                    $addHitCount->user_id = $user->id;
                    $addHitCount->api_id = $api_id;
                    $addHitCount->scheme_price = $updateHitCount->scheme_price;
                    $addHitCount->hit_year_month = date('Y-m');
                    $addHitCount->hit_count = 1;
                    $addHitCount->save();

                    $remark = 'Pan Card Service Debited ' . $updateHitCount->scheme_price . ' Successfully';
                    $this->update_transaction($api_id, $updateHitCount->scheme_price, $remark);
                    $this->update_wallet_balance($updateHitCount->scheme_price);
                }
                $statusCode = 200;
            } catch (BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
            }
        } else {
            $scheme_type = SchemeTypeMaster::where('id', $user->scheme_type_id)->first();
            $hit_count_remaining = $scheme_type->hit_limits - $user->scheme_hit_count;
            if ($hit_count_remaining > 0) {
                try {
                    $res = $client->post('https://sandbox.aadhaarkyc.io/api/v1/itr/create-client', [
                        'headers' => $headers,
                        'json' => $body
                    ]);
                    $itr_initiate = json_decode($res->getBody(), true);

                    $user->scheme_hit_count += 1;
                    $user->save();

                    $statusCode = 200;
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                }
            } else {
                $hit_limits_exceeded = 1;
                return response()->json([
                    'status_code' => 429,
                    'message' => 'Hit limits exceeded',
                    'hit_limits_exceeded' => $hit_limits_exceeded
                ]);
            }
        }

        return response()->json([
            'status_code' => $statusCode,
            'itr_initiate' => $itr_initiate,
            'hit_limits_exceeded' => $hit_limits_exceeded,
            'message' => $statusCode == 200 ? 'ITR Client created successfully' : 'Failed to create ITR Client'
        ]);
    }


    public function itr_enter_clientid(Request $request)
    {
        return 'sssds';
        $user = User::where('access_token', $request->header('AccessToken'))->first();

        $statusCode = null;
        $itr_enter_clientid = null;
        $hit_limits_exceeded = 0;

        $client = new Client();
        $headers = [
            'Authorization' => $this->tokenitr,
            'Accept' => 'application/json',
        ];

        $body = [
            'client_id' => $request->client_id
        ];
        if ($user->scheme_type != 'demo') {
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'itrenterclientid')->first();
                if ($apiamster)
                    $api_id = $apiamster->id;
            }

            try {
                $res = $client->post('https://sandbox.aadhaarkyc.io/api/v1/itr/check-credentials', ['headers' => $headers, 'json' => $body]);
                $itr_enter_clientid = json_decode($res->getBody(), true);
                if ($user->role_id == 1) {
                    if ($apiamster) {
                        $updateHitCount = SchemeMaster::where('user_id', Auth()->user()->id)->where('api_id', $api_id)->first();

                        $addHitCount = new HitCountMaster;
                        $addHitCount->user_id = Auth()->user()->id;
                        $addHitCount->api_id = $api_id;
                        $addHitCount->scheme_price = $updateHitCount->scheme_price;
                        $addHitCount->hit_year_month = date('Y-m');
                        $addHitCount->hit_count = 1;
                        $addHitCount->save();

                        $remark = 'ITR Initiate Service Debited ' . $updateHitCount->scheme_price . ' Successfully';
                        $this->update_transaction($api_id, $updateHitCount->scheme_price, $remark);
                        $this->update_wallet_balance($updateHitCount->scheme_price);
                    }
                }
                $statusCode = 200;
            } catch (BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
            }
        } else {
            $scheme_type = SchemeTypeMaster::where('id', $user->scheme_type_id)->first();
            $hit_count_remaining = $scheme_type->hit_limits - $user->scheme_hit_count;
            if ($hit_count_remaining > 0) {
                try {
                    $res = $client->post('https://sandbox.aadhaarkyc.io/api/v1/itr/check-credentials', ['headers' => $headers, 'json' => $body]);
                    $itr_initiate = json_decode($res->getBody(), true);
                    $user = User::where('id', $user->id)->first();
                    $user->scheme_hit_count = $user->scheme_hit_count + 1;
                    $user->save();
                    $statusCode = 200;
                    // dd($itr_initiate);
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                }
            } else {
                $hit_limits_exceeded = 1;
                return response()->json(['itr_enter_clientid' => $itr_enter_clientid, 'statusCode' => $statusCode, 'hit_limits_exceeded' => $hit_limits_exceeded]);
            }
        }
        return response()->json(['itr_enter_clientid' => $itr_enter_clientid, 'statusCode' => $statusCode, 'hit_limits_exceeded' => $hit_limits_exceeded]);
    }



    public function itr_download_profile(Request $request)
    {
        $user = User::where('access_token', $request->header('AccessToken'))->first();
        $statusCode = null;
        $itr_download_profile = null;
        $hit_limits_exceeded = 0;


        $client = new Client();
        $headers = [
            'Authorization' => $this->tokenitr,
            'Accept' => 'application/json',
        ];

        $body = [
            'client_id' => $request->client_id
        ];
        if ($user->scheme_type != 'demo') {
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'itrenterclientid')->first();
                if ($apiamster)
                    $api_id = $apiamster->id;
            }

            try {
                $res = $client->post('https://sandbox.aadhaarkyc.io/api/v1/itr/download-profile', ['headers' => $headers, 'json' => $body]);
                $itr_download_profile = json_decode($res->getBody(), true);
                if ($user->role_id == 1) {
                    if ($apiamster) {
                        $updateHitCount = SchemeMaster::where('user_id', Auth()->user()->id)->where('api_id', $api_id)->first();
                        $addHitCount = new HitCountMaster;
                        $addHitCount->user_id = Auth()->user()->id;
                        $addHitCount->api_id = $api_id;
                        $addHitCount->scheme_price = $updateHitCount->scheme_price;
                        $addHitCount->hit_year_month = date('Y-m');
                        $addHitCount->hit_count = 1;
                        $addHitCount->save();

                        $remark = 'ITR Download Profile Service Debited ' . $updateHitCount->scheme_price . ' Successfully';
                        $this->update_transaction($api_id, $updateHitCount->scheme_price, $remark);
                        $this->update_wallet_balance($updateHitCount->scheme_price);
                    }
                }
                $statusCode = 200;
            } catch (BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
            }
        } else {
            $scheme_type = SchemeTypeMaster::where('id', $user->scheme_type_id)->first();
            $hit_count_remaining = $scheme_type->hit_limits - $user->scheme_hit_count;
            if ($hit_count_remaining > 0) {
                try {
                    $res = $client->post('https://sandbox.aadhaarkyc.io/api/v1/itr/download-profile', ['headers' => $headers, 'json' => $body]);
                    $itr_initiate = json_decode($res->getBody(), true);
                    $user = User::where('id', $user->id)->first();
                    $user->scheme_hit_count = $user->scheme_hit_count + 1;
                    $user->save();
                    $statusCode = 200;
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                }
            } else {
                $hit_limits_exceeded = 1;
                return response()->json(['itr_download_profile' => $itr_download_profile, 'statusCode' => $statusCode, 'hit_limits_exceeded' => $hit_limits_exceeded]);
            }
        }
        return response()->json(['itr_download_profile' => $itr_download_profile, 'statusCode' => $statusCode, 'hit_limits_exceeded' => $hit_limits_exceeded]);
    }


    public function itr_download(Request $request)
    {
        $user = User::where('access_token', $request->header('AccessToken'))->first();
        $statusCode = null;
        $itr_download = null;
        $hit_limits_exceeded = 0;

        $client = new Client();
        $headers = [
            'Authorization' => $this->tokenitr,
            'Accept' => 'application/json',
        ];

        $body = [
            'client_id' => $request->client_id
        ];
        if ($user->scheme_type != 'demo') {
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'itrenterclientid')->first();
                if ($apiamster)
                    $api_id = $apiamster->id;
            }

            try {
                $res = $client->post('https://sandbox.aadhaarkyc.io/api/v1/itr/download-itr', ['headers' => $headers, 'json' => $body]);
                $itr_download = json_decode($res->getBody(), true);
                if ($user->role_id == 1) {
                    if ($apiamster) {
                        $updateHitCount = SchemeMaster::where('user_id', Auth()->user()->id)->where('api_id', $api_id)->first();
                        $addHitCount = new HitCountMaster;
                        $addHitCount->user_id = Auth()->user()->id;
                        $addHitCount->api_id = $api_id;
                        $addHitCount->scheme_price = $updateHitCount->scheme_price;
                        $addHitCount->hit_year_month = date('Y-m');
                        $addHitCount->hit_count = 1;
                        $addHitCount->save();

                        $remark = 'ITR Download Service Debited ' . $updateHitCount->scheme_price . ' Successfully';
                        $this->update_transaction($api_id, $updateHitCount->scheme_price, $remark);
                        $this->update_wallet_balance($updateHitCount->scheme_price);
                    }
                }
                $statusCode = 200;
            } catch (BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
                // dd($e->getResponse());
            }
        } else {
            $scheme_type = SchemeTypeMaster::where('id', $user->scheme_type_id)->first();
            $hit_count_remaining = $scheme_type->hit_limits - $user->scheme_hit_count;
            if ($hit_count_remaining > 0) {
                try {
                    $res = $client->post('https://sandbox.aadhaarkyc.io/api/v1/itr/download-itr', ['headers' => $headers, 'json' => $body]);
                    $itr_initiate = json_decode($res->getBody(), true);
                    $user = User::where('id', $user->id)->first();
                    $user->scheme_hit_count = $user->scheme_hit_count + 1;
                    $user->save();
                    $statusCode = 200;
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                }
            } else {
                $hit_limits_exceeded = 1;
                return response()->json(['itr_download' => $itr_download, 'statusCode' => $statusCode, 'hit_limits_exceeded' => $hit_limits_exceeded]);
            }
        }
        return response()->json(['itr_download' => $itr_download, 'statusCode' => $statusCode, 'hit_limits_exceeded' => $hit_limits_exceeded]);
    }





    public function itr_download_26AS(Request $request)
    {
        $user = User::where('access_token', $request->header('AccessToken'))->first();
        $statusCode = null;
        $itr_download_26AS = null;
        $hit_limits_exceeded = 0;


        $client = new Client();
        $headers = [
            'Authorization' => $this->tokenitr,
            'Accept' => 'application/json',
        ];

        $body = [
            'client_id' => $request->client_id
        ];
        if ($user->scheme_type != 'demo') {
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'itrenterclientid')->first();
                if ($apiamster)
                    $api_id = $apiamster->id;
            }

            try {
                $res = $client->post('https://sandbox.aadhaarkyc.io/api/v1/itr/download-26as', ['headers' => $headers, 'json' => $body]);
                $itr_download_26AS = json_decode($res->getBody(), true);

                // foreach($itr_download_26AS['data']['tds'] as $itrkey => $itrvalue)
                //     dd($itrvalue);

                if ($user->role_id == 1) {
                    if ($apiamster) {
                        $updateHitCount = SchemeMaster::where('user_id', Auth()->user()->id)->where('api_id', $api_id)->first();
                        $addHitCount = new HitCountMaster;
                        $addHitCount->user_id = Auth()->user()->id;
                        $addHitCount->api_id = $api_id;
                        $addHitCount->scheme_price = $updateHitCount->scheme_price;
                        $addHitCount->hit_year_month = date('Y-m');
                        $addHitCount->hit_count = 1;
                        $addHitCount->save();

                        $remark = 'ITR Download 26AS Service Debited ' . $updateHitCount->scheme_price . ' Successfully';
                        $this->update_transaction($api_id, $updateHitCount->scheme_price, $remark);
                        $this->update_wallet_balance($updateHitCount->scheme_price);
                    }
                }
                $statusCode = 200;
            } catch (BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
            }
        } else {
            $scheme_type = SchemeTypeMaster::where('id', $user->scheme_type_id)->first();
            $hit_count_remaining = $scheme_type->hit_limits - $user->scheme_hit_count;
            if ($hit_count_remaining > 0) {
                try {
                    $res = $client->post('https://sandbox.aadhaarkyc.io/api/v1/itr/download-26as', ['headers' => $headers, 'json' => $body]);
                    $itr_download_26AS = json_decode($res->getBody(), true);
                    $user = User::where('id', $user->id)->first();
                    $user->scheme_hit_count = $user->scheme_hit_count + 1;
                    $user->save();
                    $statusCode = 200;
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                }
            } else {
                $hit_limits_exceeded = 1;
                return response()->json(['itr_download_26AS' => $itr_download_26AS, 'statusCode' => $statusCode, 'hit_limits_exceeded' => $hit_limits_exceeded]);
            }
        }
        return response()->json(['itr_download_26AS' => $itr_download_26AS, 'statusCode' => $statusCode, 'hit_limits_exceeded' => $hit_limits_exceeded]);
    }



    public function itr_submit_otp(Request $request)
    {
        $user = User::where('access_token', $request->header('AccessToken'))->first();
        $statusCode = null;
        $itr_submit_otp = null;
        $hit_limits_exceeded = 0;


        $client = new Client();
        $headers = [
            'Authorization' => $this->tokenitr,
            'Accept' => 'application/json',
        ];

        $body = [
            'client_id' => $request->client_id,
            'otp' => $request->otp
        ];
        if ($user->scheme_type != 'demo') {
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'itrenterclientid')->first();
                if ($apiamster)
                    $api_id = $apiamster->id;
            }

            try {
                $res = $client->post('https://sandbox.aadhaarkyc.io/api/v1/itr/submit-otp', ['headers' => $headers, 'json' => $body]);
                $itr_submit_otp = json_decode($res->getBody(), true);
                if ($user->role_id == 1) {
                    if ($apiamster) {
                        $updateHitCount = SchemeMaster::where('user_id', Auth()->user()->id)->where('api_id', $api_id)->first();
                        $addHitCount = new HitCountMaster;
                        $addHitCount->user_id = Auth()->user()->id;
                        $addHitCount->api_id = $api_id;
                        $addHitCount->scheme_price = $updateHitCount->scheme_price;
                        $addHitCount->hit_year_month = date('Y-m');
                        $addHitCount->hit_count = 1;
                        $addHitCount->save();

                        $remark = 'ITR Submit OTP Service Debited ' . $updateHitCount->scheme_price . ' Successfully';
                        $this->update_transaction($api_id, $updateHitCount->scheme_price, $remark);
                        $this->update_wallet_balance($updateHitCount->scheme_price);
                    }
                }
                $statusCode = 200;
            } catch (BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
            }
        } else {
            $scheme_type = SchemeTypeMaster::where('id', $user->scheme_type_id)->first();
            $hit_count_remaining = $scheme_type->hit_limits - $user->scheme_hit_count;
            if ($hit_count_remaining > 0) {
                try {
                    $res = $client->post('https://sandbox.aadhaarkyc.io/api/v1/itr/submit-otp', ['headers' => $headers, 'json' => $body]);
                    $itr_initiate = json_decode($res->getBody(), true);
                    $user = User::where('id', $user->id)->first();
                    $user->scheme_hit_count = $user->scheme_hit_count + 1;
                    $user->save();
                    $statusCode = 200;
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                }
            } else {
                $hit_limits_exceeded = 1;
                return response()->json(['itr_submit_otp' => $itr_submit_otp, 'statusCode' => $statusCode, 'hit_limits_exceeded' => $hit_limits_exceeded]);
            }
        }
        return response()->json(['itr_submit_otp' => $itr_submit_otp, 'statusCode' => $statusCode, 'hit_limits_exceeded' => $hit_limits_exceeded]);
    }




    public function itr_forget_password(Request $request)
    {
        $user = User::where('access_token', $request->header('AccessToken'))->first();
        $statusCode = null;
        $itr_forget_password = null;
        $hit_limits_exceeded = 0;


        $client = new Client();
        $headers = [
            'Authorization' => $this->tokenitr,
            'Accept' => 'application/json',
        ];

        $body = [
            'client_id' => $request->client_id,
            'password' => $request->password
        ];
        if ($user->scheme_type != 'demo') {
            if ($user->role_id == 1) {
                $apiamster = ApiMaster::where('api_slug', 'itrenterclientid')->first();
                if ($apiamster)
                    $api_id = $apiamster->id;
            }

            try {
                $res = $client->post('https://sandbox.aadhaarkyc.io/api/v1/itr/forget-password', ['headers' => $headers, 'json' => $body]);
                $itr_forget_password = json_decode($res->getBody(), true);
                if ($user->role_id == 1) {
                    if ($apiamster) {
                        $updateHitCount = SchemeMaster::where('user_id', Auth()->user()->id)->where('api_id', $api_id)->first();
                        $addHitCount = new HitCountMaster;
                        $addHitCount->user_id = Auth()->user()->id;
                        $addHitCount->api_id = $api_id;
                        $addHitCount->scheme_price = $updateHitCount->scheme_price;
                        $addHitCount->hit_year_month = date('Y-m');
                        $addHitCount->hit_count = 1;
                        $addHitCount->save();

                        $remark = 'ITR Forget Password Service Debited ' . $updateHitCount->scheme_price . ' Successfully';
                        $this->update_transaction($api_id, $updateHitCount->scheme_price, $remark);
                        $this->update_wallet_balance($updateHitCount->scheme_price);
                    }
                }
                $statusCode = 200;
            } catch (BadResponseException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
            }
        } else {



            $scheme_type = SchemeTypeMaster::where('id', $user->scheme_type_id)->first();
            $hit_count_remaining = $scheme_type->hit_limits - $user->scheme_hit_count;
            if ($hit_count_remaining > 0) {
                try {
                    $res = $client->post('https://sandbox.aadhaarkyc.io/api/v1/itr/forget-password', ['headers' => $headers, 'json' => $body]);
                    $itr_initiate = json_decode($res->getBody(), true);
                    $user = User::where('id', $user->id)->first();
                    $user->scheme_hit_count = $user->scheme_hit_count + 1;
                    $user->save();
                    $statusCode = 200;
                } catch (BadResponseException $e) {
                    $statusCode = $e->getResponse()->getStatusCode();
                }
            } else {
                $hit_limits_exceeded = 1;
                return response()->json(['itr_forget_password' => $itr_forget_password, 'statusCode' => $statusCode, 'hit_limits_exceeded' => $hit_limits_exceeded]);
            }
        }
        return response()->json(['itr_forget_password' => $itr_forget_password, 'statusCode' => $statusCode, 'hit_limits_exceeded' => $hit_limits_exceeded]);
    }

}
