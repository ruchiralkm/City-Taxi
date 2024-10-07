<?php 
    // Check if the fare is set in the query parameters
    if (isset($_GET['fare'])) {
        $fare = htmlspecialchars($_GET['fare']); // Sanitize the input
    } else {
        $fare = '0'; // Default value if fare is not set
    }

    // Convert fare to integer for Stripe (Stripe expects the amount in cents/paisa, so multiply by 100)
    $fareInCents = intval($fare) * 100;

    require __DIR__ . "/vendor/autoload.php";

    $stripe_secret_key = "sk_test_51Q7GTPE6xdlpuQ3KINK4PnQY1z20WIpeEJgvaGpszZ97pon4jRLpgn1RmO7OdCZeU9jWmkg0N4ocKV6GSyXMBqbn00AFBnNZpj";

    \Stripe\Stripe::setApiKey($stripe_secret_key);

    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
<<<<<<< HEAD
        "success_url" => "http://localhost/SS/success.php",
=======
        "success_url" => "http://localhost/City-Taxi/Implementation/success.php",
>>>>>>> 5482f90178809ca65bfd3e7d9ff6b983e6de94b4
        "cancel_url" => "http://localhost/SS/index.php",
        "locale" => "auto",
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "lkr",
                    "unit_amount" => $fareInCents, // Pass the fare amount in cents/paisa
                    "product_data" => [
                        "name" => "Checkout your ride"
                    ]
                ]
            ],        
        ]
    ]);

    http_response_code(303);
    header("Location: " . $checkout_session->url);

?>
