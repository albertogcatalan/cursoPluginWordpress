<?php
if (! current_user_can ('manage_options')) wp_die (_e('No tienes permisos', 'stripe-forms-gutenberg'));

require_once PFCB_PATH."/stripe/vendor/autoload.php";
require "Stats.php";

$stats = new \Stats(get_option('stripe_forms_gutenberg_api_secret'));
$chargeList = $stats->getChargeList(100);
$totalAmount = $stats->getTotalAmount($chargeList);

?>

    <div class="wrap">
        <h2><?php _e('Stripe Forms Gutenberg Dashboard', 'stripe-forms-gutenberg') ?></h2>
        <p><?php _e('Puedes consultar los últimos 100 movimientos', 'stripe-forms-gutenberg') ?></p>

        <div class="card">
            <div class="card-header">
                <strong><?php _e('Ingresos', 'stripe-forms-gutenberg'); ?></strong>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <?php _e('Total', 'stripe-forms-gutenberg'); ?>: <strong><?php echo $totalAmount['paid']; ?></strong> €
                </li>
                <li class="list-group-item">
                    <?php _e('Fallido', 'stripe-forms-gutenberg'); ?>: <strong><?php echo $totalAmount['failed']; ?></strong> €
                </li>
            </ul>

        </div>
    </div>

    <div class="wrap">
        <table class="table widefat fixed" cellspacing="0">
        <thead>
            <tr>
                <th class="manage-column">#</th>
                <th class="manage-column"><?php _e('Cantidad', 'stripe-forms-gutenberg'); ?></th>
                <th class="manage-column"><?php _e('Fecha', 'stripe-forms-gutenberg'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($chargeList as $charge) {
                    echo '<tr class="manage-column">';
                    echo '<td>'.$charge->id.'</td>';
                    echo '<td>'.($charge->amount/100).' €</td>';
                    echo '<td>'.date('d/m/Y H:i:s', $charge->created).'</td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
        </table>
    </div>
