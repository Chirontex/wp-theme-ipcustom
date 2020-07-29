<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body class="text-center" onresize="custom_body_init();" onload="custom_body_init();">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
<?php 

the_custom_logo();

wp_nav_menu([
    'theme_location' => 'primary',
    'container' => false,
    'items_wrap' => '<nav id="%1$s" class="%2$s">%3$s</nav>',
    'menu_class' => 'nav nav-masthead justify-content-center',
    'depth' => 0
]);

?>
            </div>
        </header>