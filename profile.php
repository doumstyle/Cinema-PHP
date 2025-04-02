<?php
require_once 'inc/functions.inc.php';
require_once 'inc/header.inc.php';

$user = $_SESSION['user'];
?>

<div class="container my-5">
  <!-- <div class="p-5 text-center bg-body-tertiary rounded-3">
     <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="var(--bs-red)" class="bi bi-person-circle"
      viewBox="0 0 16 16">
      <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
      <path fill-rule="evenodd"
        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
    </svg>
    <h1 class="text-body-emphasis">Welcome to Movies, <?= $user['firstname']; ?></h1>
    <p class="col-lg-8 mx-auto fs-12 text-muted">
      Here you can see a list of your favourites movies.
    </p>
    <div class="d-inline-flex gap-2 mb-5">
      <a href='index.php' class="d-inline-flex align-items-center btn btn-danger btn-lg px-4 rounded-pill fw-bold"
        type="button">
        Go to Movies
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-arrow-right-circle mx-2"
          viewBox="0 0 16 16">
          <path fill-rule="evenodd"
            d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
        </svg>
      </a>
      <?php if ($_SESSION['user'] && $_SESSION['user']['role'] === 'admin'): ?>
        <a href='admin/users.php' class="d-inline-flex align-items-center btn info btn-lg px-4 rounded-pill fw-bold"
          type="button">
          Check users
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-arrow-right-circle mx-2"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
              d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
          </svg>
        </a>
      <?php endif; ?>
    </div>
  </div> -->
  <h2 class="text-center pb-5">Profile</h2>
  <div class="cardFilm">
    <div class="image">

      <img src="<?= $user['civility'] === 'm' ? './assets/img/avatar_h.png' : './assets/img/avatar_f.png' ?>"
        class="img-fluid" alt="Image avatar de l'utilisateur">


      <div class="details">
        <div class="center ">

          <table class="table">
            <tr>
              <th scope="row" class="fw-bold">Lastname</th>
              <td><?= $user['lastname'] ?></td>

            </tr>
            <tr>
              <th scope="row" class="fw-bold">Firstname</th>
              <td><?= $user['firstname'] ?></td>

            </tr>
            <tr>
              <th scope="row" class="fw-bold">Nickname</th>
              <td colspan="2"><?= $user['nickname'] ?></td>

            </tr>
            <tr>
              <th scope="row" class="fw-bold">Email</th>
              <td colspan="2"><?= $user['email'] ?></td>

            </tr>
            <tr>
              <th scope="row" class="fw-bold">Phone</th>
              <td colspan="2"><?= $user['phone'] ?></td>

            </tr>
            <tr>
              <th scope="row" class="fw-bold">Address</th>
              <td colspan="2">
                <?= $user['address'] . ' ' . $user['zipcode'] . ' ' . $user['city'] . ' ' . $user['country'] ?>
              </td>

            </tr>

          </table>
          <a href="" class="btn mt-5">Modify info</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once 'inc/footer.inc.php'; ?>