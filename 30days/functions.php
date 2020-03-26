<?php

function my_setup()
{
add_theme_support('post-thumbnails'); 
add_theme_support('automatic-feed-links');
add_theme_support('title-tag');
add_theme_support(
'html5',
array(
'search-form',
'comment-form',
'comment-list',
'gallery',
'caption',
)
);
}
add_action('after_setup_theme', 'my_setup');

function my_script_init()
{
wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.8.2/css/all.css', array(), '5.8.2', 'all');
wp_enqueue_script('my', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0.0', true);
if( is_single() ){
wp_enqueue_script('sns', get_template_directory_uri() . '/js/sns.js', array( 'jquery' ), '1.0.0', true);
}
}
add_action('wp_enqueue_scripts', 'my_script_init');


function my_menu_init()
{
register_nav_menus(
array(
'global' => 'ヘッダーメニュー',
'drawer' => 'ドロワーメニュー',
'footer' => 'フッターメニュー',
)
);
}
add_action('init', 'my_menu_init');

function my_archive_title( $title ) {

if ( is_category() ) 
{ 
$title = '' . single_cat_title( '', false ) . '';
} elseif ( is_tag() ) 
{
$title = '' . single_tag_title( '', false ) . '';
} elseif ( is_post_type_archive() ) 
{
$title = '' . post_type_archive_title( '', false ) . '';
} elseif ( is_tax() ) 
{
$title = '' . single_term_title( '', false );
} elseif ( is_author() ) 
{
$title = '' . get_the_author() . '';
} elseif ( is_date() ) 
{
$title = '';
if ( get_query_var( 'year' ) ) {
$title .= get_query_var( 'year' ) . '年';
}
if ( get_query_var( 'monthnum' ) ) {
$title .= get_query_var( 'monthnum' ) . '月';
}
if ( get_query_var( 'day' ) ) {
$title .= get_query_var( 'day' ) . '日';
}
}
return $title;
};
add_filter( 'get_the_archive_title', 'my_archive_title' );

function my_the_post_category( $anchor = true, $id = 0 ) {
global $post;
if ( 0 === $id ) {
$id = $post->ID;
}
$this_categories = get_the_category( $id );
if ( $this_categories[0] ) {
if ( $anchor ) { 
echo '<a href="' . esc_url( get_category_link( $this_categories[0]->term_id ) ) . '">' . esc_html( $this_categories[0]->cat_name ) . '</a>';
} else { 
echo esc_html( $this_categories[0]->cat_name );
}
}
}

function my_get_post_tags( $id = 0 ) {
  global $post;
  if ( 0 === $id ) {
  $id = $post->ID;
  }
  $tags = get_the_tags( $id );
  if ( $tags ) {
  foreach( $tags as $tag ){
  echo '<div class="entry-tag-item"><a href="'. esc_url( get_tag_link($tag->term_id) ) .'">'. esc_html( $tag->name ) .'</a></div><!-- /entry-tag-item -->';
  }
  }
  }

function my_widget_init() {
register_sidebar(
array(
'name' => 'サイドバー', 
'id' => 'sidebar', 
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<div class="widget-title">',
'after_title' => '</div>',
)
);
}
add_action( 'widgets_init', 'my_widget_init' );


function get_post_views( $id = 0 ){
global $post;
//引数が渡されなければ投稿IDを見るように設定
if ( 0 === $id ) {
$id = $post->ID;
}
$count_key = 'view_counter';
$count = get_post_meta($id, $count_key, true);

if($count === ''){
delete_post_meta($id, $count_key);
add_post_meta($id, $count_key, '0');
}
return $count;
}

/**
* アクセスカウンター
*
* @return void
*/
function set_post_views() {
global $post;
$count = 0;
$count_key = 'view_counter';

if($post){
$id = $post->ID;
$count = get_post_meta($id, $count_key, true);
}

if($count === ''){
delete_post_meta($id, $count_key);
add_post_meta($id, $count_key, '1');
}elseif( $count > 0 ){
if(!is_user_logged_in()){ //管理者（自分）の閲覧を除外
$count++;
update_post_meta($id, $count_key, $count);
}
}
//$countが0のままの場合（404や該当記事の検索結果が0件の場合）は何もしない。
}
add_action( 'template_redirect', 'set_post_views', 10 );


function my_posts_search( $search, $wp_query ){
  //検索結果ページ・メインクエリ・管理画面以外の3つの条件が揃った場合
if ( $wp_query->is_search() && $wp_query->is_main_query() && !is_admin() )
{
// 検索結果を投稿タイプに絞る
$search .= " AND post_type = 'post' ";
return $search;
}
return $search;
}
add_filter('posts_search','my_posts_search', 10, 2);


function my_shortcode( $atts, $content = '' ) {
  return '<div class="entry-btn"><a class="btn" href="' . $atts['link'] . '">' . $content . '</a></div><!-- /entry-btn -->';
  }
  add_shortcode( 'btn', 'my_shortcode' );