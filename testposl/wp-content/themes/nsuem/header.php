
<!doctype html>
<html lang="en">
<head>

  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

  <link rel="stylesheet" href="<?php bloginfo("template_directory"); ?>/styles_history_university.css" type="text/css" media="screen" />

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script src="<?php bloginfo("template_directory"); ?>/js/modernizr.js"></script>


<script type="text/javascript">
    $(document).ready(function () {
        $(".sub > a").click(function() {
            var ul = $(this).next(),
                    clone = ul.clone().css({"height":"auto"}).appendTo(".mini-menu"),
                    height = ul.css("height") === "0px" ? ul[0].scrollHeight + "px" : "0px";
            clone.remove();
            ul.animate({"height":height});
            return false;
        });
           $('.mini-menu > ul > li > a').click(function(){
           $('.sub a').removeClass('active');
           $(this).addClass('active');
        }),
           $('.sub ul li a').click(function(){
           $('.sub ul li a').removeClass('active');
           $(this).addClass('active');
        });
    });
</script>


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

<section class="cd-fixed-background menu" data-type="slider-item">
</section>