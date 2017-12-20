<?php
if (function_exists('add_theme_support')) {
    add_theme_support('menus'); // включаем поддержку динамического меню
    add_theme_support( 'post-thumbnails' ); // включаем поддержку миниатюр
}

if (function_exists('register_sidebar')) {
    register_sidebar(); //включаем поддержку виджетов
}  
    
    /* Очищаем wp_head(); */
    function remove_recent_comments_style() {  
      global $wp_widget_factory;  
      remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );  
    }  
    add_action( 'widgets_init', 'remove_recent_comments_style' );  
    remove_action( 'wp_head', 'feed_links_extra', 3 ); 
    remove_action( 'wp_head', 'feed_links', 2 );
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'index_rel_link' );
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); 
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
    remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
    remove_action( 'wp_head', 'wp_generator' );

    /* Постраничная навигация wp_corenavi(); */

function wp_corenavi() {
   global $wp_query, $wp_rewrite;
   $pages = '';
   $max = $wp_query->max_num_pages;
   if (!$current = get_query_var('paged')) $current = 1;
   $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
   $a['total'] = $max;
   $a['current'] = $current;

   $total = 1; //1 - выводить текст "Страница N из N", 0 - не выводить
   $a['mid_size'] = 3; //сколько ссылок показывать слева и справа от текущей
   $a['end_size'] = 1; //сколько ссылок показывать в начале и в конце
   $a['prev_text'] = '&laquo;'; //текст ссылки "Предыдущая страница"
   $a['next_text'] = '&raquo;'; //текст ссылки "Следующая страница"

   if ($max > 1) echo '<div class="navigation">';
   if ($total == 1 && $max > 1) $pages = '<span class="pages">Страница ' . $current . ' из ' . $max . '</span>'."\r\n";
   echo $pages . paginate_links($a);
   if ($max > 1) echo '</div>';
} 
    


    /***НОВОВВЕДЕНИЯ***/


  /****Короткий заголовок записей****/
  function get_short_title($maxchar = 70){
    $title = get_the_title();
    if( iconv_strlen($title, 'utf-8') < $maxchar )
      return $title;
    $title = iconv_substr( $title, 0, $maxchar, 'utf-8' );
    $title = preg_replace('@(.*)\s[^\s]*$@s', '\\1...', $title); 

    return $title;
  }

  /****Убираем админ-панель на сайте****/
  add_filter('show_admin_bar', '__return_false');

  /**Регистрируем поле виджетов***/
  register_sidebar( array(
        'name' => __( 'Основное меню', '' ),
        'id' => 'top-menu',
        'description' => __( 'Меню в шапке сайта', '' ),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ) );

  /***Хлебные крошки***/

function dimox_breadcrumbs() {

  /* === ОПЦИИ === */
  $text['home']     = 'Главная'; // текст ссылки "Главная"
  $text['category'] = '%s'; // текст для страницы рубрики
  $text['search']   = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска
  $text['tag']      = 'Записи с тегом "%s"'; // текст для страницы тега
  $text['author']   = 'Статьи автора %s'; // текст для страницы автора
  $text['404']      = 'Ошибка 404'; // текст для страницы 404
  $text['page']     = 'Страница %s'; // текст 'Страница N'
  $text['cpage']    = 'Страница комментариев %s'; // текст 'Страница комментариев N'

  $wrap_before    = '<div class="breadcrumbs" >'; // открывающий тег обертки
  $wrap_after     = '</div><!-- .breadcrumbs -->'; // закрывающий тег обертки
  $sep            = ''; // разделитель между "крошками"
  $sep_before     = ''; // тег перед разделителем
  $sep_after      = ''; // тег после разделителя
  $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
  $show_on_home   = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
  $show_current   = 1; // 1 - показывать название текущей страницы, 0 - не показывать
  $before         = '<span class="current-bc">'; // тег перед текущей "крошкой"
  $after          = '</span>'; // тег после текущей "крошки"
  /* === КОНЕЦ ОПЦИЙ === */

  global $post;
  $home_url       = home_url('/');
  $link_before    = '<span>';
  $link_after     = '</span>';
  $link_attr      = ' itemprop="item"';
  $link_in_before = '<span itemprop="name">';
  $link_in_after  = '</span>';
  $link           = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
  $frontpage_id   = get_option('page_on_front');
  $parent_id      = ($post) ? $post->post_parent : '';
  $sep            = ' ' . $sep_before . $sep . $sep_after . ' ';
  $home_link      = $link_before . '<a href="' . $home_url . '"' . $link_attr . ' class="home">' . $link_in_before . $text['home'] . $link_in_after . '</a>' . $link_after;

  if (is_home() || is_front_page()) {

    if ($show_on_home) echo $wrap_before . $home_link . $wrap_after;

  } else {

    echo $wrap_before;
    if ($show_home_link) echo $home_link;

    if ( is_category() ) {
      $cat = get_category(get_query_var('cat'), false);
      if ($cat->parent != 0) {
        $cats = get_category_parents($cat->parent, TRUE, $sep);
        $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
        if ($show_home_link) echo $sep;
        echo $cats;
      }
      if ( get_query_var('paged') ) {
        $cat = $cat->cat_ID;
        echo $sep . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
      }

    } elseif ( is_search() ) {
      if (have_posts()) {
        if ($show_home_link && $show_current) echo $sep;
        if ($show_current) echo $before . sprintf($text['search'], get_search_query()) . $after;
      } else {
        if ($show_home_link) echo $sep;
        echo $before . sprintf($text['search'], get_search_query()) . $after;
      }

    } elseif ( is_day() ) {
      if ($show_home_link) echo $sep;
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $sep;
      echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
      if ($show_current) echo $sep . $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      if ($show_home_link) echo $sep;
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
      if ($show_current) echo $sep . $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      if ($show_home_link && $show_current) echo $sep;
      if ($show_current) echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ($show_home_link) echo $sep;
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        printf($link, $home_url . $slug['slug'] . '/', $post_type->labels->singular_name);
        if ($show_current) echo $sep . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, $sep);
        if (!$show_current || get_query_var('cpage')) $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
        echo $cats;
        if ( get_query_var('cpage') ) {
          echo $sep . sprintf($link, get_permalink(), get_the_title()) . $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
        } else {
          if ($show_current) echo $before . get_the_title() . $after;
        }
      }

    // custom post type
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      if ( get_query_var('paged') ) {
        echo $sep . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . $post_type->label . $after;
      }

    } elseif ( is_attachment() ) {
      if ($show_home_link) echo $sep;
      $parent = get_post($parent_id);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      if ($cat) {
        $cats = get_category_parents($cat, TRUE, $sep);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
        echo $cats;
      }
      printf($link, get_permalink($parent), $parent->post_title);
      if ($show_current) echo $sep . $before . get_the_title() . $after;

    } elseif ( is_page() && !$parent_id ) {
      if ($show_current) echo $sep . $before . get_the_title() . $after;

    } elseif ( is_page() && $parent_id ) {
      if ($show_home_link) echo $sep;
      if ($parent_id != $frontpage_id) {
        $breadcrumbs = array();
        while ($parent_id) {
          $page = get_page($parent_id);
          if ($parent_id != $frontpage_id) {
            $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
          }
          $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        for ($i = 0; $i < count($breadcrumbs); $i++) {
          echo $breadcrumbs[$i];
          if ($i != count($breadcrumbs)-1) echo $sep;
        }
      }
      if ($show_current) echo $sep . $before . get_the_title() . $after;

    } elseif ( is_tag() ) {
      if ( get_query_var('paged') ) {
        $tag_id = get_queried_object_id();
        $tag = get_tag($tag_id);
        echo $sep . sprintf($link, get_tag_link($tag_id), $tag->name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
      }

    } elseif ( is_author() ) {
      global $author;
      $author = get_userdata($author);
      if ( get_query_var('paged') ) {
        if ($show_home_link) echo $sep;
        echo sprintf($link, get_author_posts_url($author->ID), $author->display_name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_home_link && $show_current) echo $sep;
        if ($show_current) echo $before . sprintf($text['author'], $author->display_name) . $after;
      }

    } elseif ( is_404() ) {
      if ($show_home_link && $show_current) echo $sep;
      if ($show_current) echo $before . $text['404'] . $after;

    } elseif ( has_post_format() && !is_singular() ) {
      if ($show_home_link) echo $sep;
      echo get_post_format_string( get_post_format() );
    }

    echo $wrap_after;

  }
} 


?>