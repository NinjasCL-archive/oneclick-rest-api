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

// Do not modify
define('kNJSEnvDevelopment', 0);
define('kNJSEnvProduction', 1);


// Modify these values as needed
define('kNJSCurrentEnv', kNJSEnvDevelopment);
define('kNJSErrorReporting', 0); // E_ALL, E_ERROR, 0 (None)

// You can obtain a GUID here https://guidgenerator.com/
define('kNJSAuthToken', '_CHANGE_ME_WITH_A_GUID_');

define('kNJSKeyFilename', 'private');
define('kNJSKeyExtension', 'key');

define('kNJSCertFilename', 'certificate');
define('kNJSCertExtension', 'crt');