<?php

require_once "vendor/autoload.php";

use \Stripe;

$token = sanitize_text_field($_POST['stripeToken']);

if (isset($token) && !empty($token)) {

    Stripe\Stripe::setApiKey(get_option('stripe_forms_gutenberg_api_secret'));
 
    try {
        $charge = Stripe\Charge::create([
            "amount" => 1000,
            "currency" => "eur",
            "source" => $token,
            "description" => "Stripe Form Gutenberg"
        ]);
        echo "Pago completado";
        
    } catch (\Stripe\Error\Card $e) {    
        echo json_encode(["error"=> $e->getMessage()]);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Stripe Intermedio: Lección 04</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
  </head>

  <body>
    <form action="" method="post" id="payment-form">
    <div class="form-row">
      <label for="card-element">
        Introduce tu tarjeta
      </label>
      <div id="card-element"></div>

      <div id="card-errors" role="alert"></div>
    </div>

    <button>Enviar</button>
    </form>

    <?php wp_footer(); ?>
    <script>
      var stripe = Stripe('<?php echo get_option('stripe_forms_gutenberg_api_public'); ?>');
      var elements = stripe.elements();

      var card = elements.create('card');
      card.mount('#card-element');

      var form = document.getElementById('payment-form');
      form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
          if (result.error) {
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
          } else {
            pfcb_token_handler(result.token);
          }
        });
      });

      function pfcb_token_handler(token) {
          var form = document.getElementById('payment-form');
          var hiddenInput = document.createElement('input');
          hiddenInput.setAttribute('type', 'hidden');
          hiddenInput.setAttribute('name', 'stripeToken');
          hiddenInput.setAttribute('value', token.id);
          form.appendChild(hiddenInput);
          form.submit();
        }
    </script>
  </body>
</html>
