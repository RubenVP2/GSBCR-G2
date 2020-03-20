<?PHP 
include_once 'connexion.php';

 class dialogbd{

    private static $instance =null;
    private $conn=null;
    
    public static function getInstance()
    {
        if ($instance == null){
            $instance = new DialogueBd();
            
        }
        return $instance;
    }
    
    /* Voir Tout Les Visiteurs*/
    public static function getTousLesVisiteurs(){
        try{
            $conn = Connexion::getConnexion();
            $sql = "select * FROM visiteur";
            $sth = $conn->prepare($sql);
            $sth->execute();
            $tabvisiteur = $sth->fetchAll(PDO::FETCH_CLASS);
            return $tabvisiteur;
      
        } catch (PDOException $e){
            $erreur = $e->getMessage();
        }
    } 

    /* Voir Un Visiteur pour la connexion*/
    public static function getUnVisiteur($login){
        try{
            $conn = Connexion::getConnexion();
            $sql = "select * FROM visiteur where login = :login";
            $sth = $conn->prepare($sql);
            $a = array("login"=>$login);
            $sth->execute($a);
            $tabvisiteur = $sth->fetchAll(PDO::FETCH_CLASS);
            return $tabvisiteur;
      
        } catch (PDOException $e){
            $erreur = $e->getMessage();
        }
    } 

    /* Voir Tout Les Médecins pour afficher ceux qui ont des lettres en commun*/
    public static function getLesMedecins($noms){
        try{
            $conn = Connexion::getConnexion();
            $sql = "SELECT * FROM medecin WHERE nom LIKE :noms '%'";
            $sth = $conn->prepare($sql);
            $a = array("noms"=>$noms);
            $sth->execute($a);
            $tabmedecin = $sth->fetchAll(PDO::FETCH_CLASS);
            return $tabmedecin;
      
        } catch (PDOException $e){
            $erreur = $e->getMessage();
        }
    } 

    /* Voir Un Médecin*/
    public static function getUnMedecin($id){
        try{
            $conn = Connexion::getConnexion();
            $sql = "SELECT * FROM medecin WHERE id = :id";
            $sth = $conn->prepare($sql);
            $a = array("id"=>$id);
            $sth->execute($a);
            $tabmedecin = $sth->fetchAll(PDO::FETCH_CLASS);
            return $tabmedecin;
      
        } catch (PDOException $e){
            $erreur = $e->getMessage();
        }
    } 

    /* Mise à jour du médecin*/
    public static function updateMedecin($id, $adresse, $tel, $speComplementaire){
        try{
            $conn = Connexion::getConnexion();
            $sql = "UPDATE medecin 
            SET adresse = :adresse, tel = :tel, specialitecomplementaire = :speComplementaire
            WHERE id = :id";
            $sth = $conn->prepare($sql);
            $a = array("id"=>$id, "adresse"=>$adresse, "tel"=>$tel, "speComplementaire"=>$speComplementaire);
            $sth->execute($a);
            $tabmedecin = $sth->fetchAll(PDO::FETCH_CLASS);
            return $tabmedecin;
      
        } catch (PDOException $e){
            $erreur = $e->getMessage();
        }
    }

    /* Voir Rapport d'un Médecin */
    public static function getUnRapportMedecin($id){
        try{
            $conn = Connexion::getConnexion();
            $sql = "SELECT * FROM medecin INNER JOIN rapport on medecin.id = rapport.idMedecin WHERE medecin.id = :id";
            $sth = $conn->prepare($sql);
            $a = array("id"=>$id);
            $sth->execute($a);
            $tabmedecin = $sth->fetchAll(PDO::FETCH_CLASS);
            return $tabmedecin;
      
        } catch (PDOException $e){
            $erreur = $e->getMessage();
        }
    }
    // retourne les données des medecins en fonction de la chaine de caractère mis en parametre
    public static function getUnMedecinRecherche($recherche){
        try{
            $conn = Connexion::getConnexion();
            $sql = "select id, nom, prenom, adresse FROM medecin where nom LIKE :recherche OR prenom LIKE :recherche OR adresse LIKE :recherche";
            $sth = $conn->prepare($sql);
            $sth->bindValue(':recherche', '%'.$recherche.'%');
            $sth->execute();
            $tabvisiteur = $sth->fetchAll(PDO::FETCH_CLASS);
            return $tabvisiteur;
      
        } catch (PDOException $e){
            $erreur = $e->getMessage();
        }
    }   
    //retourne les medicaments en fonction du la chaine de caractere compris dans le nom commercial
    public static function getUnMedicamentRecherche($recherche){
        try{
            $conn = Connexion::getConnexion();
            $sql = "select nomCommercial FROM medicament where nomCommercial LIKE :recherche";
            $sth = $conn->prepare($sql);
            $sth->bindValue(':recherche', '%'.$recherche.'%');
            $sth->execute();
            $tabvisiteur = $sth->fetchAll(PDO::FETCH_CLASS);
            return $tabvisiteur;
      
        } catch (PDOException $e){
            $erreur = $e->getMessage();
        }
    }
    // Ajoute un rapport dans la bdd
    public static function addRapport($date, $motif, $bilan, $idVisiteur, $idMedecin){
        try{
            $conn = Connexion::getConnexion();
            $sql = "INSERT INTO rapport(date, motif, bilan, idVisiteur, idMedecin) 
                    VALUES(:date, :motif, :bilan, :idVisiteur, :idMedecin);";
            $sth = $conn->prepare($sql);
            $sth->bindValue(':date', $date);
            $sth->bindValue(':motif', $motif);
            $sth->bindValue(':bilan', $bilan);
            $sth->bindValue(':idVisiteur', $idVisiteur);
            $sth->bindValue(':idMedecin', $idMedecin);
            $sth->execute();
      
        } catch (PDOException $e){
            $erreur = $e->getMessage();
        }
    } 
    // Ajoute un medicament offert
    public static function addOffrir($idRapport, $idMedicament, $quantite){
        try{
            $conn = Connexion::getConnexion();
            $sql = "INSERT INTO offrir(idRapport, idMedicament, quantite) 
                    VALUES(:idRapport, :idMedicament, :quantite);";
            $sth = $conn->prepare($sql);
            $sth->bindValue(':idRapport', $idRapport);
            $sth->bindValue(':idMedicament', $idMedicament);
            $sth->bindValue(':quantite', $quantite);
            $sth->execute();
      
        } catch (PDOException $e){
            $erreur = $e->getMessage();
        }
    } 
    //Retourne les id de tous les rapports
    public static function getMaxRapport(){
        try{
            $conn = Connexion::getConnexion();
            $sql = "SELECT id FROM rapport ORDER BY id";
            $sth = $conn->prepare($sql);
            $sth->execute();
            $tabmedecin = $sth->fetchAll(PDO::FETCH_CLASS);
            return $tabmedecin;
      
        } catch (PDOException $e){
            $erreur = $e->getMessage();
        }
    } 
    
    // Retourne les rapports en fonctions de la date et l'id mis en parametre
    public static function getLesRapports($date, $id){
        try{
            $conn = Connexion::getConnexion();
            $sql="SELECT rapport.id, nom, prenom, date, motif, bilan, idMedecin FROM medecin INNER JOIN rapport ON medecin.id = rapport.idMedecin WHERE rapport.date = :dateVisite AND rapport.idVisiteur = :id5";
            $sth = $conn->prepare($sql);
            $sth->bindValue(':dateVisite', $date);
            $sth->bindValue(':id5', $id);
            $sth->execute();
            $tabrapport = $sth->fetchAll(PDO::FETCH_CLASS);
            return $tabrapport;
        } 
        catch (PDOException $e)
        {
            $erreur = $e->getMessage();
        }
    } 
    // retourne un rapport en fonction de son id
    public static function getLeRapport($id){
        try{
            $conn = Connexion::getConnexion();
            $sql="SELECT * FROM  rapport WHERE id = :id";
            $sth = $conn->prepare($sql);
            $sth->bindValue(':id', $id);
            $sth->execute();
            $tabrapport = $sth->fetchAll(PDO::FETCH_CLASS);
            return $tabrapport;
        } 
        catch (PDOException $e)
        {
            $erreur = $e->getMessage();
        }
    } 

    /* Voir Tout Les Médicaments pour afficher ceux qui ont des lettres en commun*/
    public static function getLesMedicaments($noms){
        try{
            $conn = Connexion::getConnexion();
            $sql = "SELECT * FROM medicament WHERE id LIKE :nomMed '%'";
            $sth = $conn->prepare($sql);
            $a = array("nomMed"=>$noms);
            $sth->execute($a);
            $tabmedicament = $sth->fetchAll(PDO::FETCH_CLASS);
            return $tabmedicament;
      
        } catch (PDOException $e){
            $erreur = $e->getMessage();
        }
    } 

    /* Voir Un Médicament*/
    public static function getUnMedicament($id){
        try{
            $conn = Connexion::getConnexion();
            $sql = "SELECT * FROM medicament WHERE id = :idMed";
            $sth = $conn->prepare($sql);
            $a = array("idMed"=>$id);
            $sth->execute($a);
            $tabmedicament = $sth->fetchAll(PDO::FETCH_CLASS);
            return $tabmedicament;
      
        } catch (PDOException $e){
            $erreur = $e->getMessage();
        }
    }

    /* Mise à jour du médicament*/
    public static function updateMedicament($id, $composition, $effets, $contreIndications){
        try{
            $conn = Connexion::getConnexion();
            $sql = "UPDATE medicament 
            SET composition = :composition, effets = :effets, contreIndications = :contreIndications
            WHERE id = :id";
            $sth = $conn->prepare($sql);
            $a = array("id"=>$id, "composition"=>$composition, "effets"=>$effets, "contreIndications"=>$contreIndications);
            $sth->execute($a);
            $tabmedicament = $sth->fetchAll(PDO::FETCH_CLASS);
            return $tabmedicament;
      
        } catch (PDOException $e){
            $erreur = $e->getMessage();
        }
    }

    /* Mise à jour du rapport*/
    public static function updateRapport($id, $dates, $motif, $bilan, $idMedecin){
        try{
            $conn = Connexion::getConnexion();
            $sql = "UPDATE rapport 
            SET rapport.date = :dates, motif = :motif, bilan = :bilan, idMedecin = :idMedecin
            WHERE id = :id";
            $sth = $conn->prepare($sql);
            $a = array("id"=>$id, "dates"=>$dates, "motif"=>$motif, "bilan"=>$bilan, "idMedecin"=>$idMedecin);
            $sth->execute($a);
            $tabrapport = $sth->fetchAll(PDO::FETCH_CLASS);
            return $tabrapport;
      
        } catch (PDOException $e){
            $erreur = $e->getMessage();
        }
    }

    /* Voir La Famille Medicament*/
    public static function getFamilleMedicament($idFam){
        try{
            $conn = Connexion::getConnexion();
            $sql = "SELECT distinct(famille.id), libelle FROM famille INNER JOIN medicament ON famille.id = medicament.idFamille WHERE famille.id = :idFam";
            $sth = $conn->prepare($sql);
            $a = array("idFam"=>$idFam);
            $sth->execute($a);
            $tabfamille = $sth->fetchAll(PDO::FETCH_CLASS);
            return $tabfamille;
      
        } catch (PDOException $e){
            $erreur = $e->getMessage();
        }
    }




}







?>