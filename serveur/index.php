<?php 
header('Access-Control-Allow-Origin: *');
include_once 'ws/rapportsservice.php';

//Variable qui va définir si on est dans le cas d'un ajout et s'il faut ou non, afficher le json ($return)
$ajoutBdd = true;

$RapportsService = new RapportsService;

//Connexion
if (isset($_GET['login'])) {
	$l = urldecode($_GET['login']);
	$VisiteursJson = $RapportsService->GetObjetUnVisiteur($l);
}

else{
	$VisiteursJson = $RapportsService->GetObjetTousLesVisiteurs();
}


//Medecins
if (isset($_GET['noms'])) {
	$m = urldecode($_GET['noms']);
	$VisiteursJson = $RapportsService->GetObjetLesMedecins($m);
}
else if(isset($_GET['id'])){
	$m = urldecode($_GET['id']);
	$VisiteursJson = $RapportsService->GetObjetLeMedecin($m);
}
else if(isset($_GET['id2'])) {
	$id2 = $_GET['id2'];
	$adresse = $_GET['adresse'];
	$tel = $_GET['tel'];
	$speComplementaire = $_GET['speComplementaire'];

	$VisiteursJson = $RapportsService->UpdateObjetLeMedecin($id2, $adresse, $tel, $speComplementaire);
}
else if (isset($_GET['idRapport'])) {
	$r = urldecode($_GET['idRapport']);
	$VisiteursJson = $RapportsService->GetObjetUnRapportMedecin($r);
}


//Compte rendus ajouter rapport
if (isset($_GET['medecin'])) {
	$l = $_GET['medecin'];
	$ajoutBdd = false;
	$return = $RapportsService->GetObjetUnMedecinRecherche($l);
}

else if (isset($_GET['medicament'])) {
	$l = urldecode($_GET['medicament']);
	$ajoutBdd = false;
	$return = $RapportsService->GetObjetUnMedicament($l);
}

else if (isset($_GET['addRapport'])) {
	$date = urldecode($_GET['date']);
	$motif = urldecode($_GET['motif']);
	$bilan = urldecode($_GET['bilan']);
	$idVisiteur = urldecode($_GET['idVisiteur']);
	$idMedecin = urldecode($_GET['idMedecin']);
	$ajoutBdd = false;
	$return = $RapportsService->GetAddRapport($date, $motif, $bilan, $idVisiteur, $idMedecin);
}

else if (isset($_GET['addOffrir'])) {
	$idRapport2 = urldecode($_GET['idRapport2']);
	$idMedicament = urldecode($_GET['idMedicament']);
	$quantite = urldecode($_GET['quantite']);
	$ajoutBdd = false;
	$return = $RapportsService->GetAddOffrir($idRapport2, $idMedicament, $quantite);
}

else if (isset($_GET['id5'])) { 
	$dateVisite = urldecode($_GET['dateVisite']);
	$id5= urldecode($_GET['id5']);
	$VisiteursJson = $RapportsService->GetObjetLesRapports($dateVisite, $id5);
}
else if (isset($_GET['id6'])){
	$id6 = urldecode($_GET['id6']);
	$VisiteursJson = $RapportsService->GetObjetLeRapport($id6);
}

else if (isset($_GET['id3'])){
	$id3 = urldecode($_GET['id3']);
	$VisiteursJson = $RapportsService->GetObjetMaxRapport($id3);
}

else if(isset($_GET['idRapport3'])){
	$idRapport3 = urldecode($_GET['idRapport3']);
	$date = urldecode($_GET['date']);
	$motif = urldecode($_GET['motif']);
	$bilan = urldecode($_GET['bilan']);
	$idMedecin = urldecode($_GET['idMedecin']);

	$VisiteursJson = $RapportsService->UpdateObjetLeRapport($idRapport3,$date,$motif,$bilan,$idMedecin);
}


//Médicaments
if (isset($_GET['nomMed'])) {
	$m = urldecode($_GET['nomMed']);
	$VisiteursJson = $RapportsService->GetObjetLesMedicaments($m);
}
else if(isset($_GET['idMed'])){
	$m = urldecode($_GET['idMed']);
	$VisiteursJson = $RapportsService->GetObjetLeMedicamentRecherche($m);
}
else if(isset($_GET['idMed2'])) {
	$idMed2 = $_GET['idMed2'];
	$composition = $_GET['composition'];
	$effets = $_GET['effets'];
	$contreIndications = $_GET['contreIndications'];

	$VisiteursJson = $RapportsService->UpdateObjetLeMedicament($idMed2, $composition, $effets, $contreIndications);
}
else if (isset($_GET['idFam'])) {
	$f = urldecode($_GET['idFam']);
	$VisiteursJson = $RapportsService->GetObjetFamilleMedicament($f);
}

if(!$ajoutBdd) {
	echo $return;
}

echo $VisiteursJson;

?>