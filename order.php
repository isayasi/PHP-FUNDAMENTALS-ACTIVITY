<?php
session_start(); // Start session

// Prices for items
$prices = [
    'Burger' => 50,
    'Fries' => 75,
    'Steak' => 150,
];

// Get form data
$order = $_POST['order']; // Order
$quantity = (int)$_POST['quantity']; // Quantity
$cash = (int)$_POST['cash']; // Cash

// Calculate total price
$total_price = $prices[$order] * $quantity; // Total

// Check if cash is enough
if ($cash < $total_price) {
    // Insufficient balance
    echo "<h1 style='font-size:24px;'>Sorry, balance not enough.</h1>";
} else {
    // Calculate change
    $change = $cash - $total_price; // Change

    // Store session data
    $_SESSION['total_price'] = $total_price; // Total price
    $_SESSION['cash'] = $cash; // Cash paid
    $_SESSION['change'] = $change; // Change

    // Display receipt
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'> <!-- Encoding -->
        <meta name='viewport' content='width=device-width, initial-scale=1.0'> <!-- Responsive -->
        <title>Receipt</title>
        <style>
            /* Body styling */
            body {
                font-size: 18px;
            }

            /* Heading styling */
            h1 {
                font-size: 24px;
            }

            /* Paragraph styling */
            p {
                font-size: 18px;
            }
        </style>
    </head>
    <body>

    <!-- Receipt details -->
    <h1>RECEIPT</h1>
    <p>Total Price: {$_SESSION['total_price']}</p> <!-- Total price -->
    <p>You Paid: {$_SESSION['cash']}</p> <!-- Cash paid -->
    <p>CHANGE: {$_SESSION['change']}</p> <!-- Change -->
    <p>" . date('m/d/Y h:i:s a') . "</p> <!-- Timestamp -->

    </body>
    </html>";
}
?>
