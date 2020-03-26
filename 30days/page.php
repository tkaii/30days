<?php get_header(); ?>


<!-- content -->
<div id="content" class="m_one">
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
<article class="entry m_page">

<!-- entry-header -->
<div class="entry-header">
	<h1 class="entry-title"><?php the_title(); ?></h1><!-- /entry-title -->
	<div class="entry-img">
<?php
if ( has_post_thumbnail() ) {
the_post_thumbnail( 'large' );
}
?></div><!-- /entry-img -->
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
	<div class="entry-btn"><a class="btn" href="">テキストテキスト</a></div><!-- /entry-btn -->
</div><!-- /entry-body -->
</article><!-- /entry -->
<?php
endwhile;
endif;
?>
</main><!-- /primary -->


</div><!-- /inner -->
</div><!-- /content -->

<?php get_footer(); ?>

