        <footer class="mastfoot mt-auto">
            <div class="inner">
                <a href="https://facebook.com/infernuspresence" target="_blank"><img id="facebook_logo" src="<?= get_template_directory_uri() ?>/images/facebook_logo.png" alt="Facebook" onmouseover="custom_appearance('facebook_logo', 45);" onmouseout="custom_fading('facebook_logo', 100, 45);" style="opacity: 45%;"></a>
                <a href="https://vk.com/infernuspresence" target="_blank"><img id="vk_logo" src="<?= get_template_directory_uri() ?>/images/vk_logo.png" alt="Vkontakte" onmouseover="custom_appearance('vk_logo', 45);" onmouseout="custom_fading('vk_logo', 100, 45);" style="opacity: 45%;"></a>
                <p><?= get_theme_mod('text_before'); ?> <a href="<?= get_theme_mod('developer_link'); ?>" target="_blank"><?= get_theme_mod('link_text') ?></a></p>
            </div>
        </footer>
    </div>
</body>
<?php wp_footer(); ?>
</html>