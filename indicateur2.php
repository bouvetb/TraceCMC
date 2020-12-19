<?php 
include "test.php";
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
	<script type="text/javascript" src="./MesScripts.js"></script>
	<script type="text/javascript">
		var tab_particip = <?php echo json_encode($particip); ?>;
		var tab_nom = <?php echo json_encode($name); ?>;
		var nom = <?php echo json_encode($forum)?>;
	</script>
	
</HEAD>

<BODY>
	<div id="header">
			<H1>Indicateurs traces CMC</H1>
			<a href="./home.php">Indicateur 1</a>
			<a href="#">Indicateur 2 </a>
	</div>
	<div id="menu">
		<form method="post" action="Indicateur2.php">
			<?php
			$querry2 = "SELECT DISTINCT `Attribut` FROM `transition` WHERE `Attribut` like 'IDforum=_' OR `Attribut` like 'IDforum=__'";
			$result2 = $conn->query($querry2);
			while($r = $result2 -> fetch_row()){
				echo "<div>";
				echo "<input type='radio' id='".$r[0]."' name = 'forum' value ='".$r[0]."'/>";
				echo "<label for='".$r[0]."'>".$r[0]."</label>";
				echo "</div>";
			} 
			mysqli_close($conn);
			?>
			<button>Valider</button>
			
	</form>
	</div>
	<div style="text-align: center;">
		<div id=container ></div>
		<p>Cet indicateur indique un pourcentage de participation dans des cours. Dans les données fournies un cours est représenté sous forme d'id forum, nous n'avons pas le nom du cours. Cet indicateur est calculé suivant les différentes intéractions avec ce cours.
	<script type="text/javascript" src="./chartindicateur2.js"></script>
	</div>
	



</BODY>
</HTML>
