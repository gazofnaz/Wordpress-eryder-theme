        <!-- See header for openers -->
</div><!-- / main container -->

<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="navbar navbar-default">
<?php 
                    $args = array(
                        'menu_class' =>'list-inline text-center',
                        'container'  => '',
                        'depth' => -1,
                        );

                    wp_nav_menu( $args); 
?>
                    <p class="text-center">&copy; <?php echo date('Y') ?> <a href="<?php bloginfo('url') ?>">
                    <?php bloginfo('name') ?>
                    </a> | Theme by <a href="http://garetharnott.com" title="Gareth Arnott">Gareth Arnott</a></p>
                    <?php wp_footer(); ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-54674137-1', {'siteSpeedSampleRate': 100});
    ga('send', 'pageview');

</script>

<?php
/* For common Javascript file includes see functions.php */
?>

</body>
</html>