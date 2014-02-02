<?php

class System_DateTime {
	public static function NowMillisecond() 	{
		list($usec, $sec) = explode(" ", microtime());
		return $sec.substr($usec, 2, 3);
	}
}
