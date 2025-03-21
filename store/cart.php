<?php
require_once 'inc/functions.inc.php';
require_once 'inc/header.inc.php';




?>
<div class="d-flex justify-content-center panier" style="padding-top:8rem;">


  <div class="d-flex flex-column p-5 mt-5">
    <h2 class="text-center text-danger fw-bolder mb-5">Mon panier</h2>

    <!-- le paramètre vider=1 pour indiquer qu'il faut vider le panier. -->
    <a href="" class="btn align-self-end mb-5">Vider le panier</a>

    <table class="fs-4">
      <tr>
        <th class="text-center text-danger fw-bolder">Affiche</th>
        <th class="text-center text-danger fw-bolder">Nom</th>
        <th class="text-center text-danger fw-bolder">Prix</th>
        <th class="text-center text-danger fw-bolder">Quantité</th>
        <th class="text-center text-danger fw-bolder">Sous-total</th>
        <th class="text-center text-danger fw-bolder">Supprimer</th>
      </tr>
      <tr>
        <td class="border-dark-subtle border-top text-center"><a href=""><img src="" style="width: 100px;"></a></td>
        <td class="border-dark-subtle border-top text-center"></td>
        <td class="border-dark-subtle border-top text-center">€</td>
        <td class="d-flex align-items-center border-dark-subtle border-top justify-content-center text-center"
          style="padding: 7rem;">

          <!-- Afficher la quantité actuelle -->

        </td>
        <td class="border-dark-subtle border-top text-center">€</td>
        <td class="border-dark-subtle border-top text-center"><a href=""><i class="bi bi-trash3"></i></a></td>
      </tr>

      <tr class="border-dark-subtle border-top">
        <th class="p-4 text-danger fs-3">Total :€</th>
      </tr>
    </table>
    <form action="checkout.php" method="post">
      <input type="hidden" name="total" value="">
      <button type="submit" class="btn btn-danger p-3 mt-5" id="checkout-button">Payer</button>
    </form>
  </div>
</div>
<?php
require_once 'inc/footer.inc.php';
?>