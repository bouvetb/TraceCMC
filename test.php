<?php
include 'config.php' ;
$forum = "IDForum=7";
if(array_key_exists("forum",$_POST) && $_POST["forum"] != null){
	$forum = $_POST["forum"];
}
$particip = array();
$name = array();
$conn = new mysqli($server, $user, $pass,$db);
mysqli_set_charset($conn,'utf8');

$tabnom = array();
$querry2 = "SELECT DISTINCT Utilisateur From transition";
			$result2 = $conn->query($querry2);
			while($r = $result2 -> fetch_row()){
				$tabnom[] = $r[0];
			} 
foreach ($tabnom as $nom ) {
	$querry = "SELECT `Attribut`,`Date` FROM transition  WHERE Utilisateur = '".$nom."' AND Attribut LIKE '".$forum."%' AND Titre = 'Répondre à un message'";

$attr = array();
$date = array();
$result = $conn->query($querry);
while ($r = $result -> fetch_row()) {
	$attr[] = $r[0];
	$date[] = $r[1];
}
$score = 0;
$nb = 0;
foreach ($attr as $key) {
	$nb++;
	$pos = array_search($key,$attr);
	$attrtemp = explode(',', $key);
	$idmess = explode("=", $attrtemp[2]);
	$querrytmp = "SELECT Date FROM transition WHERE Attribut like '%IDMsg=".$idmess[1]."' and Titre = 'Poster un nouveau message'";
	$rtemp = $conn->query($querrytmp);
	$vide = true;
	while($row = $rtemp -> fetch_row()){
		$vide = false;
		if($row[0] == $date[$pos]){

			$score +=3;
		}else{
			$phpdate = new DateTime( $row[0] );
			$phpdate2 = new DateTime( $date[$pos]);
			$interval = $phpdate->diff($phpdate2);
			$ecart = $interval->format("%a"); 
			if($ecart <= 3){
				$score +=2;
			}
			if($ecart <=5 & $ecart >3){
				$score +=1;
			}
			if($ecart >5){
				$score += 0;
			}
		}
	}
	if($vide == true){
		$score+=3;
	}
}
if($nb == 0){
	$nb =1;
}
$scorerepme = round($score/$nb);

$querynbconnfev = "SELECT SUM(nb) FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE `Titre`= 'Afficher une structure (cours/forum)' AND `Utilisateur` ='".$nom."' AND Attribut like '".$forum."%' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-02-01' AND '2009-02-31'";
$querynbconnmars = "SELECT SUM(nb) FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE `Titre`= 'Afficher une structure (cours/forum)' AND `Utilisateur` ='".$nom."' AND Attribut like '".$forum."%' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-03-01' AND '2009-03-31'";
$querynbconnavr = "SELECT SUM(nb) FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE `Titre`= 'Afficher une structure (cours/forum)' AND `Utilisateur` ='".$nom."' AND Attribut like '".$forum."%' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-04-01' AND '2009-04-31'";
$querynbconnmai = "SELECT SUM(nb) FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE `Titre`= 'Afficher une structure (cours/forum)' AND `Utilisateur` ='".$nom."' AND Attribut like '".$forum."%' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-05-01' AND '2009-05-31'";
$nbcotot = 0;

$resulnbcofev = $conn->query($querynbconnfev);
while($rfev = $resulnbcofev -> fetch_row()){
	$nbcotot += intval($rfev[0]);
}
$resulnbcomars = $conn->query($querynbconnmars);
while($rmars = $resulnbcomars -> fetch_row()){
	$nbcotot += intval($rmars[0]);
}
$resulnbcoavr = $conn->query($querynbconnavr);
while($ravr = $resulnbcoavr -> fetch_row()){
	$nbcotot += intval($ravr[0]);
}
$resulnbcomai = $conn->query($querynbconnmai);
while($rmai = $resulnbcomai -> fetch_row()){
	$nbcotot += intval($rmai[0]);
}
$moynbcon = round($nbcotot/4);
$scorenbcon = 1;
if($moynbcon >= 10 && $moynbcon < 30 ){
	$scorenbcon = 2;
}
if($moynbcon >= 30 && $moynbcon < 50 ){
	$scorenbcon = 3;
}
if($moynbcon >= 50){
	$scorenbcon = 4;
}

$querynbmessfev = "SELECT SUM(nb) FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE (`Titre`= 'Poster un nouveau message' OR Titre = 'Répondre à un message') AND `Utilisateur` ='".$nom."' AND Attribut like '".$forum."%' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-02-01' AND '2009-02-31'";
$querynbmessmars = "SELECT SUM(nb) FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE (`Titre`= 'Poster un nouveau message' OR Titre = 'Répondre à un message') AND `Utilisateur` ='".$nom."' AND Attribut like '".$forum."%' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-03-01' AND '2009-03-31'";
$querynbmessavr = "SELECT SUM(nb) FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE (`Titre`= 'Poster un nouveau message' OR Titre = 'Répondre à un message') AND `Utilisateur` ='".$nom."' AND Attribut like '".$forum."%' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-04-01' AND '2009-04-31'";
$querynbmessmai = "SELECT SUM(nb) FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE (`Titre`= 'Poster un nouveau message' OR Titre = 'Répondre à un message') AND `Utilisateur` ='".$nom."' AND Attribut like '".$forum."%' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-05-01' AND '2009-05-31'";
$nbmesstot =0;

$resulnbmessfev = $conn->query($querynbmessfev);
while($rfev = $resulnbmessfev -> fetch_row()){
	$nbmesstot += intval($rfev[0]);
}
$resulnbmessmars = $conn->query($querynbmessmars);
while($rmars = $resulnbmessmars -> fetch_row()){
	$nbmesstot += intval($rmars[0]);
}
$resulnbmessavr = $conn->query($querynbmessavr);
while($ravr = $resulnbmessavr -> fetch_row()){
	$nbmesstot += intval($ravr[0]);
}
$resulnbmessmai = $conn->query($querynbmessmai);
while($rmai = $resulnbmessmai -> fetch_row()){
	$nbmesstot += intval($rmai[0]);
}
$moynbmess = round($nbmesstot/4);
$scorenbmess = 1;
if($moynbmess >= 10 && $moynbmess < 20 ){
	$scorenbmess = 2;
}
if($moynbmess >= 20){
	$scorenbmess = 3;
}



$scoretot = $scorenbcon+$scorerepme + $scorenbmess;
$pourcent = round(($scoretot/10)*100);
$particip[] = $pourcent;
$name[] = $nom;

}




?>