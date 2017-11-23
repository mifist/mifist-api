<?php
/*
Template Name: Guest Book Template
*/
get_header(); ?>
<?php do_action( 'mifist_before_content' ); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<section class="page-portfolio guest-book">
		<a class="btn--back fa fa-arrow-circle-left" aria-hidden="true" href="#" onClick="history.back()"></a>
		<div class="row">
			
			<div class="small-12 medium-12 large-4 columns item ">
				<div class="item__greeting item--transparent">
					<h1><?php the_title(); ?> - Guest book from plugin</h1>
				</div>
			</div>
			<div class="small-12 medium-12 large-8 columns item ">
				<div class="item__contact item--green">
					
					<?php get_sidebar(); ?>
					
					<div style="display: inline-block" class="title--black">
						
						<?php the_content(); ?>
						<div class="some">
						
						</div>
					
					</div>
				</div>
			</div>
		</div>
	
	</section>
<?php endwhile;?>

<?php do_action( 'mifist_after_content' ); ?>
<?php get_footer();
