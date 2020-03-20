<?php 
include_once 'persistance/dialogbd.php';

class RapportsService
{
	/* Voir Tout Les Visiteurs*/
	public function GetObjetTousLesVisiteurs(){

		try{
				$mesVisiteurs = dialogbd::getTousLesVisiteurs();
				$VisiteursJson = json_encode($mesVisiteurs);
		}
		catch(PDOException $e){
	            $erreur = $e->getMessage();
	    }

	return ($VisiteursJson);
	}

	/* Voir Un Visiteur pour la connexion*/
	public function GetObjetUnVisiteur($login){

		try{
				$unVisiteur = dialogbd::getUnVisiteur($login);
				$VisiteurJson = json_encode($unVisiteur);
		}
		catch(PDOException $e){
	            $erreur = $e->getMessage();
	    }
    
	return ($VisiteurJson);
	}

	/* Voir Tout Les Médecins pour afficher ceux qui ont des lettres en commun*/
	public function GetObjetLesMedecins($noms){

		try{
				$mesMedecins = dialogbd::getLesMedecins($noms);
				$VisiteurJson = json_encode($mesMedecins);
		}
		catch(PDOException $e){
	            $erreur = $e->getMessage();
	    }
    
	return ($VisiteurJson);
	}

	/* Voir Un Médecin*/
	public function GetObjetLeMedecin($id){

		try{
				$unMedecin = dialogbd::getUnMedecin($id);
				$VisiteurJson = json_encode($unMedecin);
		}
		catch(PDOException $e){
	            $erreur = $e->getMessage();
	    }
    
	return ($VisiteurJson);
	}

	/* Mise à jour du médecin*/
	public function UpdateObjetLeMedecin($id, $adresse, $tel, $speComplementaire){

		try{
				$majMedecin = dialogbd::updateMedecin($id, $adresse, $tel, $speComplementaire);
				$VisiteurJson = json_encode($majMedecin);
		}
		catch(PDOException $e){
            $erreur = $e->getMessage();
    }
    
	return ($VisiteurJson);
	}

	/* Mise à jour du rapport*/
	public function UpdateObjetLeRapport($id, $date, $motif, $bilan, $idMedecin){

		try{
				$majRapport = dialogbd::updateRapport($id, $date, $motif, $bilan, $idMedecin);
				$VisiteurJson = json_encode($majRapport);
		}
		catch(PDOException $e){
            $erreur = $e->getMessage();
    }
    
	return ($VisiteurJson);
	}

	/* Voir Un Rapport Medecin*/
	public function GetObjetUnRapportMedecin($id){

		try{
				$unRapportMedecin = dialogbd::getUnRapportMedecin($id);
				$VisiteurJson = json_encode($unRapportMedecin);
		}
		catch(PDOException $e){
	            $erreur = $e->getMessage();
	    }
    
	return ($VisiteurJson);
	}
	// retourne les données des medecins en fonction de la chaine de caractère mis en parametre
	public function GetObjetUnMedecinRecherche($recherche){

		try{
			$unMedecin = dialogbd::getUnMedecinRecherche($recherche);
			$MedecinJson = json_encode($unMedecin);
		}
		catch(PDOException $e){
			$erreur = $e->getMessage();
		}
		
		return ($MedecinJson);
	}
	
	//retourne les medicaments en fonction du la chaine de caractere compris dans le nom commercial
	public function GetObjetUnMedicament($recherche){

		try{
			$unMedicament = dialogbd::getUnMedicament($recherche);
			$MedicamentJson = json_encode($unMedicament);
		}
		catch(PDOException $e){
			$erreur = $e->getMessage();
		}
		
		return ($MedicamentJson);
	}
	
	// Ajoute un rapport dans la bdd
	public function GetAddRapport($date, $motif, $bilan, $idVisiteur, $idMedecin){

		try{
			dialogbd::addRapport($date, $motif, $bilan, $idVisiteur, $idMedecin);
		}
		catch(PDOException $e){
			$erreur = $e->getMessage();
		}    
	}
	// Ajoute un medicament offert
	public function GetAddOffrir($idRapport, $idMedicament, $quantite){

		try{
			
			$addOffrir = dialogbd::addOffrir($idRapport, $idMedicament, $quantite);
			$OffrirJson = json_encode($addOffrir);
		}
		catch(PDOException $e){
			$erreur = $e->getMessage();
		}  

		return ($OffrirJson);  
	}
	//Retourne les id de tous les rapports
	public function GetObjetMaxRapport($id){

		try{
			$maxRapport = dialogbd::getMaxRapport($id);
			$RapportJson = json_encode($maxRapport);
		}
		catch(PDOException $e){
			$erreur = $e->getMessage();
		}
		
		return ($RapportJson);
	}
	// Retourne les rapports en fonctions de la date et l'id mis en parametre
	public function GetObjetLesRapports($dateVisite, $id){

		try{
				$mesRapports = dialogbd::getLesRapports($dateVisite, $id);
				$RapportsJson = json_encode($mesRapports);
		}
		catch(PDOException $e){
				$erreur = $e->getMessage();
		}

		return ($RapportsJson);
	}
	// retourne un rapport en fonction de son id
	public function GetObjetLeRapport($id){

		try{
				$monRapport = dialogbd::getLeRapport($id);
				$RapportsJson = json_encode($monRapport);
		}
		catch(PDOException $e){
				$erreur = $e->getMessage();
		}

		return ($RapportsJson);
	}

	/* Voir Tout Les Médecins pour afficher ceux qui ont des lettres en commun*/
	public function GetObjetLesMedicaments($noms){

		try{
				$mesMedicamants = dialogbd::getLesMedicaments($noms);
				$VisiteurJson = json_encode($mesMedicamants);
		}
		catch(PDOException $e){
	            $erreur = $e->getMessage();
	    }
    
	return ($VisiteurJson);
	}

	/* Voir Un Médecin*/
	public function GetObjetLeMedicamentRecherche($id){

		try{
				$unMedicament = dialogbd::getUnMedicament($id);
				$VisiteurJson = json_encode($unMedicament);
		}
		catch(PDOException $e){
	            $erreur = $e->getMessage();
	    }
    
	return ($VisiteurJson);
	}

	/* Mise à jour du médicament*/
	public function UpdateObjetLeMedicament($id, $composition, $effets, $contreIndications){

		try{
				$majMedicament = dialogbd::updateMedicament($id, $composition, $effets, $contreIndications);
				$VisiteurJson = json_encode($majMedicament);
		}
		catch(PDOException $e){
            $erreur = $e->getMessage();
    }
    
	return ($VisiteurJson);
	}

	/* Voir Famille Medicamet*/
	public function GetObjetFamilleMedicament($idFam){

		try{
				$uneFamille = dialogbd::getFamilleMedicament($idFam);
				$VisiteurJson = json_encode($uneFamille);
		}
		catch(PDOException $e){
	            $erreur = $e->getMessage();
	    }
    
	return ($VisiteurJson);
	}
	
}
?>