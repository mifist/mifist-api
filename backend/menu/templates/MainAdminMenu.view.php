<?php
/**
 * Created by PhpStorm.
 * User: avant
 * Date: 10.02.17
 * Time: 1:43
 */

echo '<div class="row mifist-plugin">';
echo '<br /><h1 class="mif-backend-title">' . get_admin_page_title() . '</h1>';
echo '<div class="small-12 medium-12 large-6 columns">	
		<h3>'. _x("This plugin is an alternative free variant to this plugin of", MIFISTAPI_PlUGIN_TEXTDOMAIN) .'
			<a href="http://maxgalleria.com/downloads/slick-slider-for-wordpress/" target="_blank">MaxGlleria</a>.
		</h3>
		<h3> '. _x("His possibility with examples can look", MIFISTAPI_PlUGIN_TEXTDOMAIN) .'
			<a href="http://kenwheeler.github.io/slick/" target="_blank">here</a>.
		</h3>
			<h4>'. _x("Features of Slick Slider", MIFISTAPI_PlUGIN_TEXTDOMAIN) .'</h4>
			<p>Для проверки шорткодов:<br />
			Ajax shortcode - [mifist_guest_book]<br />
			Guest Book shortcode - [mifist_show_guest_book]<br />
			</p>
<ul class="features">
 	<li>'. _x("Fully responsive. Scales with its container.", MIFISTAPI_PlUGIN_TEXTDOMAIN) .'</li>
 	<li>'. _x("Separate settings per breakpoint", MIFISTAPI_PlUGIN_TEXTDOMAIN) .'</li>
 	<li>'. _x("Uses CSS3 when available. Fully functional when not.", MIFISTAPI_PlUGIN_TEXTDOMAIN) .'</li>
 	<li>'. _x("Swipe enabled. Or disabled, if you prefer.", MIFISTAPI_PlUGIN_TEXTDOMAIN) .'</li>
 	<li>'. _x("Desktop mouse dragging", MIFISTAPI_PlUGIN_TEXTDOMAIN) .'</li>
 	<li>'. _x("Infinite looping.", MIFISTAPI_PlUGIN_TEXTDOMAIN) .'</li>
 	<li>'. _x("Fully accessible with arrow key navigation", MIFISTAPI_PlUGIN_TEXTDOMAIN) .'</li>
 	<li>'. _x("Add, remove, filter unfilter slides", MIFISTAPI_PlUGIN_TEXTDOMAIN) .'</li>
 	<li>'. _x("Autoplay, dots, arrows, callbacks, etc...", MIFISTAPI_PlUGIN_TEXTDOMAIN) .'</li>
</ul>


	</div>
	<div class="small-12 medium-12 large-6 columns">
	<h4>'. _x("In version 1.0 implemented:", MIFISTAPI_PlUGIN_TEXTDOMAIN) .'</h4>
	<p>'. _x("output with do_shortcode fields \"Title\", \"Description\" and \"Text\".", MIFISTAPI_PlUGIN_TEXTDOMAIN) .'</p>
	<h4>'. _x("The result of the plug-in:", MIFISTAPI_PlUGIN_TEXTDOMAIN) .'</h4> '.
	do_shortcode('
		[mifshortcode]
			[mifdescription title="Some title 1" description="Some description 1"]Some content 1[/mifdescription]
			[mifdescription title="Some title 2" description="Some description 2"]Some content 2[/mifdescription]
		[/mifshortcode] 
	') .'</div></div>';

	




