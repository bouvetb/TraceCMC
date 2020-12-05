<?php
include 'config.php' ;
$name ="tdelille";
if(array_key_exists("user",$_POST) && $_POST["user"] != null){
	$name = $_POST["user"];
}
$nbmessage = array();
$test = array();
$conn = new mysqli($server, $user, $pass,$db);
$querry = "SELECT SUM(nb),MONTH(t2.Date) FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE `Titre`= 'Poster un nouveau message' AND `Utilisateur` ='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date GROUP BY MONTH(t2.Date)";
$result = $conn->query($querry);
while ($row = $result -> fetch_row()){
	$nbmessage[] = $row[0];
	$date[] = $row[1]; 

}
$querryConnexionMois = "SELECT SUM(nb),MONTH(t2.Date) FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE `Titre`= 'Connexion' AND `Utilisateur` ='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date GROUP BY MONTH(t2.Date) ";
$resultConnex = $conn->query($querryConnexionMois);
$nbconnex = array();
$dateconnex = array();
while($rowConnnex = $resultConnex -> fetch_row()){
	$nbconnex[] = $rowConnnex[0];
	$dateconnex[] = $rowConnnex[1];
}
$queryfev = "SELECT nb,t2.Date FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE `Titre`= 'Poster un nouveau message' AND `Utilisateur` ='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-02-01' AND '2009-02-31'";
$querymars = "SELECT nb,t2.Date FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE `Titre`= 'Poster un nouveau message' AND `Utilisateur` ='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-03-01' AND '2009-03-31'";
$queryavr = "SELECT nb,t2.Date FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE `Titre`= 'Poster un nouveau message' AND `Utilisateur` ='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-04-01' AND '2009-04-31'";
$querymai = "SELECT nb,t2.Date FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE `Titre`= 'Poster un nouveau message' AND `Utilisateur` ='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-05-01' AND '2009-05-31'";
$nbmessfev = array();
$datemessfev = array();
$nbmessmars = array();
$datemessmars= array();
$nbmessavr = array();
$datemessavr = array();
$nbmessmai = array();
$datemessmai = array();

$resulfev = $conn->query($queryfev);
while($rowfev = $resulfev -> fetch_row()){
	$nbmessfev[] = intval($rowfev[0]);
	$datemessfev[] = $rowfev[1];
}
$resulmars = $conn->query($querymars);
while($rowmars = $resulmars -> fetch_row()){
	$nbmessmars[] = intval($rowmars[0]);
	$datemessmars[] = $rowmars[1];
}
$resulavr = $conn->query($queryavr);
while($rowavr = $resulavr -> fetch_row()){
	$nbmessavr[] = intval($rowavr[0]);
	$datemessavr[] = $rowavr[1];
}
$resulmai = $conn->query($querymai);
while($rowmai = $resulmai -> fetch_row()){
	$nbmessmai[] = intval($rowmai[0]);
	$datemessmai[] = $rowmai[1];
}
$msfevrier = array();
$msmars = array();
$msavril = array();
$msmai = array();

$msfevrier[0] = $nbmessfev;
$msfevrier[1] = $datemessfev;

$msmars[0] = $nbmessmars;
$msmars[1] = $datemessmars;

$msavril[0] = $nbmessavr;
$msavril[1] = $datemessavr;

$msmai[0] = $nbmessmai;
$msmai[1] = $datemessmai;

$msmois = array();
$msmois[] = $msfevrier;
$msmois[] = $msmars;
$msmois[] = $msavril;
$msmois[] = $msmai;




?>