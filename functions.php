<?php
/** 
 * Skinny Theme Block.
 * 
 * This file is not required by WordPress nor Theme Check but use it for theme functional/features purpose.
 * 
 * @package skinny-theme-block
 * @since 0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


if (!function_exists('skinnythemeblockEnqueueScripts')) {
    /**
     * Enqueue styles for front pages.
     */
    function skinnythemeblockEnqueueScripts()
    {
        $theme = wp_get_theme();
        $themeVersion = $theme->get('Version');
        if (!is_string($themeVersion) || empty($themeVersion)) {
            $themeVersion = false;
        }
        unset($theme);

        wp_enqueue_style('stylesheet', get_stylesheet_uri(), [], $themeVersion);
        wp_enqueue_style('design', get_stylesheet_directory_uri() . '/assets/css/design.css', [], $themeVersion);
        unset($themeVersion);
    }// skinnythemeblockEnqueueScripts
}
add_action('wp_enqueue_scripts', 'skinnythemeblockEnqueueScripts');


if (!function_exists('skinnythemeblockAddEditorStyle')) {
    /**
     * Add styles for editor.
     */
    function skinnythemeblockAddEditorStyle()
    {
        add_editor_style([
            'style.css',
            'assets/css/design.css'
        ]);
    }// skinnythemeblockAddEditorStyle
}
add_action('after_setup_theme', 'skinnythemeblockAddEditorStyle');


if (!function_exists('skinnythemeblockAddThemeSupport')) {
    /**
     * Add theme feature.
     */
    function skinnythemeblockAddThemeSupport()
    {
        // `load_theme_textdomain()` is not required by WordPress nor Theme Check.
        // `load_theme_textdomain()` is for load translation correctly.
        load_theme_textdomain('skinny-theme-block', get_template_directory() . '/languages');
    }// skinnythemeblockAddThemeSupport
}
add_action('after_setup_theme', 'skinnythemeblockAddThemeSupport');


if (!function_exists('skinnythemeblockAddPartAreas')) {
    /**
     * Add areas.
     * 
     * @param array $areas
     * @return array
     */
    function skinnythemeblockAddPartAreas(array $areas): array
    {
        $areas[] = [
            'area'        => 'sidebar',
            'area_tag'    => 'aside',
            'label'       => __('Sidebar', 'skinny-theme-block'),
            'description' => __('Right side bar', 'skinny-theme-block'),
            'icon'        => 'sidebar',
	];

        return $areas;
    }// skinnythemeblockAddPartAreas
}
add_filter('default_wp_template_part_areas', 'skinnythemeblockAddPartAreas');


if (!function_exists('skinnythemeblockAddPostClass')) {
    /**
     * Add post class to listing.
     * 
     * @param array $classes
     * @param array $css_classes
     * @param int $post_id
     * @return array
     */
    function skinnythemeblockAddPostClass(array $classes, array $css_classes, int $post_id)
    {
        if (is_admin()) {
            return $classes;
        }

        if (!in_array('each-post', $classes)) {
            $classes[] = 'each-post';
        }

        return $classes;
    }// skinnythemeblockAddPostClass
}
add_filter('post_class', 'skinnythemeblockAddPostClass', 10, 3);