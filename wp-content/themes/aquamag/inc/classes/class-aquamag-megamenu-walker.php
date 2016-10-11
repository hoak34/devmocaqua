<?php
/**
 * Custom wp_nav_menu walker for Mega menu.
 *
 * @package    AquaMag
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Aquamag_Megamenu_Walker_Nav extends Walker_Nav_Menu {

	private $in_sub_menu = 0;
	private $is_category_menu = 0;

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<div class=\"uk-width-1-4\"><ul class=\"uk-tab nav-tabs uk-tab-left\" data-uk-tab=\"{connect:'#tab-left-content'}\">\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul></div>\n";
		
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = $dropdown = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		// Detect first child of submenu then add class active
		if( $depth == 1 ) {
			if( ! $this->in_sub_menu ) {
				$classes[] = 'active'; 
				$this->in_sub_menu = 1;
			}
		}
		if( $depth == 0 ) {
			$this->in_sub_menu = 0;
		} 
		// End addition of active class for first item
		
		if ( $args->has_children ) {
			$classes[] = 'uk-parent dropdown-tab';
			$dropdown  = 'data-uk-dropdown=""';
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) .' '. $depth . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . $dropdown . '>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$args = (object) $args;
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output      .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		if ( $depth == 0 && $item->object == 'category' && ! count( $item->children ) == 0 ) {
			$output .= '<div class="uk-dropdown uk-dropdown-navbar alltabs"><div class="uk-grid dropdown-menu">';
		}

	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {

		if ( $depth == 0 && $item->object == 'category' && ! count( $item->children ) == 0 ) {
			$output .= '<div class="uk-width-3-4 tab-content">';
				$output .= '<ul id="tab-left-content" class="uk-switcher">';

					for ( $i = 0; $i < count( $item->children ); $i++ ) {
						$child = $item->children[$i];
						$output .= '<li class="uk-grid">';

							if ( $child->object == 'category' ) {

								$posts = new WP_Query( array( 'posts_per_page' => 3, 'cat' => $child->object_id ) );

								if ( $posts->have_posts() ) :
									while ( $posts->have_posts() ) : $posts->the_post();

										$output .= '<article class="uk-width-1-3">';
											if ( has_post_thumbnail() ) {
												$output .= '<a href="' . get_permalink() . '">' . get_the_post_thumbnail( get_the_ID(), 'aquamag-mm-thumb', array( 'alt' => esc_attr( get_the_title() ) ) ) . '</a>';
											}
											$output .= '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
										$output .= '</article>';

									endwhile;
								endif;

								wp_reset_postdata();

							}

						$output .= '</li>';
					}

				$output .= '</ul>';

			$output .= '</div><!-- .tab-content -->';
			$output .= '</div><!-- .alltabs -->';
			$output .= '</div><!-- .dropdown-menu -->';
		}

		$output .= '</li>';
	}

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		$id_field = $this->db_fields['id'];
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
		}
		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
	
}

/**
 * Add custom class if item has children/sub-menu
 *
 * @since  1.0.0
 * @param  array  $items
 * @return array
 */
function aquamag_menu_child_items( $items ) {
	
	$parents = array();
	foreach ( $items as $item ) {
		$item->children = array();
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'menu-parent-item'; 
	
			foreach ( $items as $citem ) {
				if ( $citem->menu_item_parent && $citem->menu_item_parent == $item->ID ) {
					$item->children[] = $citem;
				}
			}
		}
	}
	
	return $items;    
}
add_filter( 'wp_nav_menu_objects', 'aquamag_menu_child_items' );