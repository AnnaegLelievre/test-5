<?php
require_once "vue/Vue.php";
class vueAjoutLivre extends Vue
{
    function affiche()
    {
        include "headerLivre.html";
        include "menu.php";
?>

        <div class="covered-img">
            <div class="container ajoutlivre">

                <div id="messagee"></div>
                <div id="msg"></div>
                <form method='post' class='verif_form_livre' action='index.php?operation=insert&action=validLivre&id=' <?php $_SESSION['token'] ?> required>
                    <div class='form-group'>
                        <div class='form-row'>
                            <label class='col-md-3' for='nom'>Nom</label>
                            <input id="nom" type="text" class="form-control" name="nom" placeholder="Entrer le nom" required>
                        </div>
                        <div class='form-row'>
                            <label for='auteur'>Auteur</label>
                            <input id="auteur" type="text" class="form-control" name="auteur" placeholder="Entrer l'auteur" required>
                        </div>
                        <div class='form-row'>
                            <label for='edition'>Edition</label>
                            <input id="edition" type="text" class="form-control" name="edition" placeholder="Entrer l'édition" required>
                        </div>
                        <div class='form-row'>
                            <label for='info'>Information</label>
                            <input id="info" type="text" class="form-control" name="info" placeholder="Entrer les informations du livre">
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Ajouter</button>
                </form>

            </div>
        </div>

        <script>

        </script>
<?php


        include "footer.html";
    }
}
