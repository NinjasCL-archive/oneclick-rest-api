<?php
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
include_once __DIR__ . '/header.php';

class NJSResponse
{
    public static function new($meta = [])
    {
        return (object) [
            'data' => (object) [
            ],
            '_meta' => $meta,
            'status' => NJSStatus::ok()
        ];
    }

    public static function render($response, $exit = true)
    {

        if(is_object($response) && 
          !empty($response) && 
          isset($response->status))
        {
            NJSHeader::setContentTypeJson();
            NJSStatus::set($response->status);
            
            echo json_encode($response);
            
            if($exit)
            {
                exit($response->status);
            }
        }

        throw new Exception('Response is not an Object or is not properly formatted.');
    }
}