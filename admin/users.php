<?php
require_once '../inc/functions.inc.php';

// Check if a user is logged in AND if they are an admin.
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  // If not logged in OR not an admin, redirect to the index page.
  header("Location:" . RACINE_SITE . "index.php");
  exit; // Always exit after a header redirect.
}

$info = '';

if (isset($_GET['success'])) {
  $info .= alert($_GET['success'], "success");
}

// Check if user clicks on 'modify role' button
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] === 'modifyRole') {
  $userId = $_GET['id'];
  $user = fetchAllUsers();
  // Get the current role of the user
  foreach ($user as $key => $value) {
    if ($value['id'] == $userId) {
      $currentRole = $value['role'];
    }
  }
  $newRole = ($currentRole === 'admin' ? 'user' : 'admin');
  modifyUserRole($userId, $newRole);

  // Reload the page
  header("location:users.php?success=User role changed to $newRole");
  exit;
}

if (isset($_GET["id"]) && isset($_GET["action"]) && $_GET["action"] === 'deleteUser') {
  $userId = $_GET['id'];
  deleteUser($userId);
  header("location:users.php?success=User deleted");
  exit;
}

require_once '../inc/header.inc.php';
?>

<div class="d-flex flex-column m-auto mt-5 table-responsive px-5">
  <?php echo $info; ?>
  <!-- Table displaying all users with delete and modify role buttons -->
  <h2 class="text-center fw-bolder mb-5 text-danger">List of users</h2>
  <table class="table  table-dark table-bordered mt-5">
    <thead>
      <tr>
        <th>ID</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Nickname</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Civility</th>
        <th>Address</th>
        <th>Zipcode</th>
        <th>City</th>
        <th>Country</th>
        <th>Role</th>
        <th>Delete</th>
        <th>Modify role</th>
      </tr>
    </thead>
    <tbody>

      <?php
      $users = fetchAllUsers();
      ?>

      <?php foreach ($users as $user): ?>
        <tr>
          <td><?= $user['id'] ?></td>
          <td><?= $user['firstname'] ?></td>
          <td><?= $user['lastname'] ?></td>
          <td><?= $user['nickname'] ?></td>
          <td><?= $user['email'] ?></td>
          <td><?= $user['phone'] ?></td>
          <td><?= $user['civility'] ?></td>
          <td><?= $user['address'] ?></td>
          <td><?= $user['zipcode'] ?></td>
          <td><?= $user['city'] ?></td>
          <td><?= $user['country'] ?></td>
          <td><?= $user['role'] ?></td>
          <td class='text-center'>
            <a href='?id=<?= $user['id'] ?>&action=deleteUser' class='btn btn-danger'>
              <i class='bi bi-trash3'></i>
            </a>
          </td>
          <td class='text-center'><a href='?id=<?= $user['id'] ?>&action=modifyRole' class='btn btn-danger'>
              <?= (($user['role'] === 'admin') ? 'User role' : 'Admin role') ?></a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</div>

<?php
require_once '../inc/footer.inc.php';
?>