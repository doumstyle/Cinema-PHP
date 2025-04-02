<?php require_once "functions.inc.php"; ?>

<!doctype html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="Premier site en PHP : site cinema">
  <meta name="author" content="MordueDeBootstrap">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!--  icones bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!--  Line vers google font  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Dosis:wght@200..800&family=Lora:ital,wght@0,400..700;1,400..700&display=swap"
    rel="stylesheet">
  <!-- Script pour Stripe -->
  <script src="https://js.stripe.com/v3/"></script>
  <link rel="stylesheet" href="<?= RACINE_SITE; ?>assets/css/style.css">
  <title>Movies</title>
</head>

<body>

  <header class="mb-5">
    <nav class="navbar navbar-expand-lg fixed-top">
      <div class="container-fluid">
        <h1><a class="navbar-brand" href="<?= RACINE_SITE; ?>index.php">M <img
              src="<?= RACINE_SITE; ?>assets/img/logo.png" alt=""> VIES</a></h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="d-flex navbar-nav justify-content-end w-100">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="<?= RACINE_SITE; ?>index.php">Home</a>
            </li>


            <li class="dropdown nav-item">
              <a class="dropdown-toggle nav-link" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Categories
              </a>
              <ul class="dropdown-menu">
                <?php $categories = getAllCategories('name'); ?>
                <?php foreach ($categories as $category): ?>

                  <li><a class="dropdown-item text-dark fs-4"
                      href="<?php echo RACINE_SITE . 'index.php?category_id=' . $category['id']; ?>"><?php echo ucfirst($category['name']); ?></a>
                  </li>

                <?php endforeach; ?>

              </ul>
            </li>


            <?php if (!isset($_SESSION['user'])): ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= RACINE_SITE; ?>register.php">Register</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= RACINE_SITE; ?>auth.php">Login</a>
              </li>
            <?php endif; ?>

            <?php if (isset($_SESSION['user'])): ?>

              <li class="nav-item">
                <a class="nav-link" href="<?= RACINE_SITE; ?>profile.php">Account<sup
                    class="badge rounded-pill text-bg-danger"></sup></a>
              </li>
            <?php endif; ?>

            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
              <li class="dropdown nav-item">
                <a class="dropdown-toggle nav-link" href="" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">Backoffice</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item text-dark fs-4"
                      href="<?= RACINE_SITE; ?>admin/categories.php">Categories</a></li>
                  <li><a class="dropdown-item text-dark fs-4" href="<?= RACINE_SITE; ?>admin/films.php">Films</a></li>
                  <li><a class="dropdown-item text-dark fs-4" href="<?= RACINE_SITE; ?>admin/filmForm.php">Film
                      Managment</a></li>
                  <li><a class="dropdown-item text-dark fs-4" href="<?= RACINE_SITE; ?>admin/users.php">Users</a></li>
                </ul>

              </li>
            <?php endif; ?>




            <?php if (isset($_SESSION['user'])): ?>
              <li class="nav-item">
                <a class="nav-link" href="?action=logout">Logout</a>

                <?php if (isset($_GET['action']) && $_GET['action'] == 'logout'):
                  logout();
                endif;
                ?>

              </li>
            <?php endif; ?>



            <li class="nav-item">
              <a class="nav-link" href="<?= RACINE_SITE; ?>store/cart.php"><i
                  class="bi bi-cart fs-2"><sup></sup></i></a>
            </li>


          </ul>

        </div>
      </div>
    </nav>
  </header>