<?php
require_once 'inc/functions.inc.php';
// debug($_GET);
$id = $_GET['id'];
$film = getFilmById($id);
$category = getCategoryById($id);

require_once 'inc/header.inc.php';
?>
<main>
  <div class="bg-dark film">

    <div class="back">
      <a href="<?= RACINE_SITE; ?>index.php"><i class="bi bi-arrow-left-circle-fill"></i></a>
    </div>
    <div class="row cardDetails mt-5">
      <h2 class="text-center mb-5"></h2>
      <div class="col-12 col-xl-5 row p-5">
        <img src="<?= RACINE_SITE . $film['image']; ?>" class="img-fluid" alt="Affiche du film">
        <div class="col-12 mt-5">
          <form action="boutique/panier.php" method="post" enctype="multipart/form-data"
            class="row justify-content-center m-auto p-5 w-75">
            <!-- Dans le formulaire d'ajout au panier, ajoutez des champs cachés pour chaque information que vous souhaitez conserver du film -->
            <input type="hidden" name="id" value="">
            <select name="quantity" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
              <?php for ($quantity = 0; $quantity < $film['stock']; $quantity++) {
                echo '<option value=' . $quantity . '>' . $quantity . '</option>';
              } ?>



              </select>
              <button class="btn btn-danger btn-lg m-auto fs-5" type="submit">Ajouter au panier</button>
              <!-- au moment du click j'initalise une session de panier qui sera récupérer dans le fichier panier.php -->
          </form>
        </div>
      </div>
      <div class="col-md-7 p-5 detailsContent">
        <div class="container mt-5">
          <div class="row">
            <h3 class="col-4"><span>Realisateur : </span></h3>
            <ul class="col-8">
              <li><?= $film['director']; ?></li>
            </ul>
            <hr>
          </div>
          <div class="row">
            <h3 class="col-4"><span>Acteur :</span></h3>
            <ul class="col-8">
              <?php
              $actors = explode('/', $film['actors']);
              foreach ($actors as $actor): ?>

                <li><?= $actor ?></li>
              <?php endforeach; ?>

            </ul>
            <hr>
          </div>


          <div class="row">
            <h3 class="col-4"><span>Àge limite :</span></h3>
            <ul class="col-8">
              <li><?= $film['ageLimit']; ?> ans+</li>
            </ul>
            <hr>
          </div>


        </div>
      </div>
      <div class="row">
        <h3 class="col-4"><span>Genre : </span></h3>
        <ul class="col-8">
          <li><?= $category['name']; ?></li>
        </ul>
        <hr>
      </div>
      <div class="row">
        <h3 class="col-4"><span>Durée : </span></h3>
        <ul class="col-8">
          <li><?= $film['duration']; ?></li>
        </ul>
        <hr>
      </div>
      <div class="row">
        <h3 class="col-4"><span>Date de sortie:</span></h3>
        <ul class="col-8">
          <li><?= $film['date']; ?></li>
        </ul>
        <hr>
      </div>
      <div class="row">
        <h3 class="col-4"><span>Prix : </span></h3>
        <ul class="col-8">
          <li><?= $film['price']; ?> €</li>
        </ul>
        <hr>
      </div>
      <div class="row">
        <h3 class="col-4"><span>Stock :</span> </h3>
        <ul class="col-8">
          <li><?= $film['stock']; ?></li>
        </ul>
        <hr>
      </div>
      <div class="row">

        <h3 class="col-4"><span>Synopsis :</span></h3>
        <ul class="col-8">
          <li><?= $film['synopsis']; ?></li>
        </ul>
      </div>
    </div>
  </div>
</main>