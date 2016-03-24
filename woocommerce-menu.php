<?php
/*
Plugin Name: Woocommerce menu
Plugin URI: 
Description: Creates a horizontal menu using product pictures, with links to pages.
Version: 1.0.0
Author: Martin Bo Kristensen Grønholdt
Author URI: http://groenholdt.net
*/
/*
Woocommerce menu (Wordpress Plugin)
Copyright (C) 2016 Martin Bo Kristensen Grønholdt

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

add_shortcode('woocommerce-menu', 'woocommerce_menu_handler');

function woocommerce_menu_handler($atts) 
{
		global $woocommerce_loop;
		
		$atts = shortcode_atts( array(
			'entries' => '3',
			'product_ids' => '1, 2, 3',
			'product_page_ids' => '0, 0, 0'
		), $atts);
		
		$product_ids = explode(',', trim($atts['product_ids']));
		$product_page_ids = explode(',', trim($atts['product_page_ids']));
		
		$_pf = new WC_Product_Factory();  
		
		ob_start();
?>
<div class="woocommerce columns-4">
	<ul class="products columns-4">
<?php
		for( $i = 0; $i < $atts['entries']; $i++)
		{
			if ( $i === 0 )
			{
				$classes = "first item-prod-wrap wow flipInY product type-product status-publish has-post-thumbnail product-type-simple instock";
			}
			else
			{
				$classes = "item-prod-wrap wow flipInY product type-product status-publish has-post-thumbnail product-type-simple instock";
			}
?>
		<li class="<?php echo $classes; ?>" data-wow-delay="0.5s">
			<a href="<?php echo get_permalink( $product_page_ids[$i] ); ?>">
				<div class="collection_desc clearfix">
					<div class="title-cart" style="margin: 0 auto; text-align: left;">
						<a href="<?php echo get_permalink( $product_page_ids[$i] ); ?>" class="collection_title">
							<h3><?php echo get_the_title( $product_page_ids[$i] ); ?></h3>
						</a>
					</div>
				</div>
				<div class="collection_combine item-img">
					<a href="<?php echo get_permalink( $product_page_ids[$i] ); ?>" class="full-outer">
						<?php $product = $_pf->get_product($product_ids[$i]); ?>
						<?php echo $product->get_image($size = 'shop_catalog'); ?>
					</a>
				</div>
			</a>
		</li>
<?php
}
?>
	</ul>
</div>
<?php 
		return ob_get_clean();	
}
?>
