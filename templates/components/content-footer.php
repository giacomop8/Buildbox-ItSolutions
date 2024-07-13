    <footer class="">
        <div class="limite_footer flex column gap_20 justify_left">
            <section class="logo flex align_center gap_10">
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
            <section>
                <p>&copy <?php echo date('Y'); ?> - Play - Todos os direitos reservados.</p>
            </section>
        </div>
    </footer>
</body>
</html>
<?php wp_footer();