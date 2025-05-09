<?php
require '../vendor/autoload.php';
use Yaphet17\Chapa\Chapa;

$chapa = new Chapa('CHASECK_TEST-AoPKLI8RBzhaSZ8tlUmaw80ICEd9fN00');

$data = [
    'amount' => $_POST['amount'],
    'currency' => 'ETB',
    'email' => $_POST['email'],
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
    'phone_number' => $_POST['phone_number'],
    'tx_ref' => uniqid(),
    'callback_url' => 'http://localhost/birth_certificate_project/userdashboard/success.php',
    'return_url' => 'http://localhost/birth_certificate_project/userdashboard/success.php',
    'customization' => [
        'title' => 'Birth Certificate Payment',
        'description' => 'Payment for birth certificate registration'
    ]
];

$response = $chapa->initialize($data);

if ($response['status'] == 'success') {
    header('Location: ' . $response['data']['checkout_url']);
    exit();
} else {
    echo "Payment initialization failed. Please try again.";
}
?>