<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
    </main>
    <footer id="footer">
        <div class="container">
            <div class="row">
                <?php for($i = 1; $i <= 4; $i++):?>
                    <div class="col-lg-3">
                        <?php dynamic_sidebar('sidebar-footer-' . $i);?>
                    </div>
                <?php endfor;?>
            </div>
        </div>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>
