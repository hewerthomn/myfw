<?php

namespace Calendar\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Calendar\Model\LeapYear;

/**
* LeapYearController
*/
class LeapYearController
{
	
	public function indexAction(Request $request, $year)
	{
		$leapyear = new LeapYear;

		if ($leapyear->isLeapYear($year)) {
			return new Response("Yep, {$year} is a leap year!");
		}

		return new Response("Nope, {$year} is not a leap year.");
	}
}