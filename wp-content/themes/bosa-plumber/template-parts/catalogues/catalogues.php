<?php
$categorylistoneID = get_theme_mod( 'catalog_image_one', '' );
$categorylistone = get_theme_mod( 'catalog_list_one', '' );

$categorylisttwoID = get_theme_mod( 'catalog_image_two', '' );
$categorylisttwo = get_theme_mod( 'catalog_list_two', '' );

$categorylistthreeID = get_theme_mod( 'catalog_image_three', '' );
$categorylistthree = get_theme_mod( 'catalog_list_three', '' );

$categorylistfourID = get_theme_mod( 'catalog_image_four', '' );
$categorylistfour = get_theme_mod( 'catalog_list_four', '' );

$categorylistfiveID = get_theme_mod( 'catalog_image_five', '' );
$categorylistfive = get_theme_mod( 'catalog_list_five', '' );

$categorylistsixID = get_theme_mod( 'catalog_image_six', '' );
$categorylistsix = get_theme_mod( 'catalog_list_six', '' );

$categorylistsevenID = get_theme_mod( 'catalog_image_seven', '' );
$categorylistseven = get_theme_mod( 'catalog_list_seven', '' );

$categorylisteightID = get_theme_mod( 'catalog_image_eight', '' );
$categorylisteight = get_theme_mod( 'catalog_list_eight', '' );

$catalog_list_one_array = array();
$catalog_list_two_array = array();
$has_list_one = false;
$has_list_two = false;
if( !empty( $categorylistoneID ) || !empty( $categorylistone ) ){
	$catalog_list_one = wp_get_attachment_image_src( $categorylistoneID ,'bosa-420-300');
 	if ( is_array( $catalog_list_one ) ){
 		$has_list_one = true;
   	 	$catalog_lists_one = $catalog_list_one[0];
   	 	$catalog_list_one_array['image_one'] ['ID'] = $catalog_lists_one;	 	
  	}
  	if ( !empty( $categorylistone ) ){
 		$has_list_one = true;
   	 	$catalog_list_one_array['image_one']['category'] = $categorylistone;	
  	}
}
if( !empty( $categorylisttwoID ) || !empty( $categorylisttwo ) ){
	$catalog_list_two = wp_get_attachment_image_src( $categorylisttwoID ,'bosa-420-300');
 	if ( is_array( $catalog_list_two ) ){
 		$has_list_one = true;
   	 	$catalog_lists_two = $catalog_list_two[0];
   	 	$catalog_list_one_array['image_two'] ['ID'] = $catalog_lists_two;	 	
  	}
  	if ( !empty( $categorylisttwo ) ){
 		$has_list_one = true;
   	 	$catalog_list_one_array['image_two']['category'] = $categorylisttwo;	
  	}
}
if( !empty( $categorylistthreeID ) || !empty( $categorylistthree ) ){
	$catalog_list_three = wp_get_attachment_image_src( $categorylistthreeID ,'bosa-420-300');
 	if ( is_array( $catalog_list_three ) ){
 		$has_list_one = true;
   	 	$catalog_lists_three = $catalog_list_three[0];
   	 	$catalog_list_one_array['image_three'] ['ID'] = $catalog_lists_three;	 	
  	}
  	if ( !empty( $categorylistthree ) ){
 		$has_list_one = true;
   	 	$catalog_list_one_array['image_three']['category'] = $categorylistthree;	
  	}
}
if( !empty( $categorylistfourID ) || !empty( $categorylistfour ) ){
	$catalog_list_four = wp_get_attachment_image_src( $categorylistfourID ,'bosa-420-300');
 	if ( is_array( $catalog_list_four ) ){
 		$has_list_one = true;
   	 	$catalog_lists_four = $catalog_list_four[0];
   	 	$catalog_list_one_array['image_four'] ['ID'] = $catalog_lists_four;	 	
  	}
  	if ( !empty($categorylistfour) ){
 		$has_list_one = true;
   	 	$catalog_list_one_array['image_four']['category'] = $categorylistfour;	
  	}
}
if( !empty( $categorylistfiveID ) || !empty( $categorylistfive ) ){
	$catalog_list_five = wp_get_attachment_image_src( $categorylistfiveID ,'bosa-420-300');
 	if ( is_array( $catalog_list_five ) ){
 		$has_list_two = true;
   	 	$catalog_lists_five = $catalog_list_five[0];
   	 	$catalog_list_two_array['image_five'] ['ID'] = $catalog_lists_five;	 	
  	}
  	if ( !empty( $categorylistfive ) ){
 		$has_list_two = true;
   	 	$catalog_list_two_array['image_five']['category'] = $categorylistfive;	
  	}
}
if( !empty( $categorylistsixID ) || !empty( $categorylistsix ) ){
	$catalog_list_six = wp_get_attachment_image_src( $categorylistsixID ,'bosa-420-300');
 	if ( is_array( $catalog_list_six ) ){
 		$has_list_two = true;
   	 	$catalog_lists_six = $catalog_list_six[0];
   	 	$catalog_list_two_array['image_six'] ['ID'] = $catalog_lists_six;	 	
  	}
  	if ( !empty( $categorylistsix ) ){
 		$has_list_two = true;
   	 	$catalog_list_two_array['image_six']['category'] = $categorylistsix;	
  	}
}
if( !empty( $categorylistsevenID ) || !empty( $categorylistseven ) ){
	$catalog_list_seven = wp_get_attachment_image_src( $categorylistsevenID ,'bosa-420-300');
 	if ( is_array( $catalog_list_seven ) ){
 		$has_list_two = true;
   	 	$catalog_lists_seven = $catalog_list_seven[0];
   	 	$catalog_list_two_array['image_seven'] ['ID'] = $catalog_lists_seven;	 	
  	}
  	if ( !empty( $categorylistseven ) ){
 		$has_list_two = true;
   	 	$catalog_list_two_array['image_seven']['category'] = $categorylistseven;	
  	}
}
if( !empty( $categorylisteightID ) || !empty( $categorylisteight ) ){
	$catalog_list_eight = wp_get_attachment_image_src( $categorylisteightID ,'bosa-420-300');
 	if ( is_array( $catalog_list_eight ) ){
 		$has_list_two = true;
   	 	$catalog_lists_eight = $catalog_list_eight[0];
   	 	$catalog_list_two_array['image_eight'] ['ID'] = $catalog_lists_eight;	 	
  	}
  	if ( !empty( $categorylisteight ) ){
 		$has_list_two = true;
   	 	$catalog_list_two_array['image_eight']['category'] = $categorylisteight;	
  	}
}

$product_cat = bosa_plumber_get_product_categories();

if( !get_theme_mod( 'disable_catalogues_section', true ) && ( $has_list_one || $has_list_two || get_theme_mod( 'catalog_list_title_one' ) || get_theme_mod( 'catalog_list_title_two' ) ) ){ ?>
	<section class="section-catalogues-area">
		<div class="row">
			<?php if( $has_list_one || get_theme_mod( 'catalog_list_title_one' ) ){ ?>
				<div class="col-lg-6 px-lg-4">
					<div class="category-section">
						<?php if( get_theme_mod( 'catalog_list_title_one' ) ){ ?>
							<div class="section-title-wrap">
								<h2 class="section-title">	
									<?php echo esc_html( get_theme_mod( 'catalog_list_title_one' ) ); ?>
								</h2>
							</div>
						<?php } ?>
						<div class="content-wrap">
							<div class="row">
								<?php foreach( $catalog_list_one_array as $each_cataloglistone ){ ?>
									<div class="col-sm-6">
										<article class="catalogue-content-wrap">
											<?php 
											if ( isset( $each_cataloglistone['ID'] ) && !empty( $each_cataloglistone['ID'] ) ){
												$cat_url = '';
												if( isset( $each_cataloglistone['category'] ) && !empty( $each_cataloglistone['category'] ) ) {
													$cat_url = $each_cataloglistone['category'];
												}
											?>
												<figure class= "featured-image">
													<a href="<?php echo esc_url( get_category_link( $cat_url ) ); ?>">
														<img src="<?php echo esc_url( $each_cataloglistone['ID'] ); ?>">
													</a>	
												</figure>
											<?php } ?>
											<?php if ( isset( $each_cataloglistone['category'] ) && !empty( $each_cataloglistone['category'] ) ){ ?>
												<h5 class="entry-title">
													<a href="<?php echo esc_url( get_category_link( $each_cataloglistone ['category'] ) ); ?>">
														<?php echo esc_html($product_cat[$each_cataloglistone['category'] ] ); ?>
													</a>
													<a href="<?php echo esc_url( get_category_link( $each_cataloglistone ['category'] ) ); ?>">
														<i class="fas fa-external-link"></i>
													</a>	
												</h5>
											<?php } ?>
										</article>	
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
			<?php if( $has_list_two || get_theme_mod( 'catalog_list_title_two' ) ){ ?>
				<div class="col-lg-6 px-lg-4">
					<div class="category-section">
						<?php if( get_theme_mod( 'catalog_list_title_two' ) ){ ?>
							<div class="section-title-wrap">
								<h2 class="section-title">	
									<?php echo esc_html( get_theme_mod( 'catalog_list_title_two' ) ); ?>
								</h2>
							</div>
						<?php } ?>
						<div class="content-wrap">
							<div class="row">
								<?php foreach( $catalog_list_two_array as $each_cataloglisttwo ){ ?>
									<div class="col-sm-6">
										<article class="catalogue-content-wrap">
											<?php 
											if ( isset( $each_cataloglisttwo['ID'] ) && !empty( $each_cataloglisttwo['ID'] ) ){
												$cat_url = '';
												if( isset( $each_cataloglisttwo['category'] ) && !empty( $each_cataloglisttwo['category'] ) ) {
													$cat_url = $each_cataloglisttwo['category'];
												}
											?>
												<figure class= "featured-image">
													<a href="<?php echo esc_url( get_category_link( $cat_url ) ); ?>">
														<img src="<?php echo esc_url( $each_cataloglisttwo['ID'] ); ?>">
													</a>	
												</figure>
											<?php } ?>
											<?php if ( isset( $each_cataloglisttwo['category'] ) && !empty( $each_cataloglisttwo['category'] ) ){ ?>
												<h5 class="entry-title">
													<a href="<?php echo esc_url( get_category_link( $each_cataloglisttwo ['category'] ) ); ?>">
														<?php echo esc_html($product_cat[$each_cataloglisttwo['category'] ] ); ?>
													</a>
													<a href="<?php echo esc_url( get_category_link( $each_cataloglisttwo ['category'] ) ); ?>">
														<i class="fas fa-external-link"></i>
													</a>	
												</h5>
											<?php } ?>
										</article>	
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</section>
<?php } ?>

