<?php
/**
 * Generate the breadcrumbs
 */

// ">" をセパレータとして利用
$sep  = '<span class="sep">&rsaquo;</span>';

// トップページ
$text = '<a class="element root" href="' . get_bloginfo('url') . '">ホーム</a>';

if ( is_category() ) {

  // カテゴリーページのパンくず
  $cat    = get_queried_object();
  $name   = $cat->name;
  $text  .= $sep . '<span class="element">' . $name . '</span>';

} else if ( is_month() ) {

 // 月間アーカイブページのパンくず
 $y     = get_query_var('year');
 $m     = get_query_var('monthnum');
 $link  = get_month_link( $y, $m );
 $name  = "{$y}年{$m}月";
 $text .= $sep . '<a href="' . $link . '" class="element">' . $name . '</a>';  

} else if ( is_singular('post') ) {

  // シングル投稿ページのパンくず
  $category = get_the_category();
  if ( $category ) {
    // 取得したカテゴリ配列の先頭のカテゴリをパンくずに採用する
    $name  = $category[0]->cat_name;
    $id    = $category[0]->cat_ID;
    $slug  = $category[0]->slug;
    $link  = get_category_link( $id );
    $text .= $sep . '<a href="'. $link .'" class="element">'. $name .'</a>';
  }
  $text .= $sep . '<span class="element">'. get_the_title() .'</span>';

} else if ( is_search() ) {

  $text .= $sep . '<span class="element">検索結果</span>';

} else if ( is_page() ) {

  $link  = get_the_permalink();
  $title = get_the_title();
  $text .= $sep . '<span class="element">' . $title . '</span>';

} else if ( is_404() ) {

  $text  .= $sep . '<span class="element">不明なページ(404)</span>';

}

// 生成したしたパンくずHTMLを出力。
echo '<div class="breadcrumbs">';
echo $text;
echo '</div>';