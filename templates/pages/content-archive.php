<?php get_template_part('templates/components/content','menumobile'); ?>
<section id="archive" class="flex p_100">
    <div class="flex gap_30 column">
        <h1 class="titulo_arch_categoria"><?php echo esc_html(single_term_title()); ?></h1>
        <p><?php echo esc_html(term_description()); ?></p>
    </div>
    <div class="posts_archive flex">
        <?php
            if(have_posts()) : while(have_posts()) : the_post();
            ?>
            <section class="post_arch flex column justify_left gap_10">
                <div class="flex column gap_10 wrap">
                    <div>
                        <a href="<?php echo get_permalink(); ?>">
                            <?php the_post_thumbnail('full', array('class' => 'thumb_arch')); ?>
                        </a>
                    </div>
                    <?php
                        $bx_play_video_duration = get_post_meta(get_the_ID(), 'bx_play_video_duration', true);
                    ?>
                    <span class="duracao_detalhe">
                        <?php echo $bx_play_video_duration; ?>
                    </span>
                </div>
                <a href="<?php echo get_permalink(); ?>"><?php the_title('<h1 class="titulo_arch">', '</h1>'); ?></a>
            </section>
            
            <?php
        endwhile;
    else:
        ?>
            <section class="sem_resultados">
                <p>Sem vídeos cadastrados</p>
            </section>
        <?php
    endif;
    
    wp_reset_postdata();
?>
        <script>
            trocar_cor();
        </script>
    </div>
</section>