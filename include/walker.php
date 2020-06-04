<?php

/* Collection of Walker classes */
/*

	wp_nav_menu()

	<div class="menu-container">
		<ul> // start_lvl()
			<li><a><span> // start_el()

				</a></span>

				<ul>
				</li> // end_el()

			<li><a>Link</a></li>
			<li><a>Link</a></li>
			<li><a>Link</a></li>

		</ul> // end_lvl()
	</div>

*/

class Walker_Nav_Primary extends Walker_Nav_menu {

	function start_lvl( &$output, $depth ){ //ul
		$indent = str_repeat("\t",$depth);
		$submenu = ($depth > 0) ? ' sub-menu' : '';
		$output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){ //li a span

		$indent = ( $depth ) ? str_repeat("\t",$depth) : '';

		$li_attributes = '';
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$classes[] = ($args->walker->has_children) ? 'dropdown' : '';
		$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
		$classes[] = 'menu-item-' . $item->ID;
		if( $depth && $args->walker->has_children ){
			$classes[] = 'dropdown-submenu';
		}

		$class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr($class_names) . '"';

		$id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';

		$attributes .= ( $args->walker->has_children ) ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ( $depth == 0 && $args->walker->has_children ) ? ' <b class="caret"></b></a>' : '</a>';
		$item_output .= $args->after;

		$output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

	}
}

class WP_Widget_Categories_BS extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname'   => 'widget_categories_bs',
		                     'description' => __( "A list or dropdown of categories for Bootstrap 3.0" )
		);
		parent::__construct( 'categories', __( 'Boostrap Categories' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Categories' ) : $instance['title'], $instance, $this->id_base );
		$c     = ! empty( $instance['count'] ) ? '1' : '0';
		$h     = ! empty( $instance['hierarchical'] ) ? '1' : '0';
		$d     = ! empty( $instance['dropdown'] ) ? '1' : '0';

		echo $before_widget;
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		$cat_args = array( 'orderby' => 'name', 'show_count' => $c, 'hierarchical' => $h );
		if ( $d ) {
			$cat_args['show_option_none'] = __( 'Select Category' );
			wp_dropdown_categories( apply_filters( 'widget_categories_dropdown_args', $cat_args ) );
		}
	}
}