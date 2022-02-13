<?php

$activePage = $_GET['action'];

echo '<nav class="navbar navbar-expand-md navbar-light bg-light">';
echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">';
echo '<span class="navbar-toggler-icon"></span>';
echo '</button>';
echo '<div class="collapse navbar-collapse" id="navbarNav">';
echo '<ul class="navbar-nav justify-content-center">';
echo '<li class="nav-item ">';
if ($activePage == 'accueil') {
    echo '<a class="nav-link active" href="index.php?action=accueil&id=' . $_SESSION["token"] . '">Accueil</a>';
} else {
    echo '<a class="nav-link" href="index.php?action=accueil&id=' . $_SESSION["token"] . '">Accueil</a>';
}
echo '</li>';
echo '<li class="nav-item">';
if ($activePage == 'ajoutLivre') {
    echo '<a class="nav-link active" href="index.php?action=ajoutLivre&id=' . $_SESSION["token"] . '">Ajouter un livre</a>';
} else {
    echo '<a class="nav-link" href="index.php?action=ajoutLivre&id=' . $_SESSION["token"] . '">Ajouter un livre</a>';
}
echo '</li>';
echo '<li class="nav-item">';
if ($activePage == 'allLivre') {
    echo '<a class="nav-link active" href="index.php?action=allLivre&id=' . $_SESSION["token"] . '">Liste des livres</a>';
} else {
    echo '<a class="nav-link" href="index.php?action=allLivre&id=' . $_SESSION["token"] . '">Liste des livres</a>';
}
echo '</li>';
echo '<li class="nav-item">';
if ($activePage == 'deleteLivre') {
    echo '<a class="nav-link active" href="index.php?action=deleteLivre&id=' . $_SESSION["token"] . '">Supprimer un livre</a>';
} else {
    echo '<a class="nav-link" href="index.php?action=deleteLivre&id=' . $_SESSION["token"] . '">Supprimer un livre</a>';
}
echo '</li>';
echo '<li class="nav-item">';
if ($activePage == 'moncompte') {
    echo '<a class="nav-link active" href="index.php?action=moncompte&id=' . $_SESSION["token"] . '">Mon Compte</a>';
} else {
    echo '<a class="nav-link" href="index.php?action=moncompte&id=' . $_SESSION["token"] . '">Mon Compte</a>';
}
echo '</li>';
echo '<li class="nav-item">';
echo '<a class="nav-link" href="index.php">Déconnexion</a>';
echo '</li>';
echo '</ul>';
echo '</div>';
echo '</nav>';
