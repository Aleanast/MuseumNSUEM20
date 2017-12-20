<?php get_header(); ?>  
     
<div class="wrap-cat"> 
	<h3><?php if( is_category() )
	echo get_queried_object()->name; ?></h3>
		<div class="middle-content">
		<div class="content-left">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="post-cat">
				<a class="post-cont-link" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        		<div class="post-cont"><?php the_excerpt(); ?></div>
			</div>
		
	
		<?php endwhile; wp_corenavi(); else : ?>
		<h2>Не найдено</h2>
		<p>К сожалению, но вы запросили то, чего здесь нет.</p>		
	<?php endif; ?>
</div> 
<div class="content-right">
    <div class="right-block">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>
</div>

<?php get_footer(); ?>
   