<?php

require_once './modeles/produits.php';

class ControleurProduit {

    /***
     * Fonction permettant de récupérer l'ensemble des produits et de les afficher sous forme de tableau
     */
    function afficherTableau() {
        $produits = modele_produit::ObtenirTous();
        require './vues/produits.php';
    }
    
    /***
     * Fonction permettant de récupérer un produit à partir de l'identifiant (id) 
     * inscrit dans l'URL, et l'affiche sous forme de carte
     */
    function afficherFiche() {
        if(isset($_GET["id"])) {
            $produit = modele_produit::ObtenirUn($_GET["id"]);
            if($produit) {  // ou if($produit != null)
                require './vues/produit.php';
            } else {
                $erreur = "Aucun produit trouvé";
                require './vues/erreur.php';
            }
        } else {
            $erreur = "L'identifiant (id) du produit à afficher est manquant dans l'url";
            require './vues/erreur.php';
        }
    }

    /***
     * Fonction permettant de récupérer un produit à partir de l'identifiant (id) 
     * inscrit dans l'URL, et l'affiche dans un formulaire pour édition
     */
    function afficherFormulaireEdition(){
        if(isset($_GET["id"])) {
            $produit = modele_produit::ObtenirUn($_GET["id"]);
            if($produit) {  // ou if($produit != null)
                require './vues/produits/formulaireEdition.php';
            } else {
                $erreur = "Aucun produit trouvé";
                require './vues/erreur.php';
            }
        } else {
            $erreur = "L'identifiant (id) du produit à afficher est manquant dans l'url";
            require './vues/erreur.php';
        }
    }

    /***
     * Fonction permettant de récupérer un produit à partir de l'identifiant (id) 
     * inscrit dans l'URL, et l'affiche dans un formulaire pour suppression
     */
    function afficherFormulaireSuppression(){
        if(isset($_GET["id"])) {
            $produit = modele_produit::ObtenirUn($_GET["id"]);
            if($produit) {  // ou if($produit != null)
                require './vues/produits/formulaireSuppression.php';
            }
        } else {
            $erreur = "L'identifiant (id) du produit à afficher est manquant dans l'url";
            require './vues/erreur.php';
        }
    }

    /***
* Fonction permettant de récupérer l'ensemble des produits et de les afficher au format JSON
*/
function afficherJSON() {
    $produits = modele_produit::ObtenirTous();
    echo json_encode($produits);
}


/***
 * Fonction permettant de récupérer l'ensemble des produits et de les afficher au format JSON
 */
function afficherFicheJSON() {
    $produit = modele_produit::ObtenirUn($_GET['id']);
    echo json_encode($produit);
    
}

/***
 * Fonction permettant d'ajouter un produit reçu au format JSON
 */
function ajouterJSON($data) {
    $resultat = new stdClass();
    if(isset($data['id']) && isset($data['nom']) && isset($data['description']) && isset($data['prix']) && isset($data['qteStock']) && isset($data['couleur']) && isset($data['taille'])) {
        $resultat->message = modele_produit::ajouter( $data['nom'], $data['description'], $data['prix'], $data['qteStock'], $data['couleur'], $data['taille']);
    } else {
        $resultat->message = "Impossible d'ajouter un produit. Des informations sont manquantes";
    }
    echo json_encode($resultat);
}


/***
 * Fonction permettant de modifier un produit reçu au format JSON
 */
function modifierJSON($data) {
    $resultat = new stdClass();
    if(isset($_GET['id']) && isset($data['nom']) && isset($data['description']) && isset($data['prix']) && isset($data['qteStock']) && isset($data['couleur']) && isset($data['taille'])) {
        $resultat->message = modele_produit::modifier($_GET['id'], $data['id'], $data['nom'], $data['description'], $data['prix'], $data['qteStock'], $data['couleur'], $data['taille']); 
    } else {
        $resultat->message = "Impossible de modifier le produit. Des informations sont manquantes";
        require './vues/erreur.php';
    }
    echo json_encode($resultat);
}



/***
 * Fonction permettant de supprimer un produit au format JSON
 */
function supprimerJSON($id) {
    $resultat = new stdClass();
    $resultat->message = modele_produit::supprimer($_GET['id']);
    echo json_encode($resultat);
}




}

?>