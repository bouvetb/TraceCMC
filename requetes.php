<?php
include 'config.php' ;
$name ="tdelille";
if(array_key_exists("user",$_POST) && $_POST["user"] != null){
	$name = $_POST["user"];
}

$nbmessage = array();
$test = array();
$conn = new mysqli($server, $user, $pass,$db);
mysqli_set_charset($conn,'utf8');
$querry = "SELECT SUM(nb),MONTH(t2.Date) FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE `Titre`= 'Poster un nouveau message' OR (`Titre`= 'Répondre à un message')AND `Utilisateur` ='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date GROUP BY MONTH(t2.Date)";
$result = $conn->query($querry);
while ($row = $result -> fetch_row()){
	$nbmessage[] = intval($row[0]);
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

$queryReponseMois = "SELECT SUM(nb),MONTH(t2.Date) FROM(SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE (`Titre`= 'Répondre à un message') AND `Utilisateur`='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date GROUP BY MONTH(t2.Date) ";
$resultReponseMois=$conn->query($queryReponseMois);
$nbreponse=array();
$datereponse=array();
while($rowReponse=$resultReponseMois -> fetch_row()){
	$nbreponse[]=intval($rowReponse[0]);
	$datereponse[]=$rowReponse[1];
}

$queryConsultationMois = "SELECT SUM(nb),MONTH(t2.Date) FROM(SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE (`Titre`= 'Afficher une structure (cours/forum)') AND `Utilisateur`='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date GROUP BY MONTH(t2.Date) ";
$resultConsultationMois=$conn->query($queryConsultationMois);
$nbConsult=array();
$dateConsult=array();
while($rowConsult=$resultConsultationMois -> fetch_row()){
	$nbConsult[]=intval($rowConsult[0]);
	$dateConsult[]=$rowConsult[1];
}

$queryfev = "SELECT nb,t2.Date FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE (`Titre`= 'Poster un nouveau message' OR `Titre`= 'Répondre à un message') AND `Utilisateur` ='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-02-01' AND '2009-02-31'";
$querymars = "SELECT nb,t2.Date FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE (`Titre`= 'Poster un nouveau message' OR `Titre`= 'Répondre à un message') AND `Utilisateur` ='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-03-01' AND '2009-03-31'";
$queryavr = "SELECT nb,t2.Date FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE (`Titre`= 'Poster un nouveau message' OR `Titre`= 'Répondre à un message') AND `Utilisateur` ='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-04-01' AND '2009-04-31'";
$querymai = "SELECT nb,t2.Date FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE (`Titre`= 'Poster un nouveau message' OR `Titre`= 'Répondre à un message') AND `Utilisateur` ='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-05-01' AND '2009-05-31'";

$nbmessfev = array();;
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

$querycofev = "SELECT nb,t2.Date FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE `Titre`= 'Connexion' AND `Utilisateur` ='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-02-01' AND '2009-02-31'";
$querycomars = "SELECT nb,t2.Date FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE `Titre`= 'Connexion' AND `Utilisateur` ='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-03-01' AND '2009-03-31'";
$querycoavr = "SELECT nb,t2.Date FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE `Titre`= 'Connexion' AND `Utilisateur` ='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-04-01' AND '2009-04-31'";
$querycomai = "SELECT nb,t2.Date FROM (SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE `Titre`= 'Connexion' AND `Utilisateur` ='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-05-01' AND '2009-05-31'";

$nbcofev = array();
$datecofev = array();
$nbcomars = array();
$datecomars= array();
$nbcoavr = array();
$datecoavr = array();
$nbcomai = array();
$datecomai = array();

$resulcofev = $conn->query($querycofev);
while($rowcofev = $resulcofev -> fetch_row()){
	$nbcofev[] = intval($rowcofev[0]);
	$datecofev[] = $rowcofev[1];
}
$resulcomars = $conn->query($querycomars);
while($rowcomars = $resulcomars -> fetch_row()){
	$nbcomars[] = intval($rowcomars[0]);
	$datecomars[] = $rowcomars[1];
}
$resulcoavr = $conn->query($querycoavr);
while($rowcoavr = $resulcoavr -> fetch_row()){
	$nbcoavr[] = intval($rowcoavr[0]);
	$datecoavr[] = $rowcoavr[1];
}
$resulcomai = $conn->query($querycomai);
while($rowcomai = $resulcomai -> fetch_row()){
	$nbcomai[] = intval($rowcomai[0]);
	$datecomai[] = $rowcomai[1];
}
$cofevrier = array();
$comars = array();
$coavril = array();
$comai = array();

$cofevrier[0] = $nbcofev;
$cofevrier[1] = $datecofev;

$comars[0] = $nbcomars;
$comars[1] = $datecomars;

$coavril[0] = $nbcoavr;
$coavril[1] = $datecoavr;

$comai[0] = $nbcomai;
$comai[1] = $datecomai;

$comois = array();
$comois[] = $cofevrier;
$comois[] = $comars;
$comois[] = $coavril;
$comois[] = $comai;

$queryConsultFeb = "SELECT nb,t2.Date FROM(SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE (`Titre`= 'Afficher une structure (cours/forum)') AND `Utilisateur`='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-02-01' AND '2009-02-31'";
$queryConsultMars = "SELECT nb,t2.Date FROM(SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE (`Titre`= 'Afficher une structure (cours/forum)') AND `Utilisateur`='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition)as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-03-01' AND '2009-03-31'";
$queryConsultAvril = "SELECT nb,t2.Date FROM(SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE (`Titre`= 'Afficher une structure (cours/forum)') AND `Utilisateur`='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-04-01' AND '2009-04-31'";
$queryConsultMai = "SELECT nb,t2.Date FROM(SELECT Count(IDTran) as nb,`Date` FROM `transition` WHERE (`Titre`= 'Afficher une structure (cours/forum)') AND `Utilisateur`='".$name."' GROUP BY Date) as t1 Right outer Join (SELECT DISTINCT Date FROM transition) as t2 on t1.Date = t2.Date WHERE t2.date BETWEEN '2009-05-01' AND '2009-05-31'";

$resultConsultFeb=$conn->query($queryConsultFeb);
$nbConsultFeb=array();
$dateConsultFeb=array();
while($rowConsultFeb=$resultConsultFeb -> fetch_row()){
	$nbConsultFeb[]=intval($rowConsultFeb[0]);
	$dateConsultFeb[]=$rowConsultFeb[1];
}
$resultConsultMars=$conn->query($queryConsultMars);
$nbConsultMars=array();
$dateConsultMars=array();
while($rowConsultMars=$resultConsultMars -> fetch_row()){
	$nbConsultMars[]=intval($rowConsultMars[0]);
	$dateConsultMars[]=$rowConsultMars[1];
}
$resultConsultAvril=$conn->query($queryConsultAvril);
$nbConsultAvril=array();
$dateConsultAvril=array();
while($rowConsultAvril=$resultConsultAvril -> fetch_row()){
	$nbConsultAvril[]=intval($rowConsultAvril[0]);
	$dateConsultAvril[]=$rowConsultAvril[1];
}
$resultConsultMai=$conn->query($queryConsultMai);
$nbConsultMai=array();
$dateConsultMai=array();
while($rowConsultMai=$resultConsultMai -> fetch_row()){
	$nbConsultMai[]=intval($rowConsultMai[0]);
	$dateConsultMai[]=$rowConsultMai[1];
}

$consultfevrier = array();
$consultmars = array();
$consultavril = array();
$consultmai = array();

$consultfevrier[0] = $nbConsultFeb;
$consultfevrier[1] = $dateConsultFeb;

$consultmars[0] = $nbConsultMars;
$consultmars[1] = $dateConsultMars;

$consultavril[0] = $nbConsultAvril;
$consultavril[1] = $dateConsultAvril;

$consultmai[0] = $nbConsultMai;
$consultmai[1] = $dateConsultMai;

$consultmois = array();
$consultmois[] = $consultfevrier;
$consultmois[] = $consultmars;
$consultmois[] = $consultavril;
$consultmois[] = $consultmai;


?>