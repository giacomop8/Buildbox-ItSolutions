<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php wp_head(); ?>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri() . '/img/play-light.svg' ?>" type="image/x-icon">
    </head>
    <body>
        <header id="secao_menu">
            <div id="limite_menu" class="flex align_center justify_between">
                <section class="logo flex align_center justify_center">
                    <?php
                        $logo_id = get_theme_mod('custom_logo');
    
                        if ($logo_id) {
                            echo get_custom_logo();
                        } else {
                            $logo_url = get_template_directory_uri() . '/img/play_logo.png'; // Substitua pela URL da imagem desejada
                            echo '<img src="' . esc_url($logo_url) . '" alt="Logomarca">';
                        }
                    ?>
                </section>
                <section id="menu">
                    <?php
                        if (has_nav_menu('menu_principal')) {
                            wp_nav_menu(array(
                                'menu_class' => 'menu_principal',
                                'theme_location' => 'menu_principal',
                                'container' => false
                            ));
                        } else {
                            echo '<p>Adicione páginas ao Menu.</p>';
                        }
                    ?>
                </section>
            </div>
        </header>