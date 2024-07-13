<section class="largura_maxima flex_post gap_30 wrap">
    <article class="flex column gap_30 flex2 texto_descritivo">
        <div class="">
            <?php the_title('<h1 class="titulo_post">', '</h1>'); ?>
        </div>
        <div class="flex2 post_descricao">
            <?php the_content(); ?>
        </div>
    </article>
    <aside class="menu_home">
        <?php get_template_part("templates/components/content","menu-lateral"); ?>
    </aside>
</section>