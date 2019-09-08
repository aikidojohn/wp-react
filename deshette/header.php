<?php
/**
 * The header for our theme.
 *
 * @package Deshette_Theme
 *
 */
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <div class="navbar-header page-scroll">
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="navbar-brand"><?php bloginfo( 'name' ); ?></a>
      </div>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <?php wp_nav_menu(array(
            'theme_location' => 'header-menu',
            'items_wrap'=>'%3$s',
            'container' => false,
            'list_item_class' => "nav-item",
            'link_class' => "nav-link",
            )); ?>
        </ul>
      </div>
    </div>
  </nav>

  <?php dynamic_header(); ?>

<div class="container">
    <div class="row">