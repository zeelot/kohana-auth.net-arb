<?php defined('SYSPATH') or die('No direct script access.');

class Arb {

	public static function create()
	{
		return new ARB_Request_Create();
	}

	public static function update()
	{
		return new ARB_Request_Update();
	}

	public static function status()
	{
		return new ARB_Request_Status();
	}

	public static function cancel()
	{
		return new ARB_Request_Cancel();
	}
}
