<?php
$renownedbrandoneID = get_theme_mod( 'brands_image_one', '' );
$renownedbrandcategoryone = get_theme_mod( 'brand_category_one', '' );

$renownedbrandtwoID = get_theme_mod( 'brands_image_two','');
$renownedbrandcategorytwo = get_theme_mod( 'brand_category_two', '' );

$renownedbrandthreeID = get_theme_mod( 'brands_image_three', '' );
$renownedbrandcategorythree = get_theme_mod( 'brand_category_three', '' );

$renownedbrandfourID = get_theme_mod( 'brands_image_four', '' );
$renownedbrandcategoryfour = get_theme_mod( 'brand_category_four', '' );

$renownedbrandfiveID = get_theme_mod( 'brands_image_five', '' );
$renownedbrandcategoryfive = get_theme_mod( 'brand_category_five', '' );

$renownedbrandsixID = get_theme_mod( 'brands_image_six', '' );
$renownedbrandcategorysix = get_theme_mod( 'brand_category_six', '' );


$renowned_brand_array = array();
$has_brands = false;
if( !empty( $renownedbrandoneID ) || !empty( $renownedbrandcategoryone ) ){
	$renowned_brand_one  = wp_get_attachment_image_src( $renownedbrandoneID ,'bosa-420-300');
 	if ( is_array(  $renowned_brand_one ) ){
 		$has_brands = true;
   	 	$renowned_brands_one = $renowned_brand_one[0];
   	 	$renowned_brand_array['image_one'] ['ID'] = $renowned_brands_one;	 	
  	}
  	if ( !empty($renownedbrandcategoryone) ){
 		$has_brands = true;
   	 	$renowned_brand_array['image_one']['category'] = $renownedbrandcategoryone;	
  	}
}
if( !empty( $renownedbrandtwoID ) || !empty( $renownedbrandcategorytwo ) ){
	$renowned_brand_two = wp_get_attachment_image_src( $renownedbrandtwoID,'bosa-420-300');
	if ( is_array(  $renowned_brand_two ) ){
		$has_brands = true;	
        $renowned_brands_two = $renowned_brand_two[0];
        $renowned_brand_array['image_two'] ['ID']= $renowned_brands_two; 
	}
	if ( !empty($renownedbrandcategorytwo) ){
		$has_brands = true;
	 	$renowned_brand_array['image_two']['category'] = $renownedbrandcategorytwo;	
  	}
}
if( !empty( $renownedbrandthreeID ) || !empty( $renownedbrandcategorythree ) ){	
	$renowned_brand_three = wp_get_attachment_image_src( $renownedbrandthreeID,'bosa-420-300');
	if ( is_array(  $renowned_brand_three ) ){
		$has_brands = true;
      	$renowned_brands_three = $renowned_brand_three[0];
      	$renowned_brand_array['image_three'] ['ID']= $renowned_brands_three;		
  	}
  	if ( !empty($renownedbrandcategorythree) ){
		$has_brands = true;
	 	$renowned_brand_array['image_three'] ['category'] = $renownedbrandcategorythree;	
  	}
}
if( !empty( $renownedbrandfourID ) || !empty( $renownedbrandcategoryfour ) ){	
	$renowned_brand_four = wp_get_attachment_image_src( $renownedbrandfourID,'bosa-420-300');
	if ( is_array(  $renowned_brand_four ) ){
		$has_brands = true;
      	$renowned_brands_four = $renowned_brand_four[0];
      	$renowned_brand_array['image_four'] ['ID'] = $renowned_brands_four;	
  	}
  	if ( !empty($renownedbrandcategoryfour) ){
		$has_brands = true;
	 	$renowned_brand_array['image_four'] ['category'] = $renownedbrandcategoryfour;	
  	}
}
if( !empty( $renownedbrandfiveID ) || !empty( $renownedbrandcategoryfive ) ){	
	$renowned_brand_five = wp_get_attachment_image_src( $renownedbrandfiveID,'bosa-420-300');
	if ( is_array(  $renowned_brand_five ) ){
		$has_brands = true;
      	$renowned_brands_five = $renowned_brand_five[0];
      	$renowned_brand_array['image_five'] ['ID'] = $renowned_brands_five;	
  	}
  	if ( !empty($renownedbrandcategoryfive) ){
		$has_brands = true;
	 	$renowned_brand_array['image_five'] ['category'] = $renownedbrandcategoryfive;	
  	}
}
if( !empty( $renownedbrandsixID ) || !empty( $renownedbrandcategorysix ) ){	
	$renowned_brand_six = wp_get_attachment_image_src( $renownedbrandsixID,'bosa-420-300');
	if ( is_array(  $renowned_brand_six ) ){
		$has_brands = true;
      	$renowned_brands_six = $renowned_brand_six[0];
      	$renowned_brand_array['image_six'] ['ID'] = $renowned_brands_six;	
  	}
  	if ( !empty($renownedbrandcategorysix) ){
		$has_brands = true;
	 	$renowned_brand_array['image_six'] ['category'] = $renownedbrandcategorysix;	
  	}
}

$product_cat = bosa_plumber_get_product_categories();

if( !get_theme_mod( 'disable_renowned_brands_section', true ) && ( $has_brands || get_theme_mod('renowned_brands_title') || get_theme_mod('renowned_brands_sub_title') ) ){ ?>
	<section class="section-renowned-area">
		<?php if( get_theme_mod('renowned_brands_title') || get_theme_mod('renowned_brands_sub_title') ){ ?>
			<div class="section-title-wrap col-lg-6 offset-lg-3 col-md-8 offset-md-2">
				<h2 class="section-title">	
					<?php echo esc_html( get_theme_mod('renowned_brands_title') ); ?>
				</h2>
				<p>
					<?php echo esc_html( get_theme_mod('renowned_brands_sub_title') ); ?>
				</p>
			</div>
		<?php } ?>
		<div class="content-wrap">
			<?php foreach( $renowned_brand_array as $each_renownedbrand ){ ?>
				<article class="renowned-items">
					<?php if ( isset( $each_renownedbrand['ID'] )  && !empty( $each_renownedbrand['ID'] ) ){ 
							$cat_url = '';
							if( isset( $each_renownedbrand['category'] ) && !empty( $each_renownedbrand['category'] ) ) {
								$cat_url = $each_renownedbrand['category'];
							}
						?>
						<figure class= "featured-image">
							<a href="<?php echo esc_url( get_category_link( $cat_url ) ); ?>">
								<img src="<?php echo esc_url( $each_renownedbrand['ID'] ); ?>">
							</a>	
						</figure>
					<?php } ?>
					<?php if ( isset( $each_renownedbrand['category'] ) && !empty( $each_renownedbrand['category'] ) ){ ?>
						<h5 class="entry-title">
							<a href="<?php echo esc_url( get_category_link( $each_renownedbrand ['category'] ) ); ?>">
								<?php echo esc_html($product_cat[$each_renownedbrand['category'] ] ); ?>
							</a>	
						</h5>
					<?php } ?>
				</article>	
			<?php } ?>
		</div>
	</section>
<?php } ?>

