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


namespace Application\Helper;

class TimeSince
{
	/**
	 * Returns the difference in time with a casual phrase.
	 *
	 * @param integer $older_date (Required) The older date, in milliseconds, to compare against.
	 * @param integer $newer_date (Optional) The newer date, in milliseconds, to compare against. The default value is the current time.
	 * @return string A casual phrase describing the time difference.
	 */
	public function __invoke($older_date, $newer_date = false)
	{
		// array of time period chunks
		$chunks = array(
			array(60 * 60 * 24 * 365 , 'year'),
			array(60 * 60 * 24 * 30 , 'month'),
			array(60 * 60 * 24 * 7, 'week'),
			array(60 * 60 * 24 , 'day'),
			array(60 * 60 , 'hour'),
			array(60 , 'minute'),
		);

		// $newer_date will equal false if we want to know the time elapsed between a date and the current time
		// $newer_date will have a value if we want to work out time elapsed between two known dates
		$newer_date = ($newer_date == false) ? time() : $newer_date;

		// difference in seconds
		$since = $newer_date - $older_date;

		// step one: the first chunk
		for ($i = 0, $j = count($chunks); $i < $j; $i++)
		{
			$seconds = $chunks[$i][0];
			$name = $chunks[$i][1];

			// finding the biggest chunk (if the chunk fits, break)
			if (($count = floor($since / $seconds)) != 0)
			{
				break;
			}
		}

		// set output var
		switch ($name)
		{
			case 'minute':
				if ($count == 0)
				{
					$output = 'just now';
				}
				elseif ($count == 1)
				{
					$output = 'a ' . $name . ' ago';
				}
				else
				{
					$output = "$count {$name}s" . ' ago';
				}
				break;

			case 'hour':
				$output = ($count == 1) ? 'an ' . $name . ' ago' : "$count {$name}s" . ' ago';
				break;

			case 'day':
				$output = ($count == 1) ? 'yesterday' : "$count {$name}s" . ' ago';
				break;

			case 'week':
				$output = ($count == 1) ? 'last week' : "$count {$name}s" . ' ago';
				break;

			case 'month':
				$output = ($count == 1) ? 'last month' : "$count {$name}s" . ' ago';
				break;

			case 'year':
				$output = ($count == 1) ? 'last year' : "$count {$name}s" . ' ago';
				break;
		}

		return $output;
	}
}
