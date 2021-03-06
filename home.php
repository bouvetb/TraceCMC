<?php 
include "requetes.php";
?>
<HTML>
<HEAD>
	<link rel="stylesheet" type="text/css" href="./MonCss.css"/>
	<script src="./code/highcharts.js"></script>
	<script src="./code/modules/series-label.js"></script>
	<script src="./code/modules/exporting.js"></script>
	<script src="./code/modules/export-data.js"></script>
	<script src="./code/modules/accessibility.js"></script>
	<script src="./ScriptFonc.js"></script>
	<script type="text/javascript">
		var tab_nbmessa = <?php echo json_encode($nbmessage)?>;
		var mtab =[];
		tab_nbmessa.forEach(element => mtab.push(parseInt(element)));
		var tab_temp = <?php echo json_encode($date) ?>;
		var tab_date = [];
		tab_temp.forEach(element => tab_date.push(intToMonth(element)));
		var nom = <?php echo json_encode($name); ?>;

		var tab_temp_nb_connex = <?php echo json_encode($nbconnex)?>;
		var tab_nb_connex = [];
		tab_temp_nb_connex.forEach(element => tab_nb_connex.push(parseInt(element)));
		var tab_temp_date_connex = <?php echo json_encode($dateconnex)?>;
		var tab_date_connex = [];
		tab_temp_date_connex.forEach(element => tab_date_connex.push(intToMonth(element)));
		var tab_ms_moi = <?php echo json_encode($msmois);?>;
		var tab_co_moi = <?php echo json_encode($comois);?>;

		var tab_temp_nbRep = <?php echo json_encode($nbreponse);?>;
		var tab_nbRep=[];
		tab_temp_nbRep.forEach(element=> tab_nbRep.push(parseInt(element)));
		var tab_tempDateRep=<?php echo json_encode($datereponse);?>;
		var tab_dateRep=[];
		tab_tempDateRep.forEach(element => tab_dateRep.push(intToMonth(element)));

		var tab_temp_nbConsult = <?php echo json_encode($nbConsult);?>;
		var tab_nbConsult=[];
		tab_temp_nbConsult.forEach(element=> tab_nbConsult.push(parseInt(element)));
		var tab_tempDateConsult=<?php echo json_encode($dateConsult);?>;
		var tab_dateConsult=[];
		tab_tempDateConsult.forEach(element => tab_dateConsult.push(intToMonth(element)));
		var tab_consultMois=<?php echo json_encode($consultmois);?>;


	</script>
	<script type="text/javascript" src="./MesScripts.js"></script>
	
</HEAD>

<BODY>
	<div id="header">
			<H1>Indicateurs traces CMC</H1>
			<a href="#">Indicateur 1</a>
			<a href="./indicateur2.php">Indicateur 2 </a>
	</div>
	<div id="menu">
		<form method="post" action="home.php">
			<?php
			$querry2 = "SELECT DISTINCT Utilisateur From transition";
			$result2 = $conn->query($querry2);
			while($r = $result2 -> fetch_row()){
				echo "<div>";
				echo "<input type='radio' id='".$r[0]."' name = 'user' value ='".$r[0]."'/>";
				echo "<label for='".$r[0]."'>".$r[0]."</label>";
				echo "</div>";
			} 
			mysqli_close($conn);
			?>
			<button>Valider</button>
	</form>
	</div>
	<div id=container></div>
	<div style="text-align: center;">
		<select onchange="graphmess(value);graphco(value);graphconsult(value);">
			<option value = 0>Fevrier</option>
			<option value = 1>Mars</option>
			<option value = 2>Avril</option>
			<option value = 3>Mai</option>
		</select>
	</div>
		
	<div style="text-align: center;">
		<div id=container3 style="display: inline-block;"></div>
		<div id=container4 style="display: inline-block;"></div>
	</div>
	<div id=container2></div>
	<div id=container5></div>


	<div style="text-align: center";>
		<div id=container6 style="display: inline-block;"></div>
		<div id=container7 style="display: inline-block;"></div>
	</div>

	<script type="text/javascript" src="./chart1.js"></script>
	<script type="text/javascript" src="./chart2.js"></script>
	<script type="text/javascript" src="./chart3.js"></script>
	<script type="text/javascript" src="./chart4.js"></script>
	<script type="text/javascript" src="./chart5.js"></script>
	<script type="text/javascript" src="./chart6.js"></script>
	<script type="text/javascript" src="./chart7.js"></script>
</BODY>
</HTML>
