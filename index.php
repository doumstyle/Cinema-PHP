<?php
require_once './inc/functions.inc.php';
$title = '';
$buttonText = '';
$info = "";

if (isset($_GET) && !empty($_GET)) {
  if (isset($_GET['category_id'])) {
    $categoryId = htmlentities($_GET['category_id']);

    if (is_numeric($categoryId)) {
      $category = getCategoryById($categoryId);

      if (($category['category_id'] != $categoryId) || empty($categoryId)) {
        header('location: index.php');
        exit();
      } else {
        $films = getFilmsByCategory($categoryId);
        $message = "This category contains: ";

        if (!$films) {
          $info = alert("Sorry! this category does not contain any movies", "danger");
        }
      }
    } else {
      header('location: index.php');
      exit();
    }
  } elseif (isset($_GET['action']) && $_GET['action'] == 'viewAll') {
    $films = getFilms();
    $message = "All movies: ";
    $buttonText = "See last 6 movies";
  }

} else {
  $films = getFilmsByDate();
  $message = "Last movies: ";
  $buttonText = "See all movies";
}

require_once './inc/header.inc.php';
?>

<main>
  <div class="films">
    <h2 class="display-1 text-center fw-bolder mx-5"><?= $message . count($films); ?></h2>
    <!-- Affiche le message et le nombre de films -->


    <div class="row">
      <?= $info; ?>
      <!-- Affiche un message d'alerte si la catégorie ne contient pas de films -->
      <?php foreach ($films as $film): ?>

        <div class="col-lg-4 col-md-6 col-sm-12 col-xxl-3">
          <div class="card">
            <img src="<?= $film['image']; ?>" class="card-img-top" alt="image du film"> <!-- Affiche l'image du film -->
            <div class="card-body">
              <h3><?= $film['title']; ?></h3> <!-- Affiche le titre du film -->
              <h4><?= $film['director']; ?></h4> <!-- Affiche le réalisateur du film -->
              <p><span class="fw-bolder">Synopsis : </span><?= $film['synopsis']; ?> </p>
              <!-- Affiche un résumé du film -->
              <a href="<?= RACINE_SITE . 'showFilm.php?id=' . $film['id']; ?>" class="btn">See more...</a>
              <!-- Lien pour voir plus de détails -->
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="col-12 text-center">
      <?php if (isset($_GET['action']) && $_GET['action'] == 'viewAll'): ?>
        <a href="<?= RACINE_SITE; ?>index.php" class="btn p-4 fs-3"><?= $buttonText; ?></a>
      <?php else: ?>
        <a href="<?= RACINE_SITE; ?>index.php?action=viewAll" class="btn p-4 fs-3"><?= $buttonText; ?></a>
      <?php endif; ?>
      <!-- Lien pour voir plus de films -->
    </div>
  </div>
</main>








<?php require_once './inc/footer.inc.php'; ?>