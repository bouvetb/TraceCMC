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
		var tab_ms_moi = <?php echo json_encode($msmois);?>


	</script>
	<script type="text/javascript" src="./MesScripts.js"></script>
	
</HEAD>

<BODY>
	<div id="header">
			<H1>Indicateurs traces CMC</H1>
			<a>Indicateur 1</a>
			<a>Indicateur 2 </a>
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
			?>
			<button>Valider</button>
	</form>
	</div>
	<div id=container></div>
	<div style="float: center;">
	
	<select onchange="graph(value);">
		<option value = 0>Fevrier</option>
		<option value = 1>Mars</option>
		<option value = 2>Avril</option>
		<option value = 3>Mai</option>
	</select>
	<div id=container3></div>
	</div>
	<div id=container2></div>
	
	
	<div id=container4></div>
	<script type="text/javascript" src="./chart1.js"></script>
	<script type="text/javascript" src="./chart2.js"></script>
	<script type="text/javascript" src="./chart3.js"></script>
</BODY>
</HTML>
