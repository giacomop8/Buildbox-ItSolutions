<?php

$meta = get_post_meta($post->ID);

// Configurações
$video_nonce = wp_create_nonce('video_nonce');

// Inicializa os arrays de texto e link
$bx_play_video_duration = get_post_meta($post->ID, 'bx_play_video_duration', true);
$bx_play_video_ID = get_post_meta($post->ID, 'bx_play_video_ID', true);

?>
<table class="tabela_metabox">
    <input type="hidden" name="video_nonce" value="<?= esc_attr($video_nonce) ?>">
    <tr>
        <th>
            <label for="bx_play_video_duration">Tempo de Duração:</label>
        </th>
        <td>
            <input
                type="text"
                name="bx_play_video_duration"
                id="bx_play_video_duration"
                value="<?= (isset($bx_play_video_duration)) ? esc_html($bx_play_video_duration) : '' ?>">
        </td>
    </tr>
    <tr>            
        <th>
            <label for="bx_play_video_ID">Embed de Vídeo: <?php echo isset($textos) ? $textos : ''; ?></label>
        </th>
        <td>
            <input
                type="url"
                name="bx_play_video_ID"
                id="bx_play_video_ID"
                value="<?= (isset($bx_play_video_ID)) ? esc_url($bx_play_video_ID) : '' ?>">
        </td>
    </tr>
</table>
