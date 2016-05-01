<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>

    <!-- begin footer -->
    <div id="footer-wrap">
    
    <div class="centerBox">
    
        <!-- begin social block -->
        <div class="social-block">
        
           <ul>
			   <?php if(get_theme_option('facebook')) { ?>
               <li class="facebook"><a href="<?php echo get_theme_option('facebook'); ?>" target="_blank">facebook</a></li>
               <?php } if(get_theme_option('twitter')) { ?>
               <li class="twitter"><a href="<?php echo get_theme_option('twitter'); ?>" target="_blank">facebook</a></li>
               <?php } if(get_theme_option('youtube')) { ?>
               <li class="youtube"><a href="<?php echo get_theme_option('youtube'); ?>" target="_blank">facebook</a></li>
               <?php } if(get_theme_option('gplus')) { ?>
               <li class="google"><a href="<?php echo get_theme_option('gplus'); ?>" target="_blank">facebook</a></li>
               <?php }  ?>
           </ul>
        
        </div>
        <!-- finish social block -->
        
        <!-- begin footermenu block -->
        <div class="footermenu-block">
        
			<?php  wp_nav_menu( array( 'theme_location' => 'Footermenu1' ) ); ?>
            <?php  wp_nav_menu( array( 'theme_location' => 'Footermenu2' ) ); ?>
        
        </div>
        <!-- finish footermenu block -->
        
        <div class="centerBox">
        
         <!-- begin footerLogo block -->
        <div class="footerLogo-block">
        
           <a href="<?php echo get_theme_option('bottomLogo'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/footer-logo.png" alt="" /></a>
        
        </div>
        <!-- finish footerLogo block -->  
    
    </div>
    <!-- finish footer -->
		
	</div>
	<!-- finish page wrap -->
	
</div>
<!-- finish section -->

		<?php wp_footer(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/custom.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.flexslider.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/rainbow.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-asPieProgress.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/source/jquery.fancybox.css?v=2.1.5" media="screen" />

<script type="text/javascript">
	jQuery(document).ready(function(){
	
	jQuery('.newsBlock .search span').click(function(){
	jQuery(this).parents('.search').toggleClass('active');
	jQuery('.searchCntr .searchBox').slideToggle()
	jQuery('.bg').toggleClass('overlay');
	;		
	});
	jQuery('.searchCntr .searchBox .cross').click(function(){
	jQuery('.bg').removeClass('overlay');
	jQuery('.searchCntr .searchBox').slideUp();
	jQuery('.newsBlock .search').removeClass('active');
	jQuery('#searchform #s').attr('value','');		
	});
	
	jQuery('#searchform #s').keyup(function(e) {
		var searchval = jQuery(this).val();
		var dataString = 's_name='+ searchval;
		jQuery.ajax({
		type: "POST",
		url: "<?php bloginfo('template_url'); ?>/search_result.php",
		data: dataString,
		cache: false,
		beforeSend:function(){
		// show gif here, eg:
		jQuery('#searchlist').html('<img src="<?php bloginfo('template_url'); ?>/images/loader.gif" class="loader" alt="" />');
		
		},
		success: function(html){ 
		
		jQuery("#searchlist").html(html);
		
		}
		});
	});
	
	});
</script>
        
</body>
</html>
