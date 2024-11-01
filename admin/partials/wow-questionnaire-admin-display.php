<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://wowq.io/
 * @since      1.0.0
 *
 * @package    Wow_Questionnaire
 * @subpackage Wow_Questionnaire/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
//flush rewrite rules when we load this page!
flush_rewrite_rules();

$this->enqueue_styles(); 
$this->enqueue_scripts(); 

//- Initialize WordPress DB
global $wpdb;
$table_name = $wpdb->base_prefix . 'wow_questionnaire';
?>
<div class="wrap">
	<?php
		$tab = isset( $_GET['page'] ) ? $_GET['page'] : $this->plugin_name.'-settings';
		$this->wowq_render_tabs(); 
		$settings_options = get_option('wow-questionnaire_settings_options');
		$isSubscribed = $this->get_subscription();
		$isLicensed   = $this->isLicensed();
	?>
	<h2>
		<?php echo esc_html( get_admin_page_title() ); ?> 
		<?php if( !$isSubscribed && $settings_options['wowq-apiKey'] ): ?>
			<div class="alert alert-danger" role="alert">
				<p>
				Subscription has ended. Please renew your subscription <a href="https://member.wowq.io/subscription">here</a>.
				</p>
			</div>
		<?php endif; ?>
		<?php if( empty( $settings_options['wowq-apiKey'] ) ): ?>
			<div class="alert alert-warning" role="alert">
				<p>
				Please enter your API key first found in your profile settings page <a href="https://member.wowq.io/profile?tab=wpplugin">here</a>. Don't have a WOW!Q account yet? register <a href="https://member.wowq.io/">here</a>. Don't worry, it's free.
				</p>
			</div>
		<?php endif; ?>
		<?php if( !$isLicensed ): ?>
			<div class="alert alert-danger" role="alert">
				<p>
				You got an invalid credentials. Please enter your valid API key, Email and Domain license correctly found in your WOW!Q profile section <a href="https://member.wowq.io/profile">here</a>.
				</p>
			</div>
		<?php endif; ?>
	</h2>
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-1">
			<div id="postbox-container-2" class="postbox-container">
				<?php 
				// If no tab or general
				switch ($tab) {
					case $this->plugin_name:
					case $this->plugin_name.'-settings': ?>
						<form class="maonster-form" method="post" action="options.php">
							<div id="normal-sortables" class="meta-box-sortables ui-sortable">
								<div id="itsec_get_started" class="postbox ">
									<h3 class="hndle">
										<span>Settings</span>
									</h3>
									<div class="inside">
										<?php
											settings_fields( 'wow-questionnaire_settings_options' );

											do_settings_sections( 'wow-questionnaire_settings' );
										?>
										<p class="submit">
											<button type="button" id="validateApiKey" class="maonster-submit btn btn-success">Validate</button>
										</p>
										<div class="clear"></div>
									</div>
								</div>
							</div>
						</form>
					<?php
						break;
					case $this->plugin_name.'-questionnaires': ?>
						<div class="row">
					        <div class="col-lg-12">
					            <div class="panel panel-default">
					                <div class="panel-heading clearfix">
				                    	<h4 class="panel-title pull-left" style="padding-top:5px;">
				                    		List of Questionnaires
				                    	</h4>
					                </div>
					                <!-- /.panel-heading -->
					                <div class="panel-body">
					                    <?php 
						                    $questionnaires = $this->wowq_questionnaires(); 
						                    $qTypes 	= array();
						                    $gdprTypes 	= array();
						                    foreach ($questionnaires as $questionnaire) {
							                    if ($questionnaire->is_gdpr) {
													array_push($gdprTypes, $questionnaire);
												}
												else {
													array_push($qTypes, $questionnaire);
												}
						                    }
						                ?>
					                	<?php if (count($questionnaires) > 0) : ?>
					                	
					                	<ul id="questionnaire-tab" class="nav nav-tabs">
							              <li class="active"><a href="#question" data-toggle="tab">Question</a></li>
							              <li><a href="#gdpr" data-toggle="tab">GDPR</a></li>
							            </ul>
							            <div class="tab-content" style="margin-top: 10px;">
		
							              <div class="tab-pane active" id="question">
									          <div class="box box-primary">
									            <div class="box-body">
										        	<?php if (count($qTypes) > 0): ?>
					                	
							                        	<table width="100%" class="table table-striped table-bordered table-hover questionnaire-table" id="questionnaire-table">
									                        <thead>
									                            <tr>
									                                <th>Questionnaire Name</th>
									                                <th>Shortcode</th>
									                                <th>Date Created</th>
									                            </tr>
									                        </thead>
									                        <tbody>
									                        	<?php foreach($qTypes as $qType): ?>
									                            <tr class="odd gradeX">
									                                <td>
									                                	<?php echo $qType->name; ?>
									                                </td>
									                                <td>
									                                	<?php echo '[wowq id="'.$qType->id.'"]'; ?> 
									                                	<button data-qid="<?php echo $qType->id; ?>" class="qCopy btn btn-sm btn-info pull-right"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</button>
									                                </td>
									                                <td data-order="<?php echo $qType->date_created; ?>">
									                                	<?php echo date('l, F jS, Y', $qType->date_created); ?>
									                                </td>
									                            </tr>
									                        	<?php endforeach; ?>
									                        </tbody>
									                    </table>
									                    
									                <?php else: ?>
									                	<div class="col-sm-offset-2 col-sm-8">
									                    	<a href="https://member.wowq.io/questionnaires?tab=question" target="_blank" class="btn btn-block btn-lg btn-success">NO QUESTIONNAIRES YET, CREATE ONE NOW</a>
									                    </div>
									                <?php endif; ?>
									            </div>
									          </div>
							              </div>
							              
							              <div class="tab-pane" id="gdpr">
									          <div class="box box-success">
									            <div class="box-body">
										        	<?php if (count($gdprTypes) > 0): ?>
					                	
							                        	<table width="100%" class="table table-striped table-bordered table-hover questionnaire-table" id="questionnaire-table">
									                        <thead>
									                            <tr>
									                                <th>Questionnaire Name</th>
									                                <th>Shortcode</th>
									                                <th>Date Created</th>
									                            </tr>
									                        </thead>
									                        <tbody>
									                        	<?php foreach($gdprTypes as $gdprType): ?>
									                            <tr class="odd gradeX">
									                                <td>
									                                	<?php echo $gdprType->name; ?>
									                                </td>
									                                <td>
									                                	<?php echo '[wowq id="'.$gdprType->id.'"]'; ?> 
									                                	<button data-qid="<?php echo $gdprType->id; ?>" class="qCopy btn btn-sm btn-info pull-right"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</button>
									                                </td>
									                                <td data-order="<?php echo $gdprType->date_created; ?>">
									                                	<?php echo date('l, F jS, Y', $gdprType->date_created); ?>
									                                </td>
									                            </tr>
									                        	<?php endforeach; ?>
									                        </tbody>
									                    </table>
									                    
									                <?php else: ?>
									                	<div class="col-sm-offset-2 col-sm-8">
									                    	<a href="https://member.wowq.io/questionnaires?tab=gdpr" target="_blank" class="btn btn-block btn-lg btn-success">NO GDPR REQUEST FORM YET, CREATE ONE NOW</a>
									                    </div>
									                <?php endif; ?>
									            </div>
									          </div>
							              </div>
							              
							            </div>
					                    <?php else: ?>
					                    	<div class="col-sm-offset-2 col-sm-8">
						                    	<a href="https://member.wowq.io/questionnaires" target="_blank" class="btn btn-block btn-lg btn-success">NO QUESTIONNAIRES YET, CREATE ONE NOW</a>
						                    </div>
					                    <?php endif; ?>
					                </div>
					                <!-- /.panel-body -->
					            </div>
					            <!-- /.panel -->
					        </div>
					        <!-- /.col-lg-12 -->
					    </div>
					    <!-- /.row -->
					<?php	
						break;
					case $this->plugin_name.'-gdpr': ?>
						<form class="maonster-form" method="post" action="options.php">
							<div id="normal-sortables" class="meta-box-sortables ui-sortable">
								<div id="itsec_get_started" class="postbox ">
									<h3 class="hndle">
										<span>GDPR Page</span>
									</h3>
									<div class="inside">
										<?php
											settings_fields( 'wow-questionnaire_gdpr_options' );

											do_settings_sections( 'wow-questionnaire_gdpr' );
										?>
										<?php submit_button(); ?>
										<div class="clear"></div>
									</div>
								</div>
							</div>
						</form>
					<?php
						break;
					case $this->plugin_name.'-privacy-policy': ?>
						<form class="maonster-form" method="post" action="options.php">
							<div id="normal-sortables" class="meta-box-sortables ui-sortable">
								<div id="itsec_get_started" class="postbox ">
									<h3 class="hndle">
										<span>Privacy Policy Page</span>
									</h3>
									<div class="inside">
										<?php
											settings_fields( 'wow-questionnaire_privacy_policy_options' );

											do_settings_sections( 'wow-questionnaire_privacy_policy' );
										?>
										<?php submit_button(); ?>
										<div class="clear"></div>
									</div>
								</div>
							</div>
						</form>
					<?php
						break;
				} ?>

			</div>
		</div>
	</div>
</div>
