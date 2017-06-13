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

class Header
{
    public static function get($key = '') 
    {
        // You should find all HTTP headers in the $_SERVER global variable prefixed
        // with HTTP_ uppercased and with dashes (-) replaced by underscores (_).
        // For instance X-Requested-With can be found in:
        // $_SERVER['HTTP_X_REQUESTED_WITH']
        // idea from http://stackoverflow.com/questions/541430/how-do-i-read-any-request-header-in-php
        $result = null;
        if (is_string($key)) 
        {
            $key = str_replace(' ', '', $key);
            $key = str_replace('-', '_', $key);
            $key = strtoupper($key);

            $key = "HTTP_$key";
            $result = (isset($_SERVER[$key]) ? $_SERVER[$key] : null);
        }

        return $result;
    }

    public static function set($header) 
    {
         if (is_string($header)) 
         {
            header($header);
         }
    }

    public static function contentType($type) 
    {
        $header = "Content-Type: {$type}";
        return $header;
    }

    public static function setContentTypeJson()
    {
        self::set(self::contentType('application/json'));
    }

    public static function auth($key = 'x-auth-token')
    {
        return self::get($key);
    }

    public static function token($key = 'x-tbk-token')
    {
        return self::get($key);
    }
}