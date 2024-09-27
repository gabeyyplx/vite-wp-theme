<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<nav class="main-nav">
		<div class="logo">
			<?php the_custom_logo(); ?>
			<button class="toggle-mobile-nav"></button>
		</div>
			
		<div class="main-menu">
			<?php wp_nav_menu(array(
				'theme_location' => 'main-menu',
				'fallback_cb' => false,
				'depth' => 1
			)); ?>
		</div>
	</nav>
	<div class="content">