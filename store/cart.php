<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../inc/functions.inc.php';

$total = 0;

if (empty($_SESSION['user'])) {
  header('location: ' . RACINE_SITE . 'auth.php');
  exit();
}

if (isset($_POST) && !empty($_POST)) {
  $idFilm = htmlentities($_POST['id']);
  $film = getFilmById($idFilm);
  $quantity = htmlentities($_POST['quantity']);


  $title = $film['title'];
  $price = $film['price'];
  $stock = $film['stock'];
  $cover = $film['image'];

  if ($idFilm != $film['id'] || empty($quantity) || $quantity < 1 || $quantity > $stock) {
    header('location:' . RACINE_SITE . 'index.php');
    exit();
  } else {

    // Check if the film is already in the cart
    $filmNotExist = false;

    foreach ($_SESSION['cart'] as $key => $value) {

      if ($value['id'] == $idFilm) {
        $_SESSION['cart'][$key]['quantity'] += $quantity;
        $filmNotExist = true;
        break;
      }
    }

    if ($filmNotExist == false) {
      $newFilm = [
        'id' => $idFilm,
        'quantity' => $quantity,
        'title' => $title,
        'price' => $price,
        'stock' => $stock,
        'cover' => $cover,
        'subtotal' => $price * $quantity,
      ];
      $_SESSION['cart'][] = $newFilm;
    } else {
      $_SESSION['cart'][$key]['subtotal'] = $_SESSION['cart'][$key]['price'] * $_SESSION['cart'][$key]['quantity'];
    }
  }
}

// Empty cart
if (isset($_GET['action']) && $_GET['action'] == 'empty') {
  unset($_SESSION['cart']);
}

// Delete one item from cart
if (isset($_GET['id'])) {
  $idFilmForDeletion = htmlentities($_GET['id']);
  foreach ($_SESSION['cart'] as $key => $film) {
    if ($film['id'] == $idFilmForDeletion) {
      unset($_SESSION['cart'][$key]);
      // break;
    }
  }
}

require_once '../inc/header.inc.php';
?>

<main>
  <div class="d-flex justify-content-center panier" style="padding-top:8rem;">
    <div class="d-flex flex-column p-5 mt-5">
      <h2 class="text-center text-danger fw-bolder mb-5">My Cart</h2>
      <a href="?action=empty" class="btn align-self-end mb-5">Empty Cart</a>

      <table class="fs-4">
        <tr>
          <th class="text-center text-danger fw-bolder">Cover</th>
          <th class="text-center text-danger fw-bolder">Title</th>
          <th class="text-center text-danger fw-bolder">Price</th>
          <th class="text-center text-danger fw-bolder">Quantity</th>
          <th class="text-center text-danger fw-bolder">Subtotal</th>
          <th class="text-center text-danger fw-bolder">Delete</th>
        </tr>

        <?php

        if (!empty($_SESSION['cart'])) {
          foreach ($_SESSION['cart'] as $item) {
            $total += $item['subtotal'];
            ?>
            <tr>
              <td class="border-dark-subtle border-top text-center"><a href="<?= RACINE_SITE . 'index.php' ?>"><img
                    src="<?= $item['cover']; ?>" style="width: 200px;"></a></td>
              <td class="border-dark-subtle border-top text-center" style="width: 100px;"><?= $item['title'] ?></td>
              <td class="border-dark-subtle border-top text-center"><?= $item['price'] ?>€</td>
              <td class="border-dark-subtle border-top text-center">
                <?= $item['quantity'] ?>
              </td>
              <td class="border-dark-subtle border-top text-center"><?= $item['subtotal'] ?>€</td>
              <td class="border-dark-subtle border-top text-center">
                <a href="<?= RACINE_SITE . 'store/cart.php?id=' . $item['id']; ?>">
                  <i class="bi bi-trash3"></i>
                </a>
              </td>
            </tr>
            <?php
          }
        } else {
          echo '<tr><td colspan="6" class="text-center">Your cart is empty.</td></tr>';
        }
        ?>

        <tr class="border-dark-subtle border-top">
          <th class="p-4 text-danger fs-3">Total : <?= $total ?>€</th>
        </tr>
      </table>
      <form action="checkout.php" method="post">
        <input type="hidden" name="total" value="<?= $total ?>">
        <button type="submit" class="btn btn-danger p-3 mt-5" id="checkout-button">Order</button>
      </form>
    </div>
  </div>
</main>

<?php
require_once '../inc/footer.inc.php';
?>