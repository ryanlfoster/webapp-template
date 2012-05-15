<?php
/**
 * Copyright (c) 2009-2012 [Ryan Parman](http://ryanparman.com)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * <http://www.opensource.org/licenses/mit-license.php>
 */


/********************************************************/
// REQUIRE

require_once __DIR__ . '/vendor/symfony/class-loader/Symfony/Component/ClassLoader/UniversalClassLoader.php';
require_once __DIR__ . '/vendor/symfony/class-loader/Symfony/Component/ClassLoader/ApcUniversalClassLoader.php';

use Symfony\Component\ClassLoader\ApcUniversalClassLoader,
	Symfony\Component\ClassLoader\UniversalClassLoader;


/********************************************************/
// CONSTANTS

define('APP_ROOT', __DIR__);
define('APP_DIR', __DIR__ . '/Application');
define('APP_CONFIG', APP_ROOT . '/Application/config');
define('APP_CONTROLLERS', APP_ROOT . '/Application/Controller');
define('APP_HELPERS', APP_ROOT . '/Application/Helper');
define('APP_LOGS', APP_ROOT . '/logs');
define('APP_MODELS', APP_ROOT . '/Application/Model');
define('APP_PUBLIC', APP_ROOT . '/public');
define('APP_TEMPLATES', APP_ROOT . '/Application/Template');
define('APP_VENDOR', APP_ROOT . '/vendor');


/********************************************************/
// REGISTER CLASS LOADER

// Use the best available class loader
if (extension_loaded('apc'))
{
	$loader = new ApcUniversalClassLoader('apc.prefix.');
}
else
{
	$loader = new UniversalClassLoader();
}

// Define autoloaders
$autoload_definitions = require_once APP_VENDOR . '/composer/autoload_namespaces.php';
$autoload_definitions['Application'] = APP_ROOT;

// Register namespaces with the class loader
$loader->registerNamespaces($autoload_definitions);
$loader->register();
