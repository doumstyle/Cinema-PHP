<?php
require_once './inc/functions.inc.php';
require_once './inc/header.inc.php';
$title = '';
$buttonText = '';
if (isset($_GET['action']) && $_GET['action'] == 'viewAll') {
  $films = getFilms();
  $title = 'Tous les films ' . '(' . count($films) . ')';
  $buttonText = 'Voir les six derniers films';
} else {
  $films = getSixFilms();
  $title = 'Les 6 derniers films ' . '(' . count($films) . ')';
  $buttonText = 'Voir plus de films';
}

?>

<main>
  <div class="films">
    <h2 class="display-1 text-center fw-bolder mx-5"><?= $title; ?></h2> <!-- Affiche le message et le nombre de films -->


    <div class="row">
      <?php foreach ($films as $film): ?>
        <div class="col-lg-4 col-md-6 col-sm-12 col-xxl-3">
          <div class="card">
            <img src="<?= $film['image']; ?>" class="card-img-top" alt="image du film"> <!-- Affiche l'image du film -->
            <div class="card-body">
              <h3><?= $film['title']; ?></h3> <!-- Affiche le titre du film -->
              <h4><?= $film['director']; ?></h4> <!-- Affiche le réalisateur du film -->
              <p><span class="fw-bolder">Résumé : </span><?= $film['synopsis']; ?> </p>
              <!-- Affiche un résumé du film -->
              <a href="<?= RACINE_SITE; ?>showFilm.php/?action=view&id=<?= $film['id']; ?>" class="btn">Voir plus</a>
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