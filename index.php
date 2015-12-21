<?php get_header(); ?>

<?php
$option = array(
	'sidebar_active' => intval(get_option('sidebar-active')) == 1,
	'show_featured_index' => intval(get_option('show-featured-index')) == 1,
	'show_featured_single' => intval(get_option('show-featured-single')) == 1,
	'show_excerpt_in_lists' => intval(get_option('show-excerpt-in-lists')) == 1,
);
?>

<div class="big-title">
	<div class="container">
		<h2>Blog</h2>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="<?php echo ($option['sidebar_active'] ? 'col-md-8 col-sm-8' : 'col-md-8 col-md-offset-2'); ?>">

			<?php if(have_posts()): while(have_posts()): the_post(); ?>

			<?php
			$post_classes = array('article-wrapper');
			if($option['sidebar_active'])
				$post_classes[] = 'sidebar-active';
			?>

			<div id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
				<?PHP
				if(has_post_thumbnail() && $option['show_featured_index']):
					echo '<a href="'.get_the_permalink().'">';
					the_post_thumbnail('custom_1', array( 'class'	=> "img-rounded img-responsive center-block featured"));
					echo '</a>';
				else:
					echo '<br />';
				endif;
				?>
				<h2><a href="<?PHP the_permalink(); ?>"><?PHP the_title(); ?></a></h2>

				<?PHP get_template_part( 'context' ); ?>

				<div class="article clearfix">
					<?PHP ($option['show_excerpt_in_lists'] ? the_excerpt() : the_content(false)); ?>
				</div>
				<div align="right">
					<a href="<?PHP the_permalink(); ?>" class="btn btn-primary"><?php echo __('Read more...', 'mfc'); ?></a>
				</div>
			</div>
			<br />
			<hr />
			<?PHP endwhile; endif; ?>

			<?PHP get_template_part('pagination'); ?>
		</div>

		<?php
		if($option['sidebar_active']):
			get_sidebar();
		endif;
		?>

	</div>
</div>


<?php get_footer(); ?>
