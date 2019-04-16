<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ndt3
 */

?>

  </div><!-- #content -->

  <!-- Site Footer -->
  <footer id="footer" class="site-footer" role="contentinfo">
    <div class="footer-org" typeof="Organization" resource="#siteorg">
      <meta property="parentOrganization" resource="#parentorg" content="University of Notre Dame">
      <ul class="footer-breadcrumbs">
        <?php if( get_theme_mod( 'parent_org_1_url' ) != '' ) : ?><li><a href="<?php echo get_theme_mod( 'parent_org_1_url' ) ?>"><?php echo get_theme_mod( 'parent_org_1_name' ) ?></a></li><?php endif ?>
        <?php if( get_theme_mod( 'parent_org_2_url' ) != '' ) : ?><li><a href="<?php echo get_theme_mod( 'parent_org_2_url' ) ?>"><?php echo get_theme_mod( 'parent_org_2_name' ) ?></a></li><?php endif ?>
      </ul>
      <p><a href="/" class="site-link" property="url"><span property="name"><?php bloginfo( 'name' ); ?></span></a></p>
      <div class="footer-contacts">
        <p class="contact-info">
          <span class="address" property="address" typeof="PostalAddress">
            <?php if( get_theme_mod( 'address' ) != '' ) : ?><span property="streetAddress"><?php echo get_theme_mod( 'address' ) ?></span><br><?php endif ?>
            <span property="addressLocality">Notre Dame</span>, <span property="addressRegion">IN</span> <span property="postalCode">46556</span> <span property="addressCountry">USA</span>
          </span>
          <?php if( get_theme_mod( 'phone' ) != '' ) : ?><span class="footer-phone" property="telephone" content="+1 <?php echo get_theme_mod( 'phone' ) ?>">Phone <?php echo get_theme_mod( 'phone' ) ?></span><?php endif ?>
          <?php if( get_theme_mod( 'fax' ) != '' ) : ?><span class="footer-fax" property="faxNumber" content="+1 <?php echo get_theme_mod( 'fax' ) ?>">Fax <?php echo get_theme_mod( 'fax' ) ?></span><?php endif ?>
          <?php if( get_theme_mod( 'email' ) != '' ) : ?><span class="footer-email" property="email"><a rel="noopener" href="mailto:<?php echo get_theme_mod( 'email' ) ?>"><?php echo get_theme_mod( 'email' ) ?></a></span><?php endif ?>
        </p>
        <nav class="social" aria-label="Social media navigation" vocab="">
          <ul>
            <?php if( get_theme_mod( 'social_facebook' ) != '' ) : ?><li><a class="soc-facebook" href="<?php echo get_theme_mod( 'social_facebook' ) ?>" rel="noopener"><span class="icon" data-icon="facebook"></span> Facebook</a></li><?php endif ?>
            <?php if( get_theme_mod( 'social_twitter' ) != '' ) : ?><li><a class="soc-twitter" href="<?php echo get_theme_mod( 'social_twitter' ) ?>" rel="noopener"><span class="icon" data-icon="twitter"></span> Twitter</a></li><?php endif ?>
            <?php if( get_theme_mod( 'social_instagram' ) != '' ) : ?><li><a class="soc-instagram" href="<?php echo get_theme_mod( 'social_instagram' ) ?>" rel="noopener"><span class="icon" data-icon="instagram"></span> Instagram</a></li><?php endif ?>
            <?php if( get_theme_mod( 'social_youtube' ) != '' ) : ?><li><a class="soc-youtube" href="<?php echo get_theme_mod( 'social_youtube' ) ?>" rel="noopener"><span class="icon" data-icon="youtube"></span> YouTube</a></li><?php endif ?>
            <?php if( get_theme_mod( 'social_linkedin' ) != '' ) : ?><li><a class="soc-linkedin" href="<?php echo get_theme_mod( 'social_linkedin' ) ?>" rel="noopener"><span class="icon" data-icon="linkedin"></span> LinkedIn</a></li><?php endif ?>
          </ul>
        </nav>
      </div>
      <div property="logo" typeof="ImageObject"><meta property="url" content="https://static.nd.edu/images/webclips/default/webclip-60.png"></div>
      <p class="copyright"><a href="https://www.nd.edu/copyright/">&copy; <?= date('Y'); ?></a> <a href="https://www.nd.edu">University of Notre Dame</a></p>
    </div>
    <div class="footer-parent" property="parentOrganization" typeof="CollegeOrUniversity" resource="#parentorg">
      <meta property="name" content="University of Notre Dame">
      <a href="https://www.nd.edu/" class="mark-footer" property="url logo" typeof="ImageObject" aria-label="University of Notre Dame">
        <img src="https://static.nd.edu/images/marks/gray/ndmark600.png" alt="University of Notre Dame" property="url">
      </a>
      <div class="footer-parent-links">
        <nav aria-label="Footer links navigation">
          <ul class="footer-links">
            <li><a href="https://search.nd.edu/">Search</a></li>
            <li><a href="https://mobile.nd.edu/">Mobile App</a></li>
            <li><a href="https://news.nd.edu/">News</a></li>
            <li><a href="https://events.nd.edu/">Events</a></li>
            <li><a href="https://www.nd.edu/visit/">Visit</a></li>
            <li><a href="https://www.nd.edu/about/accessibility/">Accessibility</a></li>
          </ul>
        </nav>
        <nav class="social" aria-label="Social media navigation" vocab="">
          <ul>
            <li><a class="soc-facebook" href="https://www.facebook.com/notredame/" rel="noopener"><span class="icon" data-icon="facebook"></span> Facebook</a></li>
            <li><a class="soc-twitter" href="https://twitter.com/NotreDame/" rel="noopener"><span class="icon" data-icon="twitter"></span> Twitter</a></li>
            <li><a class="soc-instagram" href="https://www.instagram.com/notredame/" rel="noopener"><span class="icon" data-icon="instagram"></span> Instagram</a></li>
            <li><a class="soc-youtube" href="https://www.youtube.com/user/NDdotEDU" rel="noopener"><span class="icon" data-icon="youtube"></span> YouTube</a></li>
            <li><a class="soc-linkedin" href="https://www.linkedin.com/school/university-of-notre-dame/" rel="noopener"><span class="icon" data-icon="linkedin"></span> LinkedIn</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </footer>
</div><!-- .wrapper -->
<nav id="navbar" class="navbar nav-top" role="navigation"></nav>

<?php wp_footer(); ?>

</body>
</html>
