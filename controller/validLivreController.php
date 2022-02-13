<?php
class validLivreController
{

    public function __construct()
    {
        session_start();
        error_reporting(0);
        require_once "controller/Controller.php";
        require_once "vue/vueAjoutLivre.php";
        require_once "metier/Livre.php";
        require_once "metier/LivreDB.php";
        require_once "PDO/connectionPDO.php";
        require_once "Constantes.php";


        //recuperation des valeurs des livres venant du formulaire ajoutLivre
        //livre
        $titre = $_POST['titre'] ?? null;
        $auteur = $_POST['auteur'] ?? null;
        $edition = $_POST['edition'] ?? null;
        $information = $_POST['information'] ?? null;
        //action pour update ou insert, delete, select selectall
        $operation = $_GET['operation'] ?? null;

        //l'action peut etre passé en GET si elle ne l'ai pas en POST
        if ($operation == null) {
            $operation = $_POST['operation'] ?? null;
        }
        if (Controller::auth()) {
            if ($operation == "insert") {
                try {
                    $accesLivrBDD = new LivreDB($pdo);
                    $livre = new Livre($titre, $auteur, $edition, $information);
                    $accesLivrBDD->ajout($livre);
                } catch (Exception $e) {
                    throw new Exception(Constantes::EXCEPTION_INSERT_DB_LIVR);
                }
            } else {
                //erreur on renvoit à la page d'accueil
                header('Location: accueil.php?id=' . $_SESSION["token"]);
            }
        }
    }
}
