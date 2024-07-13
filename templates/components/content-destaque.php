<section id="secao_destaque" class="flex">
    <div class="efeito_escuro"></div>
    <?php
        $query = new WP_Query(array(
            'post_type' => 'video',
            'posts_per_page' => 1, // Apenas um post
            'orderby' => 'date', // Ordenar por data
            'order' => 'DESC', // Do mais recente para o mais antigo
        ));

        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();

                the_post_thumbnail('full', array('class' => 'thumb_destaque'));
                ?>
                <aside class="conteudo flex column justify_center gap_30">
                    <div class="flex gap_20 wrap">
                        <?php
                            $termos = get_the_terms(get_the_ID(), 'video_type');

                            if ($termos && !is_wp_error($termos)) {
                                foreach ($termos as $termo) {
                                    
                                    $link_archive = get_term_link($termo);
                                    ?>
                                    <a class="categoria_detalhe" href="<?php echo esc_url($link_archive); ?>">
                                        <span>
                                            <?php echo $termo->name; ?>
                                        </span>
                                    </a>
                                <?php }
                            }
                            $bx_play_video_duration = get_post_meta(get_the_ID(), 'bx_play_video_duration', true);
                            ?>
                            <span class="duracao_detalhe">
                                <?php echo $bx_play_video_duration; ?>
                            </span>
                            <?php
                        ?>
                    </div>
                    <?php the_title('<h1 class="titulo_destaque">', '</h1>'); ?>
                    <a class="mais_info_detalhes" href="<?php echo get_permalink(); ?>">Mais informações</a>
                </aside>
                
                <?php
            endwhile;
        else:
            ?>
                <section class="sem_resultados justify_center">
                    <p>Sem vídeos cadastrados</p>
                </section>
            <?php
        endif;
        
        wp_reset_postdata();
    ?>
</section>