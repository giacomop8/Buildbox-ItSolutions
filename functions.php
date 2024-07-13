<?php

if(!defined('ABSPATH')){
    exit;
}
if(!class_exists('Play')){
    

    class Play {

        public function __construct() {

            require_once(get_template_directory() . '/php/class/ClassVideos.php');
            require_once(get_template_directory() . '/php/class/ClassLayouts.php');

            // GANCHOS DE AÇÃO
            
            add_action('init', array($this,'editar_post_type_post'));
            add_action('after_setup_theme',array($this,'adicionar_menu'));        
            add_action('wp_enqueue_scripts',array($this,'scripts'));
        }
        
        public function editar_post_type_post() {
            
            $args = get_post_type_object('post');
            $args->show_in_menu = false;
        
            // Atualize as configurações do tipo de post 'post'
            register_post_type('post', $args);
        }
        
        public function adicionar_menu() {
            register_nav_menus(
                array(
                    'menu_principal' => 'Menu Principal'
                )
            );
        }

        public function scripts() {
            wp_enqueue_script('script-js', get_template_directory_uri().'/js/script.js','1', true);
            wp_enqueue_style('estilo-padrao', get_template_directory_uri().'/style.css');
            wp_enqueue_script('popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', array('jquery'), '1', true);
        }
    }

    new Play();
}