</div> <!-- .content -->

<footer class="footer">
    <div class="footer-content">
        <div class="footer-container">
            <?php $theme = ViteWpTheme::get_instance();
            $theme->display_footer_widgets(); ?>
        </div>
    </div>
    <div class="copyright-area">
        <div class="copyright-container">
            <div class="copyright">
                Copyright <?php echo date('Y'); ?> <?php echo get_bloginfo('name'); ?>
            </div>
            <div class="copyright-menu">
                <?php wp_nav_menu(array(
                    'theme_location' => 'copyright_menu',
                    'fallback_cb' => false,
                    'depth' => 1
                )); ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>