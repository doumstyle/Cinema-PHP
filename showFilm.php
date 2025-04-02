<?php
require_once 'inc/functions.inc.php';

if (empty($_SESSION['user'])) {
  header('Location: ' . RACINE_SITE . 'auth.php');
  exit();
}


if (isset($_GET) && isset($_GET['id']) && !empty($_GET['id'])) {
  $idFilm = htmlentities((int) $_GET['id']);

  if (is_numeric($idFilm)) {
    $film = getFilmById($idFilm);

    if (!$film) {
      header("location:index.php");
    }
  } else {
    header("location:index.php");
  }
}

$film_category = getCategoryById($idFilm);





require_once 'inc/header.inc.php';
?>
<main>
  <div class="bg-dark film">
    <div class="back">
      <a href="<?= RACINE_SITE . "index.php" ?>"><i class="bi bi-arrow-left-circle-fill"></i></a>
    </div>
    <div class="row cardDetails mt-5">
      <h2 class="text-center mb-5"></h2>
      <div class="col-12 col-xl-5 row p-5">
        <img src="<?= $film['image']; ?>" class="img-fluid" alt="Affiche du film">
        <div class="col-12 mt-5">
          <form action="<?= RACINE_SITE . "store/cart.php" ?>" method="post" enctype="multipart/form-data"
            class="row justify-content-center m-auto p-5 w-75">
            <!-- Dans le formulaire d'ajout au panier, ajoutez des champs cachés pour chaque information que vous souhaitez conserver du film -->
            <input type="hidden" name="id" value="<?= $film['id']; ?>">
            <input type="hidden" name="title" value="<?= $film['title']; ?>">
            <input type="hidden" name="cover" value="<?= substr($film['image'], strlen(RACINE_SITE)); ?>">
            <input type="hidden" name="price" value="<?= $film['price']; ?>">
            <select name="quantity" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
              <?php for ($quantity = 1; $quantity < $film['stock']; $quantity++) {
                echo '<option value=' . $quantity . '>' . $quantity . '</option>';
              } ?>



            </select>
            <button class="btn btn-danger btn-lg m-auto fs-5" type="submit">Add to cart</button>
            <!-- au moment du click j'initalise une session de panier qui sera récupérer dans le fichier panier.php -->
          </form>
        </div>
      </div>
      <div class="col-md-7 p-5 detailsContent">
        <div class="container mt-5">
          <div class="row">
            <h3 class="col-4"><span>Director : </span></h3>
            <ul class="col-8">
              <li><?= html_entity_decode($film['director']); ?></li>
            </ul>
            <hr>
          </div>
          <div class="row">
            <h3 class="col-4"><span>Actors :</span></h3>
            <ul class="col-8">
              <?php
              $actors = stringToArray(html_entity_decode($film['actors']));
              foreach ($actors as $actor): ?>

                <li><?= $actor ?></li>
              <?php endforeach; ?>

            </ul>
            <hr>
          </div>


          <div class="row">
            <h3 class="col-4"><span>Age Restriction :</span></h3>
            <ul class="col-8">
              <li><?= $film['ageLimit']; ?> years+</li>
            </ul>
            <hr>
          </div>


        </div>
      </div>
      <div class="row">
        <h3 class="col-4"><span>Genre : </span></h3>
        <ul class="col-8">
          <li><?= $film_category['name']; ?></li>
        </ul>
        <hr>
      </div>
      <div class="row">
        <h3 class="col-4"><span>Runtime : </span></h3>
        <ul class="col-8">
          <li><?= $film['duration']; ?></li>
        </ul>
        <hr>
      </div>
      <div class="row">
        <h3 class="col-4"><span>Release Date:</span></h3>
        <ul class="col-8">
          <li><?= $film['date']; ?></li>
        </ul>
        <hr>
      </div>
      <div class="row">
        <h3 class="col-4"><span>Price : </span></h3>
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
          <li><?= html_entity_decode($film['synopsis']); ?></li>
        </ul>
      </div>
    </div>
  </div>
</main>

<?php require_once 'inc/footer.inc.php'; ?>