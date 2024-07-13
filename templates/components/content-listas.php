<!-- DADOS -->
<?php

    $categorias = [ 'filmes', 'documentarios', 'series' ];

    foreach ($categorias as $categoria) {

        $query = new WP_Query(array(
            'post_type' => 'video',
            'orderby' => 'date', // Ordenar por data
            'order' => 'DESC', // Do mais recente para o mais antigo
            'tax_query' => array(
                array(
                    'taxonomy' => 'video_type', // Nome da sua taxonomia personalizada
                    'field'    => 'slug',
                    'terms'    => $categoria, // Slug da categoria personalizada
                ),
            ),
        ));
        $titulo_categoria = get_term_by('slug', $categoria, 'video_type');
        ?>
        <!-- HTML -->
        <section id="secao_listas" class="flex column gap_20">
            <div class="flex listas column gap_20">
                <h1 class="titulo_categoria"><?php echo esc_html($titulo_categoria->name); ?></h1>
                <aside class="flex gap_20">
                    <?php
                
                        if ($query->have_posts()) :
                            while ($query->have_posts()) :
                
                                $query->the_post();
                                
                                ?>
                                <section class="post_lista flex column justify_left gap_30">
                                    <div class="flex gap_20 column wrap">
                                        <div>
                                            <a href="<?php echo get_permalink(); ?>">
                                                <?php the_post_thumbnail('full', array('class' => 'thumb_lista')); ?>
                                            </a>
                                        </div>
                                        <span class="duracao_detalhe">
                                            <?php
                                                $bx_play_video_duration = get_post_meta(get_the_ID(), 'bx_play_video_duration', true);
                                                echo $bx_play_video_duration;
                                            ?>
                                        </span>
                                    </div>
                                    <a href="<?php echo get_permalink(); ?>"><?php the_title('<h1 class="titulo_lista">', '</h1>'); ?></a>
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
                </aside>
            </div>
        </section>
    <?php } ?>