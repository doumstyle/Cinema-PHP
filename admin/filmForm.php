<?php
require_once '../inc/functions.inc.php';
$info = '';
$buttonText = "Add film"; // Default button text (for adding)

if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id'])) {
  $id = $_GET['id']; // Get the film ID from the URL
  $buttonText = "Update film"; // Change the button text for update mode
}

// Check if a user is logged in AND if they are an admin.
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  // If not logged in OR not an admin, redirect to the index page.
  header("Location:" . RACINE_SITE . "index.php");
  exit;
}

// Initialize variables to hold form data (with default values)
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$director = isset($_POST['director']) ? trim($_POST['director']) : '';
$actors = isset($_POST['actors']) ? trim($_POST['actors']) : '';
$ageLimit = isset($_POST['ageLimit']) ? trim($_POST['ageLimit']) : '';
$duration = isset($_POST['duration']) ? trim($_POST['duration']) : '';
$synopsis = isset($_POST['synopsis']) ? trim($_POST['synopsis']) : '';
$date = isset($_POST['date']) ? trim($_POST['date']) : '';
$price = isset($_POST['price']) ? trim($_POST['price']) : '';
$stock = isset($_POST['stock']) ? trim($_POST['stock']) : '';
$category_id = isset($_POST['categories']) ? trim($_POST['categories']) : '';

//Check if we're in "update" mode
if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id'])) {
  $id = $_GET['id']; // Get the film ID from the URL
  $film = getFilmById($id); // Fetch the film data
  if ($film) {
    // Pre-fill the form with existing data
    $title = $film['title'];
    $director = $film['director'];
    $actors = $film['actors'];
    $ageLimit = $film['ageLimit'];
    $duration = $film['duration'];
    $synopsis = $film['synopsis'];
    $date = $film['date'];
    $price = $film['price'];
    $stock = $film['stock'];
    $category_id = $film['category_id'];
    $image = $film['image'];
  }
}

// Form submission
if (!empty($_POST)) {
  // Get form values (outside the if statement)
  $title = trim($_POST['title']);
  $director = trim($_POST['director']);
  $actors = trim($_POST['actors']);
  $ageLimit = trim($_POST['ageLimit']);
  $duration = trim($_POST['duration']);
  $synopsis = trim($_POST['synopsis']);
  $date = trim($_POST['date']);
  $price = trim($_POST['price']);
  $stock = trim($_POST['stock']);
  $category_id = trim($_POST['categories']);
  $id = trim($_POST['id']);

  // Handle file upload
  $image = "assets/img/default.jpg"; // Default image path
  $uploadDir = __DIR__ . '/../assets/img/';

  if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true); // Create a directory if it does not exist
    chmod($uploadDir, 0777); // Change permissions
  }

  // Check if the directory is writable
  if (!is_writable($uploadDir)) {
    $info .= alert("Upload directory is not writable!", "danger");
  } else {
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
      $imageName = basename($_FILES['image']['name']);
      $uploadFile = $uploadDir . $imageName;

      // Check if it's a valid image type
      $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
      if (in_array($_FILES['image']['type'], $allowedTypes)) {
        // Move the uploaded file to the correct directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
          // File was moved successfully
          $image = 'assets/img/' . $imageName; // Update $image with the correct path
        } else {
          $info .= alert("Error uploading file!", "danger");
        }
      } else {
        $info .= alert("Invalid file type! Allowed types: JPEG, PNG, GIF, WEBP", "danger");
      }
    } else if (isset($_POST['old_image']) && !empty($_POST['old_image'])) {
      $image = $_POST['old_image'];
    }
  }

  $check = true;
  foreach ($_POST as $key => $value) {
    if (empty($value)) {
      $check = false;
    }
  }
  if ($check == false) {
    $info .= alert("Please fill in all the form fields", "danger");
  } else {
    // Check the Title field
    if (!isset($_POST['title']) || strlen(trim($_POST['title'])) < 2) {
      $info .= alert('The title is invalid! Must be at least 2 characters long', 'danger');
    }

    // Check the Director field
    if (!isset($_POST['director']) || strlen(trim($_POST['director'])) < 2) {
      $info .= alert('The director is invalid! Must be at least 2 characters long', 'danger');
    }

    // Check the Actors field
    if (!isset($_POST['actors']) || strlen(trim($_POST['actors'])) < 2) {
      $info .= alert('The actors are invalid! Must be at least 2 characters long', 'danger');
    }

    // Check the Age Restriction
    if (!isset($_POST['ageLimit']) || strlen(trim($_POST['ageLimit'])) < 2 || strlen(trim($_POST['ageLimit'])) > 3) {
      $info .= alert('The age restriction is invalid! Must be between 2 and 3 digits long', 'danger');
    }

    // Check the Duration
    if (!isset($_POST['duration']) || !preg_match('/^\d{1,2}h\d{2}$/', trim($_POST['duration']))) {
      $info .= alert('The duration is invalid! Use this format XXhXX (ex : 01h30)', 'danger');
    }

    // Check the Synopsis
    if (!isset($_POST['synopsis']) || strlen(trim($_POST['synopsis'])) < 10) {
      $info .= alert('The synopsis is invalid! Must be at least 10 characters long', 'danger');
    }

    // Check the Release Date
    if (!isset($_POST['date'])) {
      $info .= alert('The release date is invalid!', 'danger');
    }
    $categoryExist = getCategoryById($category_id);
    if (!$categoryExist) {
      $info .= alert("The category is invalid!", "danger");
    }
    // Check the Price
    if (!isset($_POST['price']) || strlen(trim($_POST['price'])) < 2) {
      $info .= alert('The price is invalid! Must be at least 3 digits long!', 'danger');
    }

    // Check the Stock
    if (!isset($_POST['stock']) || strlen(trim($_POST['stock'])) < 1) {
      $info .= alert('The stock is invalid! Must be at least 1 digit long', 'danger');
    }



    if (empty($info)) {
      if (isset($_POST['id']) && !empty($_POST['id'])) {
        updateFilm($title, $director, $actors, $ageLimit, $duration, $synopsis, $date, $image, $price, $stock, $category_id, $id);
      } else {
        addFilm($title, $director, $actors, $ageLimit, $duration, $synopsis, $date, $image, $price, $stock, $category_id);

      }
      $_SESSION['info'] = alert('Film successfuly added!', 'success');
      header("Location:films.php");
      exit;
    }
  }
}


require_once("../inc/header.inc.php");
?>
<main data-bs-theme="dark">
  <h2 class="text-center fw-bolder mb-5 pt-5 text-danger">Add a new film</h2>
  <?= $info; ?>
  <form action="" method="post" class="back" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $id; ?>">
    <input type="hidden" name="old_image" value="<?= $image; ?>">
    <div class="row">
      <div class="col-md-6 mb-5">
        <label for="title" class="form-label text-light">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="<?= $title; ?>">

      </div>
      <div class="col-md-6 mb-5">
        <label for="image" class="form-label text-light">Cover Image</label>
        <br>
        <input type="file" name="image" id="image">
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-5">
        <label for="director" class="form-label text-light">Director</label>
        <input type="text" class="form-control" id="director" name="director" value="<?= $director; ?>">
      </div>
      <div class="col-md-6">
        <label for="actors" class="form-label text-light">Actor(s)</label>
        <input type="text" class="form-control" id="actors" name="actors" value="<?= $actors; ?>"
          placeholder="séparez les noms d'acteurs avec un /">
      </div>
    </div>
    <div class="row">
      <div class="mb-3">
        <label for="ageLimit" class="form-label text-light">Age Restriction</label>
        <select class="form-select form-select-lg" name="ageLimit" id="ageLimit">
          <option value="10" <?= $ageLimit == '10' ? 'selected' : ''; ?>>10</option>
          <option value="13" <?= $ageLimit == '13' ? 'selected' : ''; ?>>13</option>
          <option value="16" <?= $ageLimit == '16' ? 'selected' : ''; ?>>16</option>
        </select>
      </div>
    </div>
    <div class="row">
      <label for="categories" class="form-label text-light">Genre</label>

      <?php
      $categories = getAllCategories('name');
      foreach ($categories as $category) {
        echo '<div class="form-check col-sm-12 col-md-4">
              <input class="form-check-input" type="radio" name="categories" id="' . $category['id'] . '" value="' . $category['id'] . '" ' . ($category_id == $category['id'] ? 'checked' : '') . '>
              <label class="form-check-label" for="' . $category['id'] . '">' . $category['name'] . '</label>
            </div>';
      }
      ?>
    </div>
    <div class="row">
      <div class="col-md-6 mb-5">
        <label for="duration" class="form-label text-light">Runtime</label>
        <input type="text" class="form-control" id="duration" name="duration" value="<?= $duration; ?>"
          placeholder="00h00">
      </div>

      <div class="col-md-6 mb-5">

        <label for="date" class="form-label text-light">Release Date</label>
        <input type="date" name="date" id="date" class="form-control" value="<?= $date; ?>">
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-5">
        <label for="price" class="form-label text-light">Price</label>
        <div class=" input-group">
          <input type="text" class="form-control" id="price" name="price"
            aria-label="Euros amount (with dot and two decimal places)" value="<?= $price; ?>">
          <span class="input-group-text">€</span>
        </div>
      </div>

      <div class="col-md-6">
        <label for="stock" class="form-label text-light">Stock</label>
        <input type="number" name="stock" id="stock" class="form-control" min="0" value="<?= $stock; ?>">
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <label for="synopsis" class="form-label text-light">Synopsis</label>
        <textarea type="text" class="form-control" id="synopsis" name="synopsis" rows="10"><?= $synopsis; ?></textarea>
      </div>
    </div>

    <div class="row justify-content-center">
      <button type="submit" class="btn btn-danger p-3 w-25"><?= $buttonText ?></button>
    </div>

  </form>

</main>


<?php require_once "../inc/footer.inc.php"; ?>