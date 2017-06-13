<?php 
namespace NinjasCL;
/*
 * Transbank One Click Api Rest.
 *
 * Copyright (c) 2017 Camilo Castro <camilo@ninjas.cl>
 * https://github.com/NinjasCL/oneclick-rest-api
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
define('kNJSAccessEnabled', true);

require_once __DIR__ . '/../../includes/app.php';


$order = Request::input('order');
$user = Request::input('user');
$amount = Request::input('amount');

$token = Header::token();
$auth = Header::auth();

$params = [
    'user' => $user,
    'order' => $order,
    'amount' => $amount
];

$response = Errors::badRequest($params);

if(!Helpers::authIsValid($auth))
{
    $response = Errors::unauthorized($params);
    Response::render($response);
}

if( 
  Helpers::stringIsValid($order) && 
  Helpers::stringIsValid($user) && 
  Helpers::stringIsValid($amount) &&
  Helpers::stringIsValid($token)
  )
{
    try
    {
        $result =  OneClick::instance()->authorize($amount, $order, $username, $token);
        $response = Response::new($params);

        $response->data->operation = (object) [
            'code' => (string) $result->authorizationCode,
            'response' => (string) $result->responseCode,
            'transaction' => (string) $result->transactionId
            ];

        $response->data->card = (object) [
            'type' => (string) $result->creditCardType,
            'digits' => (string) $result->last4CardDigits
        ];

        $response->status = Status::ok();
    } 
    catch (Exception $e)
    {
        $response = Errors::internal($e);
    }
}

Response::render($response);