( function( blocks, element, i18n ) {
    var el = element.createElement;
    var __ = i18n.__;
 
    var blockStyle = {
        backgroundColor: '#000',
        color: '#fff',
        padding: '20px',
    };
 
    blocks.registerBlockType( 'gutenberg-alberto/stripe-forms', {
        title: __('Stripe Forms', 'stripe-forms-gutenberg'),
        icon: 'universal-access-alt',
        category: 'layout',
        example: {},
        edit: function() {
            return el(
                'p',
                { style: blockStyle },
                'Stripe Form'
            );
        },
        save: function() {
            return el(
                'iframe',
                {
                    src: custom_data.siteUrl+'/?gutenbergstripeform',
                    frameborder: 0
                },
            );
        },
    } );
}(
    window.wp.blocks,
    window.wp.element,
    window.wp.i18n
) );