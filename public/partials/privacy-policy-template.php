<?php
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'class-wow-questionnaire-public.php';
/**
 * Template Name: WOW!Questionnaire GDPR Template
 *
 * @package WordPress
 * @subpackage WOW!Questionnaire
 * @since 1.3.0
 */
$plugin_public = new Wow_Questionnaire_Public( 'wow-questionnaire', '1.3.8' );
$plugin_public->enqueue_privacy_policy_styles(); 
$plugin_public->enqueue_privacy_policy_scripts();

get_header();
?>

	<div class="container-wrap">
	
		<div class="bootstrap-wowq">
			<div id="wowqpp-centre" class="content-area container main-content">
				<main id="main" class="site-main" role="main">
					
					<section class="content">
						<header>
							<h1>Privacy Policy</h1>
						</header><!-- .entry-header -->
					</section>
					<div id="wowqpp-content" class="">
						
						<?php
							$get_privacy_policy = $plugin_public->get_privacy_policy();
							
							if (isset($get_privacy_policy)) {
								if ($get_privacy_policy->status) {
									echo nl2br($get_privacy_policy->html);
								
									?>
									<div class="wowq-gdpr-docked-button bootstrap-wowq">
										<div class="row">
											<div class="col-6 text-center">
											<?php 
												
												$options 	= get_option(  'wow-questionnaire_privacy_policy_options' );
												$option     = '';
										
												if ( !empty( $options['wowq-gdprButton'] ) ) {
													$option  = $options['wowq-gdprButton'];
													
													//- double check if questionnaire exists. if not, don't call shortcode
													$questionnaire = $plugin_public->wowq_questionnaire($option);
													
													if ($questionnaire->status) {
														echo do_shortcode("[wowq id='$option']");
													}
												}
												
											?>
											</div>
										</div>
									</div>
									<?php
								}
								else {
									echo $get_privacy_policy->error;
								}
							}
							else {
								echo 'No Privacy Policy Generated yet.';
							}
						?>
						
					</div>
		
				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- .wrap -->
	</div>

<?php get_footer(); ?>