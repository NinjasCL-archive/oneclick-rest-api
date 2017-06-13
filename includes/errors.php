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
defined('kNJSAccessEnabled') or exit;

include_once __DIR__ . '/status.php';

use NinjasCL\Status;

class Errors
{
    public static function baseError($meta = [])
    {
        if(is_null($meta))
        {
            $meta = [];
        }

        if(!is_array($meta))
        {
            $meta = [$meta];
        }
        
        if(is_array($meta))
        {
            $meta = (object) $meta;
        }

        return (object) [
            'error' =>
               (object) [
                    'message' => 'Server Error',
                ],
            '_meta' => $meta,
            'status' => Status::internalServerError()
        ];
    }

    public static function unauthorized($meta = [])
    {
        $error = self::baseError($meta);
        $error->status = Status::unauthorized();
        $error->error->message = 'Credentials are Invalid.';

        return $error;
    }

    public static function internal($meta = [])
    {
        $error = self::baseError($meta);
        return $error;
    }

    public static function badRequest($meta = [])
    {
        $error = self::baseError($meta);
        $error->status = Status::badRequest();
        $error->error->messge = 'Params are wrong or inexistent.';

        return $error;
    }
}