<?php
namespace App\Helpers;

class Equivalencias
{

	private static $urlProduccion = 'http://127.0.0.1:8000/';
	private static $urlFondo = 'http://192.168.88.53:8081/';

	public static function urlProduccion()
	{
		return self::$urlProduccion;
	}

	public static function urlFondo()
	{
		return self::$urlFondo;
	}

}
