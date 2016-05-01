<?php
	require_once('../../../wp-config.php');
	global $wpdb;
	$str = $_REQUEST['s_name']; 
	
$mypostids = $wpdb->get_col("select ID from $wpdb->posts where post_title like '%$str%' and post_type='ausgabe' ");
if($mypostids && $str!="") {

	$args=array('post__in'=>$mypostids,'post_type' => 'ausgabe','posts_per_page'=> '-1');
	
	$the_query = new WP_Query($args);
	
	
?>
<?php if($the_query->have_posts()) { ?>
	<ul class="searchResult">
	<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    		
                        <li><span><?php the_title(); ?></span><?php the_post_thumbnail(array(30,30)); ?></li>
                        <?php  endwhile;  ?>	
	</ul>
	<?php } } else { ?>
    <ul class="searchResult">
	<li><span>kein Ergebnis</span></li>
    </ul>
	<?php } ?>			

<script type="text/javascript">
	jQuery(document).ready(function() {
		
		jQuery('.searchResult li').each(function(){
			jQuery(this).click(function() {
				var se = jQuery(this).children('span').text();
				//alert(se);
				jQuery('#searchform #s').attr('value',se);
			});
		});
	});
</script>	