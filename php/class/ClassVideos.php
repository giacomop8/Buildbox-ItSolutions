<?php

if(!defined('ABSPATH')){
    exit;
}
if(!class_exists('Videos')){
    class Videos {

        public function __construct() {

            // Inicializar
            add_action('init', array($this, 'register_cpt_videos'), 0);
            add_action('init', array($this, 'register_taxonomy_video'), 0);
            add_action('init', array($this, 'create_terms_video_type'), 0);

            add_action('after_setup_theme', array($this, 'theme_setup'));

            add_action('save_post', array($this, 'save_post_video'), 10, 2);

            // Metaboxes
            add_action('add_meta_boxes', array($this, 'add_metabox_video'));
        }

        public function theme_setup() {
            add_theme_support('post-thumbnails');
        }
        
        // CREATE POST TYPE
        public function register_cpt_videos() {

            $labels = [
                'name' => 'Vídeos', 
                'singular_name' => 'Vídeo', 
                'menu_name' => 'Vídeos', 
                'name_admin_bar' => 'Vídeo', 
                'archives' => 'Todos os vídeos',
                'attributes' => 'Atributos de Vídeo',
                'all_items' => 'Todos os Vídeos',
                'add_new_item' => 'Adicionar novo Vídeo',
                'add_new' => 'Adicionar novo Vídeo',
                'new_item' => 'Novo Vídeo',
                'edit_item' => 'Editar Vídeo',
                'update_item' => 'Atualizar Vídeo',
                'view_item' => 'Ver Vídeo',
                'view_items' => 'Ver Vídeos',
                'search_items' => 'Buscar Vídeos',
                'not_found' => 'Não Encontrado',
                'not_found_in_trash' => 'Não Encontrado na Lixeira',
                'featured_image' => 'Imagem do Vídeo',
                'set_featured_image' => 'Alterar imagem do Vídeo',
                'remove_featured_image' => 'Remover imagem do Vídeo',
                'use_featured_image' => 'Usar como imagem do Vídeo',
                'insert_into_item' => 'Inserir no vídeo',
                'uploaded_to_this_item' => 'Enviado para este filme',
            ];

            $args = [
                'label' => 'Vídeos',
                'description' => 'Vídeos',
                'labels' => $labels,
                'public' => true,
                'supports' => array('title','editor','thumbnail'),
                'hierarchical' => false,
                'show_ui' => true,
                'show_in_menu' => true,
                'menu_position' => 5,
                'show_in_admin_bar' => true,
                'show_in_nav_menus' => true,
                'can_export' => true,
                'has_archive' => true,
                'exclude_from_search' => false,
                'publicly_queryable' => true,
                'show_in_rest' => false,        // criar posts moderno
                'menu_icon' => 'dashicons-video-alt',
                'taxonomies' => array('video_type')
            ];

            register_post_type ( 'video', $args );
        }


        // METABOXES

        public function add_metabox_video() {
            add_meta_box(
                'video_metabox',
                'Informações do Vídeo',
                [$this, 'exibir_metabox_video'],
                'video',
                'normal',
                'high'
            );
        }
        
        public function exibir_metabox_video($post) {
            require_once( get_template_directory() . '/templates/metaboxes/bx_play.php');
        }

        public function save_post_video($post_id) {
            // Verifica se o tipo de post é 'video'
            if ('video' !== get_post_type($post_id)) {
                return;
            }
        
            // Verifica se o nonce do vídeo está definido e é válido
            if (isset($_POST['video_nonce']) && !wp_verify_nonce($_POST['video_nonce'], 'video_nonce')) {
                return;
            }
        
            // Verifica se a ação atual é de autosave
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return;
            }
        
            // Verifica as permissões do usuário
            if (isset($_POST['post_type']) && ($_POST['post_type'] === 'video')) {
                if (!current_user_can('edit_page', $post_id) && !current_user_can('edit_post', $post_id)) {
                    return;
                }
            }
        
            // Verifica se a ação é de edição de post
            if (isset($_POST['action']) && ($_POST['action'] == 'editpost')) {
                $video_nonce = isset($_POST['video_nonce']) ? $_POST['video_nonce'] : '';
        
                // Verifica se o nonce do vídeo é válido
                if (!wp_verify_nonce($video_nonce, 'video_nonce')) {
                    return;
                }
        
                $bx_play_video_duration = "bx_play_video_duration";
                $bx_play_video_ID = "bx_play_video_ID";
        
                $novo_texto = isset($_POST[$bx_play_video_duration]) ? sanitize_text_field($_POST[$bx_play_video_duration]) : '';
                $novo_link = isset($_POST[$bx_play_video_ID]) ? sanitize_text_field($_POST[$bx_play_video_ID]) : '';
        
                // Atualiza os metadados apenas se os novos valores não estiverem vazios
                if (!empty($novo_texto)) {
                    update_post_meta($post_id, $bx_play_video_duration, $novo_texto);
                }
        
                if (!empty($novo_link)) {
                    update_post_meta($post_id, $bx_play_video_ID, $novo_link);
                }
            }
        }
        


        // TAXONOMIAS
        public function register_taxonomy_video() {
            $labels = [
                'name'              => 'Categorias de Vídeos',
                'singular_name'     => 'Categoria de Vídeo',
                'search_items'      => 'Buscar categorias de Vídeo',
                'all_items'         => 'Todas as categorias de Vídeo',
                'parent_item'       => 'Categoria Pai',
                'parent_item_colon' => 'Categoria Pai:',
                'edit_item'         => 'Editar categoria de Vídeo',
                'update_item'       => 'Atualizar categoria de Vídeo',
                'add_new_item'      => 'Adicionar nova categoria de Vídeo',
                'new_item_name'     => 'Nova categoria de Vídeo',
                'menu_name'         => 'Categorias de Vídeo',
            ];

            $args = [
                'labels'            => $labels,
                'hierarchical'      => true,
                'public'            => true,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => array('slug' => 'geral'), // Slug da taxonomia na URL.
            ];

            register_taxonomy('video_type', array('video'), $args);
        }

        public function create_terms_video_type() {

            $categorias = array(

                'Filmes',
                'Documentários',
                'Séries'
            );

            foreach ($categorias as $index => $categoria) {

                $existe = term_exists($categoria, 'video_type');

                if (!$existe) {

                    $term_id = wp_insert_term($categoria, 'video_type');

                    if ($index === 0 && !is_wp_error($term_id)) {
                        update_option('default_category', $term_id['term_id']);
                    }
                }
            }
        }
    }
}

new Videos();