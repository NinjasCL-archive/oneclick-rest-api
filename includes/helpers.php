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

include_once __DIR__ . '/constants.php';

class Helpers
{
  public static function path()
  {
    return __DIR__ . '/../';
  }

  public static function certPath()
  {
    return self::path() . 'certs/';
  }

  public static function logPath()
  {
    return self::path() . 'logs/';
  }

  public static function key($name = kNJSKeyFilename, $ext = kNJSKeyExtension)
  {
    return self::certPath() . $name . $ext;
  }

  public static function crt($name = kNJSCertFilename, $ext = kNJSCertExtension)
  {
    return self::certPath() . $name . $ext;
  }

  public static function authIsValid($token)
  {
    if(self::stringIsValid($token))
    {
      return (strcmp($token, kNJSAuthToken) === 0);
    }
    
    return false;
  }

  public static function stringIsValid($string)
  {
    return (isset($string) && is_string($string) && !empty($string));
  }

  public static function paramsAreValid($params)
  {
    
    $valid = false;

    foreach($params as $key => $param)
    {
      $valid = false;
      if(self::stringIsValid($param))
      {
        $valid = true;
      } 
      else 
      {
        break;
      }
    }
    
    return $valid;
  }
}