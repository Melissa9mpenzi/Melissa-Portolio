<?php

//Custom Megamenu extending walker class
//Following the flow start_el, start_lvl, display_element, end_lvl, end_el

class custom_Nav_Walker extends Walker_Nav_Menu {
    
    protected $descr = ''; // Define $descr as a property
    
    public function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
        $classes = array('menu-item');
        if ($depth == 1) {
            $classes[] = 'sub-menu-item';
        }
        if ($depth == 2) {
            $classes[] = 'third-menu-item';
        }
        
        $output .= '<li class="' . esc_attr(implode(' ', $classes)) . '">';
        // Include the menu item content
        $output .= '<a href="' . esc_attr($item->url) . '">' . esc_html($item->title) . '</a>';
        
        // Include the menu item description
        if ($depth === 0 && !empty($item->description)) {
            $this->descr = '<span class="menu-item-description">' . esc_html($item->description) . '</span>';  
        }
        
    }
    
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '<div class="columns sub-menu">';
        $output .= '<div class="column left-side">';
        $output .= '<ul class="sub-menu-item level-' . $depth . '">';
    }
    
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '</ul>';
        $output .= '</div>';
        $output .= '<div class="column right-side">';
        $output .= $this->descr;
        $output .= '</div>';
        $output .= '</div>';
    }
    
    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        
    }

}