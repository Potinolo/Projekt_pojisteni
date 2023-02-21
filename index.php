<?php
	// Autoloader
	function nactiTridu($trida) : void
	{
            require("./$trida.php");
	}
        
        //Registrace autoloaderu
	spl_autoload_register("nactiTridu");
        
        //Připojení k databázi, instanci nevytváříme, protože funkce je statická
	Databaze::pripoj('localhost', 'root', '', 'evidence_pojisteni');
        //Vytvoření instance Zobrazení
	$Zobrazeni = new Zobrazeni();
        //Vytvoření instance Vlozeni
        $Vlozeni = new Vlozeni();

	// Zpracování odeslaného formuláře
	if ($_POST)
	{       //Zavolá funkci pro vložení dat do databáze a předá jí proměnné
		$Vlozeni->pridejPojistence($_POST['jmeno'], $_POST['prijmeni'], $_POST['telefon'], $_POST['vek']);
                //Po vložení dat do databáze přesměruje opět na stejnou stránku
		header('Location: index.php'); // Přesměrování
	}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexboxgrid/6.3.1/flexboxgrid.min.css" type="text/css" />
        <link rel="stylesheet" href="./styl.css" type="text/css">
        <title>Evidence pojištění</title>
    </head>
    <body>
       <div class="container">
        <div class="one">Evidence pojištěných osob</div>
        <div class="two"><a href="O aplikaci.html">O aplikaci</a></div>
        <div class="three"><a href="index.php">Pojištěnci</a></div>
        <div></div>
      </div>
        
        <div class="tabulka">
        <?php
        $Zobrazeni->vypis();
        ?>
        </div>
       <h2>Vložení nového pojištěnce</h2>
    <div class="scrollable_table">
    <form method="post">
         <table class="vlozeni">
        <tr>
            <td>
        <label for="jmeno">Jméno</label>  
            </td>  
            <td> 
        <input name="jmeno" type="text" id="jmeno" > 
         </td>  
        <td>
        <label for="prijmeni">Příjmení</label>
        </td>
        <td>
        <input name="prijmeni" type="text" id="prijmeni" >
        </td>
    </tr>
    <tr>
        <td>
     <label for="telefon">Telefonní číslo</label>
    </td>
    <td>
     <input name="telefon" type="text" id="telefon">
    </td>
     <td>
     <label for="vek">Věk</label>
    </td>
     <td>
     <input name="vek" type="number" id="vek"><br>
    </td>
    </tr>
    </table>
     <input class="tlacitko" type="submit" name="Odeslat" id="odeslat">
     </form>
    </div>
    </body>
</html>
