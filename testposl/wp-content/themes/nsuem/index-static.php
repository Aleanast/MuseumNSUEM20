<?php 
/*
    Template Name: Custom
    */
?>
<!doctype html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php bloginfo("template_directory"); ?>/styles_history_university.css" type="text/css" media="screen" />
  <script src="<?php bloginfo("template_directory"); ?>/js/modernizr.js"></script>
  <?php wp_enqueue_script("jquery"); wp_head(); ?>
</head>
<body>
  
<div class="nav">
  <div class="logo">
    <a href="/"><img src="<?php bloginfo("template_directory"); ?>/images/logo.png" alt=""></a>
  </div>
  <div class="social">
    <ul class="contact">
      <li>Тел.: (383) 2-110-500</li>
      <li><a href="http://nsuem.ru">Сайт НГУЭУ</a></li>
    </ul>
    <div class="search">
    	<form role="search" method="get" id="searchform" class="searchform" action="<?php bloginfo('url'); ?>">
		<input type="text" value="" placeholder="поиск..." name="s" id="s">
		<input type="submit" id="searchsubmit" value="" class="search-btn">
		</form>
	</div>
  <div class="topmenu">
    <?php dynamic_sidebar( 'top-menu' ); ?>
</div>
    
    <ul class="soc">
      <li><a href="#" class="vk"> </a></li>
      <li><a href="#" class="twitter"> </a></li>
      <li><a href="#" class="facebook"> </a></li>
    </ul>
  </div>
</div>   
<div class="wrap">   
<section class="cd-fixed-background intro" data-type="slider-item">
	<div class="intro-title">
		<p><?php bloginfo( "name" ); ?></p>
	</div>
	<div class="intro-text">
		<p><?php bloginfo( "description" ); ?></p>
	</div>
	<div id="dropit"><a class="drop" href="#newsposts"><div class="dropdown"><p>Узнать подробнее</p></div></a></div>
</section>


<section class="news" id="newsposts">
	<div class="news-block">
	<h1 class="news-title">События в музее НГУЭУ</h1>
	<ul>
<?php if (have_posts()) : query_posts('cat=1'); while (have_posts()) : the_post(); ?>
 
<!-- Начало .postBox -->


		<li class="post">
			<img src="<?php the_post_thumbnail_url( 'thumbnail' ); ?>" alt="" class="post-pic">
			<div class="post-title"><a href="<?php the_permalink() ?>"><?php echo get_short_title(52); ?></a></div>
			<?php global $more; $more = 0; the_content("..."); ?>
			<a href="<?php the_permalink() ?>" class="post-more">Читать далее</a>
		</li>
<!-- Конец .postBox -->
 
<?php endwhile; ?>
<?php else : ?>
<?php include '404.php'; ?>
 
<?php endif; ?>

 <?php if (function_exists("emm_paginate")) {
 emm_paginate();
 } ?>
 </ul>
	</div>
</section>

 </div>  

 <section class="map">
	<h1 class="map-title">Наш музей находится здесь</h1>
	<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Acfe1f4c7494b6b5f0abe3328b826485c883e3390da8cc051737a3e7b8d45e835&amp;width=1170&amp;height=350&amp;lang=ru_RU&amp;scroll=true"></script>
</section>
<?php get_footer(); ?>