<?php
require_once "../inc/functions.inc.php";
$films = getFilms(); // Fetch all films from the database

// Delete film on trash icon click
if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["id"])) {
  $id = $_GET["id"];
  deleteFilm($id);
  $_SESSION['info'] = alert("Film deleted successfully!", "success");
  header("Location:films.php");
}


require_once "../inc/header.inc.php";
?>

<div class="d-flex flex-column m-auto my-5 px-5" data-bs-theme="dark">

  <h2 class="text-center text-danger fw-bolder mb-5">List of Films</h2>
  <a href="filmForm.php" class="btn align-self-end">Add a Film</a>
  <table class="table table-bordered table-dark mt-5">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Cover Art</th>
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
            <td style="min-width: 150px;"><?= $film['title']; ?></td>
            <td><img src="<?= RACINE_SITE . $film['image']; ?>" alt="Movie cover art" class="img-fluid"
                style="min-width: 200px;"></td>
            <td><?= $film['director']; ?></td>
            <td><?= $film['actors']; ?></td>
            <td><?= $film['ageLimit']; ?></td>
            <td><?php $category = getCategoryById($film['category_id']);
            echo $category['name']; ?></td>
            <td><?= $film['duration']; ?></td>
            <td><?= $film['price']; ?>€</td>
            <td><?= $film['stock']; ?></td>
            <td class="w-50"><?= $film['synopsis']; ?></td>
            <td><?= $film['date']; ?></td>
            <td class="text-center"><a href="films.php?action=delete&id=<?= $film['id']; ?>"><i
                  class="bi bi-trash3-fill"></i></a></td>
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