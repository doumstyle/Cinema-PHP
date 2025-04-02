<?php
require_once '../inc/functions.inc.php';
$info = '';

$name = '';
$description = '';
$id = '';
$action = 'add';
// show success or error message
if (isset($_SESSION['info'])) {
  $info = $_SESSION['info'];
  unset($_SESSION['info']);
}

if (!isset($_SESSION['user'])) {
  header('location: auth.php');
  exit;
} else {
  if ($_SESSION['user']['role'] == 'user') {
    header('location: profile.php');
  }
}

// Delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
  $categoryId = $_GET['id'];
  try {
    deleteCategory($categoryId);
    $_SESSION['info'] = alert('Category deleted successfully', 'success');
    header("location:categories.php");
    exit;
  } catch (PDOException $e) {
    $info .= alert('Error deleting category: ' . $e->getMessage(), 'danger');
  }
}

// Update action
if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id'])) {
  $action = 'update';
  $id = $_GET['id'];
  $category = getCategoryById($id);

  if ($category) {
    $id = $category['id'];
    $name = $category['name'];
    $description = $category['description'];
  } else {
    $info .= alert('Category not found!', 'danger');
  }
}

// Form Submission
if (!empty($_POST)) {
  $check = true;
  $requiredFields = ['name', 'description'];
  foreach ($requiredFields as $key) {
    if (empty($_POST[$key])) {
      $check = false;
    }
  }
  if ($check == false) {
    $info .= alert("Please fill in all fields!", "danger");
  } else {
    if (!isset($_POST['name']) || strlen(trim($_POST['name'])) < 3 || preg_match('/[0-9]/', $_POST['name'])) {
      $info .= alert('The category field is invalid!', 'danger');
    }

    if (!isset($_POST['description']) || strlen(trim($_POST['description'])) < 20) {
      $info .= alert('The description field is invalid!', 'danger');
    } elseif ($info == '') {

      $name = htmlspecialchars(trim($_POST['name']));
      $description = htmlspecialchars(trim($_POST['description']));

      if (isset($_POST['action']) && $_POST['action'] == 'update') {
        $categoryId = $_POST['id'];
        try {
          updateCategory($categoryId, $name, $description);
          $_SESSION['info'] = alert('Category updated successfully', 'success');
          header('location:categories.php');
          exit;
        } catch (PDOException $e) {
          $info .= alert('Error updating category: ' . $e->getMessage(), 'danger');
        }
      } else {
        $dbCategory = categoryExist($name);
        if ($dbCategory) {
          $info .= alert('Category already exists', 'danger');
        } else {
          try {
            addCategory($name, $description);
            // REDIRECT AFTER ADDING A CATEGORY
            $_SESSION['info'] = alert('Category added successfully', 'success');
            header("location:categories.php");
            exit;
          } catch (PDOException $e) {
            $info .= alert('Error adding category: ' . $e->getMessage(), 'danger');
          }
        }
      }
    }
  }
}

$categories = getAllCategories('id');

require_once '../inc/header.inc.php';
?>

<div class="row mt-2" style="padding-top: 8rem;">
  <div class="col-md-6 col-sm-12 mt-5">
    <h2 class="text-center text-danger fw-bolder mb-5">Categories Management</h2>
    <?= $info; ?>
    <form action="" method="post" class="back">
      <input type="hidden" name="action" value="<?= $action; ?>">
      <input type="hidden" name="id" value="<?= $id; ?>">
      <div class="row">
        <div class="col-md-8 mb-5">
          <label for="name" class="form-label text-white">Category name</label>

          <input type="text" id="name" name="name" class="form-control" value="<?= $name; ?>">

        </div>
        <div class="col-md-12 mb-5">
          <label for="description" class="form-label text-white">Description</label>
          <textarea id="description" name="description" class="form-control" rows="10"><?= $description; ?></textarea>
        </div>

      </div>
      <div class="row justify-content-center">
        <button type="submit" class="btn btn-danger p-3 fs-6 fw-bold">Submit</button>
      </div>
    </form>
  </div>

  <div class="col-md-6 col-sm-12 d-flex flex-column mt-5 px-5">
    <h2 class="text-center text-danger fw-bolder mb-5">Categories list</h2>
    <table class="table table-bordered table-dark">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Description</th>
          <th>Delete</th>
          <th>Modify</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($categories as $category) { ?>
          <tr>
            <td><?= $category['id']; ?></td>
            <td><?= $category['name']; ?></td>
            <td><?= $category['description']; ?></td>

            <td class="text-center"><a href="categories.php?action=delete&id=<?= $category['id']; ?>"
                data-category-name=<?= $category['name']; ?> class="trash-icon"><i class="bi bi-trash3-fill"></i></a></td>
            <td class="text-center"><a href="categories.php?action=update&id=<?= $category['id']; ?>"><i
                  class="bi bi-pen-fill"></i></a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <?php require_once '../inc/footer.inc.php'; ?>