<?php
/**
 * Template part for displaying site info
 *
 * @package Bosa Plumber 1.0.0
 */

?>

<div class="site-info">
	<?php echo wp_kses_post( html_entity_decode( esc_html__( 'Copyright &copy; ' , 'bosa-plumber' ) ) );
		echo esc_html( date( 'Y' ) );
		printf( esc_html__( ' Bosa Plumber. Powered by', 'bosa-plumber' ) );
	?>
	<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'bosa-plumber' ) ); ?>" target="_blank">
		<?php
			printf( esc_html__( 'WordPress', 'bosa-plumber' ) );
		?>
	</a>
</div><!-- .site-info -->