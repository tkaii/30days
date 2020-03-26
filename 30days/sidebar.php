			<!-- secondary -->
			<aside id="secondary">

				<!-- widget -->
				<div class="widget widget_text widget_custom_html">
					<div class="widget-title">プロフィール</div>

					<div class="wprofile">
						<div class="wprofile-img"><img src="<?php echo get_template_directory_uri(); ?>/img/profile.png" alt=""></div>
						<div class="wprofile-content">
							<p>
								テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
							</p>
						</div>
						<!-- /wprofile-content -->
						<nav class="wprofile-sns">
							<div class="wprofile-sns-item m_twitter"><a href="" rel="noopener noreferrer" target="_blank"><i
										class="fab fa-twitter"></i></a></div>
							<div class="wprofile-sns-item m_facebook"><a href="" rel="noopener noreferrer" target="_blank"><i
										class="fab fa-facebook-f"></i></a></div>
							<div class="wprofile-sns-item m_instagram"><a href="" rel="noopener noreferrer" target="_blank"><i
										class="fab fa-instagram"></i></a></div>
						</nav>
					</div><!-- /wprofile -->
				</div><!-- /widget -->


				<!-- widget -->
				<div class="widget widget_search">
					<div class="widget-title">検索</div>
					<!-- search-form -->
					<form method="get" class="search-form" action="<?php echo home_url('/'); ?>">
						<input type="search" class="search-field" value="" placeholder="キーワード" name="s" id="s">
						<button type="submit" class="search-submit"><i class="fas fa-search"></i></button>
					</form><!-- /search-form -->
				</div><!-- /widget -->


				
				<!-- widget -->
				<div class="widget widget_popular">
					<div class="widget-title">人気記事</div>

					<div class="wpost-items m_ranking">
<?php
// get_post_viewsで適宜アクセス数を確認
// $counter = get_post_views();
$args = array(
'posts_per_page' => 5,
'meta_key' => 'view_counter',
'orderby' => 'meta_value_num',
'order' => 'DESC',
);
$popular_posts = get_posts( $args );
foreach($popular_posts as $post): setup_postdata( $post );
?>
						<!-- wpost-item -->
						<a class="wpost-item" href="<?php the_permalink(); ?>">
							<div class="wpost-item-img"><?php
if (has_post_thumbnail() ) {
// アイキャッチ画像が設定されてれば中サイズで表示
the_post_thumbnail('medium');
} else {
// なければnoimage画像をデフォルトで表示
echo '<img src="' . esc_url(get_template_directory_uri()) . '/img/noimg.png" alt="">';
}
?></div>
							<div class="wpost-item-body">
								<div class="wpost-item-title"><?php the_title(); ?></div>
							</div><!-- /wpost-item-body -->
						</a><!-- /wpost-item -->
						<?php
endforeach; wp_reset_postdata();
?>
					</div><!-- /wpost-items -->
				</div><!-- /widget -->



				<!-- widget -->
				<div class="widget widget_recent">
					<div class="widget-title">新着記事</div>

					<div class="wpost-items">
<?php
$args = array(
'posts_per_page' => 5,
);
$new_posts = get_posts($args);
foreach($new_posts as $post): setup_postdata( $post );
?>
						<!-- wpost-item -->
						<a class="wpost-item" href="<?php the_permalink(); ?>">
							<div class="wpost-item-img"><?php
if (has_post_thumbnail() ) {
// アイキャッチ画像が設定されてれば中サイズで表示
the_post_thumbnail('medium');
} else {
// なければnoimage画像をデフォルトで表示
echo '<img src="' . esc_url(get_template_directory_uri()) . '/img/noimg.png" alt="">';
}
?></div>
							<div class="wpost-item-body">
								<div class="wpost-item-title"><?php the_title(); ?></div>
							</div><!-- /wpost-item-body -->
						</a><!-- /wpost-item -->
<?php endforeach; wp_reset_postdata(); ?>
					</div><!-- /wpost-items -->
				</div><!-- /widget -->

				<div class="widget widget_archive">
					<div class="widget-title">アーカイブ</div>
					<ul>
					<?php
//初期値なので$argsは書かなくてもOK
$args = array(
'type' => 'monthly',
'limit' => '',
'format' => 'html',
'before' => '',
'after' => '',
'show_post_count' => false,
'echo' => 1,
'order' => 'DESC',
'post_type' => 'post'
);
wp_get_archives( $args );
?>
					</ul>
				</div><!-- /widget -->

			</aside><!-- secondary -->
