<?php
require_once '../inc/functions.inc.php';
require_once '../inc/header.inc.php';


$id_user = $_SESSION['user']['id'];
$price = $_GET['total'];
$purchase_date = date('Y-m-d H:i:s');
$result = addOrder($id_user, $price, $purchase_date, 1);

$orderId = lastId();



if ($result) {
  foreach ($_SESSION['cart'] as $value) {
    addOrderDetails($orderId['lastId'], (int) $value['id'], $value['price'], $value['quantity']);
  }
}

?>
<main class="d-flex justify-content-center panier" style="padding-bottom:8rem;">
  <div class="w-25 m-auto  d-flex flex-column align-item-center">
    <p class="alert alert-success text-center ">Votre achat a bien été effectué </p>
    <a href="<?= RACINE_SITE; ?>profile.php" class="btn text-center">Suivre ma commande </a>
  </div>
</main>

<?php require_once '../inc/footer.inc.php'; ?>