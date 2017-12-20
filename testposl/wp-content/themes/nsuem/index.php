<?php get_header(); ?>  
     
<div class="wrap">
<div class="middle">
  <h3>Поиск по: <strong>"<?php echo $_GET['s'];?>"</strong></h3>
  <div class="middle-content">
  <div class="content-left">
    
      
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<a class="post-cont-link" href="<?php the_permalink();?>"><?php the_title(); ?></a>
<div class="post-cont"><?php the_content(''); ?></div>
<?php endwhile; else: ?>
<p>Поиск не дал результатов.</p>
<?php endif;?>
        
  </div>
  
  <div class="content-right">
    <div class="right-block">
      
    </div>
  </div>
  </div>
</div>

</div>


<?php get_footer(); ?>