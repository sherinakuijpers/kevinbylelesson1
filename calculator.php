<?php //calculator++

$num1 = 0;      // variabele $num1 is 0 als niks is ingevuld
$num2 = 0;      // variabele $num2 is 0 als niks is ingevuld
$totaal = 0;    // $totaal is 0 als niks is ingevuld
$keuze = "";    // verschillende opties bij $keuze die tussen "" staan
$error = "";    // variabele $error geeft de error die tussen "" staat

if(isset($_POST["submit"]))  // als er op "submit" (bereken) word gedrukt gaat hij de onderstaande code uitvoeren
{
    $num1 = $_POST["num1"];  // hernoemen van de variabele $num1, $num2 en $keuze
    $num2 = $_POST["num2"];  
    $keuze = $_POST["operator"];  
    if(is_numeric($num1) && is_numeric($num2))   // als $num1 (invoerveld 1) en $num2 (invoerveld 2) getallen zijn dan moet hij het onderstaande uitvoeren
    {
        if($keuze == "plus")     // als de keuze plus is..
        {
            $totaal = $num1 + $num2;   // het totaal word $num1(invoerveld 1) en $num2 (invoerveld 2) bij elkaar opgeteld
        }

        if($keuze == "min")     // als de keuze min is..
        {
            $totaal = $num1 - $num2;  // het totaal word $num1(invoerveld 1) - $num2 (invoerveld 2)
        }

        if($keuze == "delen")   // als de keuze delen is..
        {
           if($num2 ==0){
			   $error = "Kan niet delen door 0";   // als er bij $num2 (invoerveld 2) een 0 is ingevoerd komt er een error met "kan niet delen door 0" omdat je iets niet kan delen door 0
		   }
		   else {
				$totaal = $num1 / $num2;    // anders word het totaal:  $num1 (invoerveld 1) gedeeld door $num2 (invoerveld 2)
		   }
        }

        if($keuze == "vermenigvuldigen")    // als de keuze vermenigvuldigen is..
        {
            $totaal = $num1 * $num2;    // het totaal word $num1 (invoerveld 1) vermenigvuldigd met $num2 (invoerveld 2)
        }

        if($keuze == "machtsverheffen")   // als de keuze machtsverheffen is..
        {
            $totaal = pow ($num1, $num2);    // het totaal word $num1 (invoerveld 1) tot de macht van $num2 (invoerveld 2)
     	}
	}
 
    else if (is_numeric($num1) && $num2 == "")    // als $num1 (invoerveld 1) een getal is en $num2 (invoerveld 2) is leeg, moet hij het onderstaande uitvoeren
    {
		if($keuze == "worteltrekken")     // als de keuze worteltrekken is... 
        {	                       
			$totaal = sqrt ($num1);          // het totaal word de wortel van $num1 (invoerveld 1)
		}
	
    	else if($keuze == "mijl naar km")     // als de keuze mijl naar km is...
    	{
        	$totaal = $num1 * 1.609;       // het totaal word $num1 (invoerveld 1) x 1.609
    	}

    	else if($keuze == "km naar mijl")     // als de keuze km naar mijl is... 
    	{
       		$totaal = $num1 * 0.621;     // het totaal word $num1 (invoerveld 1) x 0.621
 		}
	}

	else {
        $error = "Voer alleen getallen in";  // als er iets anders dan getallen word ingevoerd, zal er een $error komen
	}

	if(isset($_POST["reset"]))  // als op de resetbutton word gedrukt, word het totaal gereset naar 0
	{
		$totaal = 0;
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">                                                               <!-- character set-->
		<meta name="description" content="Calculator with PHP">                              <!-- page description-->
		<link rel="stylesheet" type="text/css" href="MijnStyle.css">                         <!-- doorverwijzing css stylesheet-->
		<title>Calculator++</title>                                                          <!-- titel dat in het tablad komt te staan-->
	</head>
	<body>
		<div class="container">           <!-- opmaakeigenschappen van de class "container" en  "top-part" in MijnStyle.css te vinden-->
			<div class="top-part">			
			<?php
				if($error!=""){   // als er niks word ingevuld..

					echo $error;  // print de error 
				}
				else{
					echo $totaal;   // anders print het resultaat van het totaal
				}
			?>
			</div>
			<div class="bottom-part">         
				<form method = "post">
					<ul>
						<li>
							<label>Getal 1:</label>      
							<input type = "text" name = "num1" placeholder = "invoerveld 1"> <!-- gegevens van het invulveld 1 -->
						</li>
						<li>
							<label>Operator</label>
							<select name = "operator"> <!-- verschillende opties van de operator -->
								<option value = "plus">plus</option>
								<option value = "min">min</option>
								<option value = "delen">delen</option>
								<option value = "vermenigvuldigen">vermenigvuldigen</option>
								<option value = "machtsverheffen">machtsverheffen</option>
								<option value = "worteltrekken">worteltrekken</option>
								<option value = "mijl naar km">mijl naar km</option>
								<option value = "km naar mijl">km naar mijl</option>
							</select>
						</li>
						<li>
							<label>Getal 2:</label>
							<input type = "text" name = "num2" placeholder = "invoerveld 2">  <!-- gegevens van het invulveld 2 -->
						</li>
						<li>
							<label>Decimalen:</label>   <!-- gegevens voor de decimalen slider -->
							<input id="decimals-input" class="input-numbers" type="text" name="SliderDecimals" placeholder="Hoeveel decimalen?" />
							<input id="decimals-slider" class="range-slider" type="range" min="1" max="10" step="1" value="1"> 
						</li>
						<li>
							<input name = "submit" type = "submit" value = "bereken">  <!-- gegevens van de "bereken" en  "reset" button --> 
							<input name = "reset" type = "submit" value = "reset">
						</li>
					</ul>
				</form>
			</div>
		</div>
		<script type="text/javascript">  
		
		let decimalSlider = document.getElementById("decimals-slider");
		let decimalsInput =  document.getElementById("decimals-input");

		decimalSlider.oninput = function()
		{
			decimalsInput.value = this.value;
		}
		</script>
	</body>
</html>
