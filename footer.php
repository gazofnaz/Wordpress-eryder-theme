<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div>
                    <ul>
                        <?php wp_nav_menu(array('theme_location' => 'footer_nav')); ?>
                    </ul>
                    <p>&copy; <?php echo date('Y') ?> <a href="<?php bloginfo('url') ?>">
                    <?php bloginfo('name') ?>
                    </a> | Powered by <a href="http://wordpress.org">WordPress</a> | Theme by <a href="http://garetharnott.com" title="Gareth Arnott">Gareth Arnott</a></p>
                    <?php wp_footer(); ?>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>