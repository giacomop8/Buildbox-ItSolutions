<section id="single" class="">
    <div class="post_single flex column gap_50">
        <?php
            if(have_posts()) : while(have_posts()) : the_post();

            ?>
                <section class="detalhes_single flex column justify_left gap_20">
                    <div class="flex gap_10 wrap">
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
                    </div>
                    <a href="<?php echo get_permalink(); ?>"><?php the_title('<h1 class="titulo_single">', '</h1>'); ?></a>
                </section>
                <section id="video_single">
                    <?php
                        $bx_play_video_ID = get_post_meta(get_the_ID(), 'bx_play_video_ID', true);
                        parse_str(parse_url($bx_play_video_ID, PHP_URL_QUERY), $url_params);
                        $video_id = $url_params['v'];
                        $embed_url = 'https://www.youtube.com/embed/' . $video_id;
                    ?>
                    <iframe src="<?php echo esc_url($embed_url); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </section>
                <section class="sinopse">
                    <?php the_content(); ?>
                </section>
            
            
                <?php endwhile;
            else:
                ?>
                <section class="sem_resultados">
                    <p>Sem vídeo cadastrado</p>
                </section>
        
            <?php endif;
        wp_reset_postdata(); ?>
    </div>
</section>
<?php get_template_part('templates/components/content','menumobile'); ?>