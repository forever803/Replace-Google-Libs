<?php
/**
 * Plugin Name: Replace Google Libs
 * Plugin URI:  https://github.com/forever803/Replace-Google-Libs
 * Description: Use USTC Open Libs Service to replace Google's.
 * Author:      xzhang
 * Author URI:  https://github.com/forever803
 * Version:     1.0
 * License:     GPL
 */


/**
 * Silence is golden
 */
if (!defined('ABSPATH')) exit;

class Replace_Google_Libs
{

    /**
     * init Hook
     */
    public function __construct()
    {
        // add_filter('wp_print_scripts', array($this, 'ohMyScript'), 1000, 1);
        add_filter('wp_print_scripts', array($this, 'ustcReplaceScript'), 1000, 1);
    }


    /**
     * Use Qihoo 360 Open Libs Service to replace Google's.
     */
    public function ohMyScript()
    {
        global $wp_scripts;
        if($wp_scripts && $wp_scripts->registered){
            foreach ($wp_scripts->registered as $libs){
                $libs->src = str_replace('//ajax.googleapis.com', '//ajax.useso.com/', $libs->src);
            }
        }
    }

    /**
     * Use USTC Open Libs Service to replace Google's.
     */
    public function ustcReplaceScript()
    {
		$replace_pairs = array(
			'fonts.gstatic.com' => 'fonts-gstatic.lug.ustc.edu.cn',
			'fonts.googleapis.com' => 'fonts.lug.ustc.edu.cn',
			'ajax.googleapis.com' => 'ajax.lug.ustc.edu.cn',
			'storage.googleapis.com ' => 'storage-googleapis.lug.ustc.edu.cn',
			'themes.googleusercontent.com' => 'google-themes.lug.ustc.edu.cn',
			'gerrit.googlesource.com' => 'gerrit-googlesource.lug.ustc.edu.cn',
			'secure.gravatar.com' => 'gravatar.lug.ustc.edu.cn'
		);
        global $wp_scripts;
        if($wp_scripts && $wp_scripts->registered){
            foreach ($wp_scripts->registered as $libs){
				foreach ($replace_pairs as $search => $replace) {
					$libs->src = str_replace($search, $replace, $libs->src);
				}
            }
        }
    }
}

/**
 * bootstrap
 */
new Replace_Google_Libs;
