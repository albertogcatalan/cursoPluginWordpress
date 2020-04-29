<?php
if (! current_user_can ('manage_options')) wp_die (_e('No tienes permisos', 'stripe-forms-gutenberg'));
?>

    <div class="wrap">
        <h2><?php _e('Stripe Forms Gutenberg', 'stripe-forms-gutenberg') ?></h2>
        <p><?php _e('Bienvenidos a la configuración', 'stripe-forms-gutenberg') ?></p>

        <form method="POST" action="options.php">
            <?php
                settings_fields('stripe-forms-gutenberg-settings-group');
                do_settings_sections('stripe-forms-gutenberg-settings-group');
            ?>
            <table class="form-table">
                <tr>
                    <td>
                        <label><?php _e('Stripe API secreta', 'stripe-forms-gutenberg') ?>:</label>
                        <input type="text" name="stripe_forms_gutenberg_api_secret" id="stripe_forms_gutenberg_api_secret" value="<?php echo get_option('stripe_forms_gutenberg_api_secret'); ?>" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label><?php _e('Stripe API pública', 'stripe-forms-gutenberg') ?>:</label>
                        <input type="text" name="stripe_forms_gutenberg_api_public" id="stripe_forms_gutenberg_api_public" value="<?php echo get_option('stripe_forms_gutenberg_api_public'); ?>" />
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
