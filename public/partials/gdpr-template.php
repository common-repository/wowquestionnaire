<?php
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'class-wow-questionnaire-public.php';
/**
 * Template Name: WOW!Questionnaire GDPR Template
 *
 * @package WordPress
 * @subpackage WOW!Questionnaire
 * @since 1.3.0
 */
$plugin_public = new Wow_Questionnaire_Public( 'wow-questionnaire', '1.3.2' );
$plugin_public->enqueue_gdpr_styles(); 
$plugin_public->enqueue_gdpr_scripts();

get_header();

$request = $_REQUEST;

if ($request && isset($request['rid'])) {
	
	$tab = ($_GET['tab']) ? $_GET['tab'] : 'wowqdpr-ac';
	echo '<input type="hidden" id="wowqgdpr-current-tab" value="'.$tab.'" />';
	echo '<input type="hidden" id="wowqgdpr-rid"value="'.$request['rid'].'"/>';
	echo '<input type="hidden" id="wowqgpdr-wp-id" value="" />';
	echo '<input type="hidden" id="wowqgpdr-user-fname" value="" />';
	echo '<input type="hidden" id="wowqgpdr-user-lname" value="" />';
	echo '<input type="hidden" id="wowqgdpr-email" value="" />';
}

?>
	
	<div class="container-wrap">
	
		<div class="bootstrap-wowq">
			<div id="wowgdpr-centre" class="content-area container main-content">
				<main id="main" class="site-main" role="main">
					
					<section class="content">
						<header>
							<h1>GDPR Preference User Centre</h1>
						</header><!-- .entry-header -->
					</section>
					<div id="wowqgdpr-content" class="hidden">
						
						<section class="content">
							<button id="wowqgdpr-export" data-rid="<?php echo $request['rid']; ?>" class="btn btn-info"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download My Data</button>
						    <button data-wowqcrm="all" data-rid="<?php echo $request['rid']; ?>" class="wowqgdpr-remove btn btn-danger">Forget Me From ALL Marketing</button>
							<br/>
						</section>
						
						<section class="content">
							<div class="nav-tabs-custom">
					            <ul id="wowqgdpr-tab" class="nav nav-tabs">
						            
					            </ul>
					            <!-- Tab panes -->
							    <div id="wowqgdpr-tab-content" class="tab-content">
								   
							    </div>
							</div>
						</section>
						
						<table id="wowqgdpr-table-export" class="hidden"></table>
					</div>
		
				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- .wrap -->
	</div>



<?php get_footer(); ?>