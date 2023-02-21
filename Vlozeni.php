<?php
/**
 * Metoda pridejPojistence vkládá data do SQL databáze
 */
class Vlozeni {
     public function pridejPojistence(string $jmeno, string $prijmeni, string $telefon, int $vek)
	{
        Databaze::dotaz('INSERT INTO pojisteni (jmeno, prijmeni, telefon, vek) VALUES (?, ?, ?, ?)', array($jmeno, $prijmeni, $telefon, $vek));

	}
}
