<?php
require '../vendor/autoload.php';
use Yaphet17\Chapa\Chapa;

$tx_ref = $_GET['tx_ref'];
$chapa = new Chapa('CHASECK_TEST-AoPKLI8RBzhaSZ8tlUmaw80ICEd9fN00');

$response = $chapa->verify($tx_ref);

if ($response['status'] == 'success' && $response['data']['status'] == 'success') {
    echo "Payment successful. Certificate will be processed.";
    // You can save to DB here
} else {
    echo "Payment failed or not verified.";
}
?>