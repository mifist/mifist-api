<?php
/*
Template Name: API Page Template
*/
get_header(); ?>
<?php do_action( 'mifist_before_content' ); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<section class="page-portfolio">
		<a class="btn--back fa fa-arrow-circle-left" aria-hidden="true" href="#" onClick="history.back()"></a>
		<div class="row">
			
			<div class="small-12 medium-12 large-12 columns item ">
				<div class="item__greeting item--transparent">
					<h1  class="plugin-title"><?php the_title(); ?> </h1>
				</div>
			</div>
			<div class="small-12 medium-12 large-12 columns item ">
				<div class="item__contact item--green">
					
					<?php get_sidebar(); ?>
					
					<div style="display: inline-block" class="title--black">
						
						<?php the_content(); ?>
					
					
					</div>
					<div class="sidebar-plugin">
						<?php dynamic_sidebar('sidebar-plugin'); ?>
					</div>
				</div>
			</div>
		</div>
	
	</section>
<?php endwhile;?>

<?php do_action( 'mifist_after_content' ); ?>
<?php get_footer();
