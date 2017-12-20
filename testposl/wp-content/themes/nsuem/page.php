<?php get_header(); ?>
     
<div class="wrap"> 
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="middle">
    <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>

  
  <h3 title="<?php the_title(); ?>"><?php echo get_short_title(52); ?></h3>
  <div class="middle-content">
  <div class="content-left"><?php the_content(); ?></div>
  
  <div class="content-right">
    <div class="right-block">
      <?php get_sidebar(); ?>
    </div>
  </div>
  </div>

  

  

</div>


    <?php endwhile; wp_corenavi(); else : ?>
    <h2>Не найдено</h2>
    <p>К сожалению, но вы запросили то, чего здесь нет.</p>   
  <?php endif; ?>
</div> 

<?php get_footer(); ?>

