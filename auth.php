<?php
session_start();
require_once 'inc/functions.inc.php';
if (isset($_SESSION['user'])) {
  header("location:profile.php");
}
$info = "";

if (!empty($_POST)) {
  $check = true;
  foreach ($_POST as $key => $value) {
    if (empty(trim($value))) {
      $check = false;
    }
  }
  if ($check === false) {
    $info .= alert("Please fill in all the form's fields", "danger");
  } else {
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $user = checkUserEmailNickname($email, $nickname);

    if ($user) {
      if (password_verify($pass, $user['password'])) {
        session_start();
        $_SESSION['user'] = $user;
        header("Location: profile.php");
      } else {
        $info .= alert("Password is incorrect", "danger");
      }
    }
  }
}

require_once 'inc/header.inc.php';
?>

<main style="background:url(assets/img/5818.png) no-repeat; background-size: cover; background-attachment: fixed;">
  <div class="w-50 m-auto p-5 mt-5" style="background: rgba(20, 20, 20, 0.9);">
    <h2 class="text-center mb-5 p-3">Login</h2>

    <?php
    echo ($info);   // pour afficher les messages de vérification
    ?>

    <form action="" method="post" class="p-5">
      <div class="row mb-3">
        <div class="col-12 mb-5">
          <label for="pseudo" class="form-label mb-3">Nickname</label>
          <input type="text" class="form-control fs-5" id="pseudo" name="nickname">
        </div>
        <div class="col-12 mb-5">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control fs-5" id="email" name="email" placeholder="exemple.email@exemple.com">
        </div>
        <div class="col-12 mb-5">
          <label for="password" class="form-label mb-3">Password</label>
          <input type="password" class="form-control fs-5 mb-3" id="password" name="password">
          <input type="checkbox" id="showHide"> <span class="text-danger">Show/hide password</span>
        </div>

        <button class="w-25 m-auto btn btn-danger btn-lg fs-5" type="submit">Login</button>
        <p class="mt-5 text-center">You don't have an account?! <a href="register.php" class=" text-danger">Register here</a></p>
      </div>
    </form>
  </div>
</main>

<?php require_once 'inc/footer.inc.php'; ?>