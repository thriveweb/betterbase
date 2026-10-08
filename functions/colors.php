<?php

/*-----------------------------------------------------------------------
    Colours — single source for CSS variables and block/editor pickers
-----------------------------------------------------------------------*/

function betterbase_colors() {
    return array(
        'white'      => array('hex' => '#ffffff', 'label' => 'White'),
        'light-grey' => array('hex' => '#f1f1f5', 'label' => 'Light Grey', 'background' => true),
        'blue'       => array('hex' => '#5863F8', 'label' => 'Blue', 'dark' => true, 'background' => true),
        'black'      => array('hex' => '#171D1C', 'label' => 'Black', 'dark' => true, 'background' => true),
        'grey'       => array('hex' => '#aaaaaa', 'label' => 'Grey'),
        'red'        => array('hex' => '#ff1414', 'label' => 'Red', 'tinymce' => false),
    );
}

function betterbase_color_css() {
    $css = '';

    foreach (betterbase_colors() as $name => $color) {
        $css .= '--' . $name . ': ' . $color['hex'] . '; ';
    }

    return ':root { ' . trim($css) . ' }';
}

function betterbase_is_dark_color($name) {
    return !empty(betterbase_colors()[$name]['dark']);
}

function betterbase_background_color_options() {
    $colors = betterbase_colors();
    $options = array(
        array(
            'name'  => 'None',
            'slug'  => 'none',
            'color' => $colors['white']['hex'] ?? '#ffffff',
        ),
    );

    foreach ($colors as $name => $color) {
        if (!empty($color['background'])) {
            $options[] = array(
                'name'  => $color['label'],
                'slug'  => $name,
                'color' => $color['hex'],
            );
        }
    }

    return $options;
}
