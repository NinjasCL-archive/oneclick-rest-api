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

include_once __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/helpers.php';
include_once __DIR__ . '/constants.php';

use Freshwork\Transbank\CertificationBagFactory;
use Freshwork\Transbank\TransbankServiceFactory;
use Freshwork\Transbank\Log\LoggerFactory;
use Freshwork\Transbank\Log\TransbankCertificationLogger;

use NinjasCL\Helpers;

class OneClick 
{
  private static $oneclick;

  public static function instance()
  {
    if(empty(self::$oneclick))
    {
       LoggerFactory::setLogger(
         new TransbankCertificationLogger(
              Helpers::logPath()
           )
       );

       $certificationBag = CertificationBagFactory::integrationOneClick();
          
      if(kNJSCurrentEnv == kNJSEnvProduction)
        {
            $certificationBag = 
            CertificationBagFactory::production(
                Helpers::key(),
                Helpers::crt()
            );
        }

       self::$oneclick = TransbankServiceFactory::oneclick($certificationBag);
    }

    return self::$oneclick;
  }
}