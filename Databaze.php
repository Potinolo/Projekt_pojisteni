<?php
/**
 * Umožní propojení PHP a SQL databáze
 */
class Databaze {

	private static PDO $spojeni;
	
	private static array $nastaveni = Array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
		PDO::ATTR_EMULATE_PREPARES => false,
	);

	public static function pripoj(string $host, string $uzivatel, string $heslo, string $databaze) : PDO
	{
		if (!isset(self::$spojeni)) {
			self::$spojeni = @new PDO(
				"mysql:host=$host;dbname=$databaze",
				$uzivatel,
				$heslo,
				self::$nastaveni
			);
		}
		return self::$spojeni;
	}

	public static function dotaz(string $sql, array $parametry = array()) : PDOStatement
	{
		$dotaz = self::$spojeni->prepare($sql);
		$dotaz->execute($parametry);
		return $dotaz;
	}

}