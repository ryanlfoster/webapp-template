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


namespace Application\View;

class Application extends \Slim_View {

	public static $onload;
	public static $header;
	public static $title;

	/**
	 * Start buffering the output.
	 *
	 * @return void
	 */
	public static function start()
	{
		ob_start();
	}

	/**
	 * Stop buffering the output.
	 *
	 * @return string The contents of the buffer.
	 */
	public static function end()
	{
		$contents = ob_get_contents();
		ob_end_clean();

		return $contents;
	}

	/**
	 * Capture the output buffer and save it to a property for re-use.
	 *
	 * @return void
	 */
	public static function endCapture($node = 'onload')
	{
		self::$$node = self::end();
	}

	/**
	 * Renders a template.
	 *
	 * @see View::render()
	 * @param string $template The template name specified in Slim::render()
	 * @return string
	 */
	public function render($template)
	{
		// Use master layout
		if (strstr($template, '.phtml'))
		{
			// Fetch the contents of the template
			self::start();
			include $this->getTemplatesDirectory() . '/partials/' . $template;
			$_YIELD_ = self::end();

			// Replace `$_YIELD_` in the master layout with our template.
			self::start();
			include $this->getTemplatesDirectory() . '/layout.phtml';
			return self::end();
		}
		// Don't use master layout
		else // .pxml
		{
			// Fetch the contents of the template
			self::start();
			include $this->getTemplatesDirectory() . '/partials/' . $template;
			return self::end();
		}
	}
}
