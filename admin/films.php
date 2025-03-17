<?php
require_once "../inc/functions.inc.php";
require_once "../inc/header.inc.php";
$films = getFilms(); // Fetch all films from the database
?>

<div class="container d-flex flex-column m-auto my-5" data-bs-theme="dark">

  <h2 class="text-center fw-bolder mb-5 text-danger">List of Films</h2>
  <a href="filmForm.php" class="btn align-self-end">Add a Film</a>
  <table class="table table-dark table-bordered mt-5 ">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th rowspan="3">Cover Art</th>
        <th></th>
        <th></th>
        <th>Director</th>
        <th>Actors</th>
        <th>Age Restriction</th>
        <th>Genre</th>
        <th>Runtime</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Synopsis</th>
        <th>Release Date</th>
        <th>Delete</th>
        <th>Modify</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($films): ?>
        <?php foreach ($films as $film): ?>
          <tr>
            <td><?= $film['id']; ?></td>
            <td><?= $film['title']; ?></td>
            <td colspan="3"><img src="<?= RACINE_SITE . $film['image']; ?>" alt="Movie cover art" class="img-fluid"
                style="min-width: 200px;"></td>
            <td><?= $film['director']; ?></td>
            <td><?= $film['actors']; ?></td>
            <td><?= $film['ageLimit']; ?></td>
            <td><?php $category = getCategoryById($film['category_id']);
            echo $category['name']; ?></td>
            <td><?= $film['duration']; ?></td>
            <td><?= $film['price']; ?>€</td>
            <td><?= $film['stock']; ?></td>
            <td><?= $film['synopsis']; ?></td>
            <td><?= $film['date']; ?></td>
            <td class="text-center"><a href=""><i class="bi bi-trash3-fill"></i></a></td>
            <td class="text-center"><a href="filmForm.php?action=update&id=<?= $film['id']; ?>"><i
                  class="bi bi-pen-fill"></i></a></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="14">No films found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php require_once "../inc/footer.inc.php"; ?>