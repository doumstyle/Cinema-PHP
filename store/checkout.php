<?php
require_once '../vendor/autoload.php';
require_once '../secrets.php';
require_once '../inc/functions.inc.php';

$total = $_POST['total'] * 100;

\Stripe\Stripe::setApiKey($stripeSecretKey);
header('Content-Type: application/json');

$YOUR_DOMAIN = RACINE_SITE . 'store';

$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [
    [
      'price_data' => [
        'currency' => 'EUR',
        'unit_amount' => $total,
        'product_data' => [
          'name' => 'Film'
        ]

      ],
      'quantity' => 1,
    ]
  ],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.php?total=' . $_POST['total'],
  'cancel_url' => $YOUR_DOMAIN . '/cancel.php',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);