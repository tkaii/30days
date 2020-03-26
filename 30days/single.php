<?php get_header(); ?>

	<!-- content -->
	<div id="content">
		<div class="inner">

<!-- primary -->
<main id="primary">

<?php get_template_part('template-parts/breadcrumb'); ?>


<?php
if ( have_posts() ) :
while ( have_posts() ) :
the_post();
?>
<!-- entry -->
<article <?php post_class( array( 'entry' ) ); ?>>
<!-- entry-header -->
<div class="entry-header">
<?php
$category = get_the_category();
if ( $category[0] ) : 
?>
<div class="entry-label"><a href="<?php echo esc_url( get_category_link( $category[0]->term_id ) ); ?>"><?php echo $category[0]->cat_name; ?></a></div><!-- /entry-item-tag -->
<?php endif; ?>
<h1 class="entry-title"><?php the_title(); ?></h1><!-- /entry-title -->

<!-- entry-meta -->
<div class="entry-meta">
<time class="entry-published" datetime="<?php the_time( 'c' ); ?>">公開日 <?php the_time( 'Y/n/j' ); ?></time>
<?php if ( get_the_modified_time( 'Y-m-d' ) !== get_the_time( 'Y-m-d' ) ) : ?>
<time class="entry-updated" datetime="<?php the_modified_time( 'c' ); ?>">最終更新日 <?php the_modified_time( 'Y/n/j' ); ?></time>
<?php endif; ?>
</div><!-- /entry-meta -->
<!-- entry-img -->
<div class="entry-img">
<?php
if ( has_post_thumbnail() ) {
the_post_thumbnail( 'large' );
}
?>
</div><!-- /entry-img -->
</div><!-- /entry-header -->
<!-- entry-body -->
<div class="entry-body">
<?php the_content(); ?>
<?php
wp_link_pages(
array(
'before' => '<nav class="entry-links">',
'after' => '</nav>',
'link_before' => '',
'link_after' => '',
'next_or_number' => 'number',
'separator' => '',
)
);
?>
</div><!-- /entry-body -->

<?php $post_tags = get_the_tags(); ?>
<div class="entry-tag-items">
<div class="entry-tag-head">タグ</div><!-- /entry-tag-head -->
<?php my_get_post_tags(); ?>
</div><!-- /entry-tag-items -->


<div class="entry-related">
<div class="related-title">関連記事</div>
<?php if( has_category() ) {
$post_cats = get_the_category();
$cat_ids = array();
foreach($post_cats as $cat) {
$cat_ids[] = $cat->term_id;
}
}

$myposts = get_posts( array(
	'post_type' => 'post', 
	'posts_per_page' => '8', 
	'post__not_in' => array( $post->ID ),
	'category__in' => $cat_ids, 
	'orderby' => 'rand' 
	) );
	if( $myposts ): ?>

<div class="related-items">
<?php foreach($myposts as $post): setup_postdata($post);?>
<a class="related-item" href="<?php the_permalink(); ?>">
<div class="related-item-img">
<?php
if (has_post_thumbnail() ) {
the_post_thumbnail('medium');
} else {
echo '<img src="' . esc_url(get_template_directory_uri()) . '/img/noimg.png" alt="">';
}
?>
<div class="related-item-title"><?php the_title(); ?></div><!-- /related-item-title -->
</a><!-- /related-item -->
<?php endforeach; wp_reset_postdata(); ?>
</div><!-- /related-items -->
<?php endif; ?>
</div><!-- /entry-related -->
</article> <!-- /entry -->
<?php
endwhile;
endif;
?>
			</main><!-- /primary -->

<?php get_sidebar(); ?>


		</div><!-- /inner -->
	</div><!-- /content -->

<?php get_footer(); ?>