<?php 

function harry_get_registered_purchase_code() {
	return get_option( 'tp_envato_purchase_code' );
}


function harry_register_theme() {
	add_submenu_page( 'themes.php', 'Register Theme', 'Register Theme', 'manage_options', 'register-theme', 'harry_register_theme_options' );
}
add_action( 'admin_menu', 'harry_register_theme' );

function harry_register_theme_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

	if(empty(harry_get_registered_purchase_code())){
		echo '<form action="" method="post" id="purchase_code_form" style="margin: 5px 15px 2px;">';
		echo '<div class="postbox" style="padding:40px;">';
		echo '<div class="postbox-header">';
		echo '<h2 class="hndle ui-sortable-handle">'.esc_html__('Register Theme','harry').'</h2>';
		echo '</div>';
		echo '<p style="max-width: 500px;">'.esc_html__('You\'re almost done. Just one more step. In order to gain full access to all demos, 
		premium plugins and support, please register your theme\'s purchase code.','harry').'</p>';
		echo '<h4>'.esc_html__('Your Envato Purchase Code','harry').'</h4>';
		
		echo '<p>';
		echo '<input class="regular-text code" type="text" name="purchase_code" id="purchase_code" value=""> ';
		echo '</p>';

		echo '<p>';
		echo '<a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">'.esc_html__('Where to find the code?','harry').'</a>';
		echo '</p>';
		
		echo '<p>';
		echo '<label>';
		echo '<input type="checkbox" name="confirm_activation">'.esc_html__('I confirm that, according to the Envato License Terms, I am licensed to use the purchase code for a single project. Using it on multiple installations is a copyright violation.','harry').'</label>';
		echo '<a href="https://themeforest.net/licenses/terms/regular" target="_blank">'.esc_html__('License details.','harry').'</a>';
		echo '</p>';
		
		echo '<p class="tp-actions">';
		echo '<button class="button button-primary" name="register_theme">'.esc_html__('Register Theme','harry').'</button>';
		echo '</p>';
		echo '</div>';
		echo '</form>';
	} else {
		
		?>
		<div class="wrap">
			<div class="welcome-panel">
				<div class="welcome-panel-content">
					<div class="welcome-panel-headers" style="padding: 40px;">
						<div class="welcome-panel-header-image">
							<svg width="780" height="550" viewBox="0 0 780 550" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"><g opacity=".5" fill="#273FCC" stroke="#627EFF" stroke-width="2" stroke-miterlimit="10"><circle cx="434.757" cy="71.524" r="66.1"></circle><circle cx="432.587" cy="43.138" r="66.1"></circle><circle cx="426.277" cy="16.14" r="66.1"></circle><circle cx="416.143" cy="-9.165" r="66.1"></circle><circle cx="402.53" cy="-32.447" r="66.1"></circle><circle cx="385.755" cy="-53.376" r="66.1"></circle><circle cx="116.864" cy="-53.072" r="66.1"></circle><circle cx="99.984" cy="-32.183" r="66.1"></circle><circle cx="86.278" cy="-8.953" r="66.1"></circle><circle cx="76.078" cy="16.3" r="66.1"></circle><circle cx="69.714" cy="43.23" r="66.1"></circle><circle cx="67.518" cy="71.524" r="66.1"></circle><circle cx="67.518" cy="71.524" r="66.1"></circle><circle cx="67.518" cy="99.05" r="66.1"></circle><circle cx="67.518" cy="126.577" r="66.1"></circle><circle cx="67.518" cy="154.09" r="66.1"></circle><circle cx="67.518" cy="181.617" r="66.1"></circle><circle cx="67.518" cy="209.143" r="66.1"></circle><circle cx="67.518" cy="236.67" r="66.1"></circle><circle cx="67.518" cy="264.196" r="66.1"></circle><circle cx="67.518" cy="291.722" r="66.1"></circle><circle cx="67.518" cy="319.236" r="66.1"></circle><circle cx="67.518" cy="346.762" r="66.1"></circle><circle cx="67.518" cy="374.289" r="66.1"></circle><circle cx="67.518" cy="374.831" r="66.1"></circle><circle cx="68.471" cy="393.565" r="66.1"></circle><circle cx="71.249" cy="411.757" r="66.1"></circle><circle cx="75.76" cy="429.315" r="66.1"></circle><circle cx="81.925" cy="446.146" r="66.1"></circle><circle cx="89.651" cy="462.17" r="66.1"></circle><circle cx="411.579" cy="464.073" r="66.1"></circle><circle cx="423.208" cy="438.98" r="66.1"></circle><circle cx="430.986" cy="412.008" r="66.1"></circle><circle cx="434.558" cy="383.517" r="66.1"></circle><circle cx="433.831" cy="354.43" r="66.1"></circle><circle cx="428.777" cy="326.428" r="66.1"></circle><circle cx="419.635" cy="300.078" r="66.1"></circle><circle cx="406.763" cy="275.725" r="66.1"></circle><circle cx="390.491" cy="253.698" r="66.1"></circle><circle cx="371.189" cy="234.369" r="66.1"></circle><circle cx="349.188" cy="218.054" r="66.1"></circle><circle cx="324.846" cy="205.124" r="66.1"></circle><circle cx="298.506" cy="195.896" r="66.1"></circle><circle cx="270.512" cy="190.739" r="66.1"></circle><circle cx="241.368" cy="189.986" r="66.1"></circle><circle cx="213.003" cy="193.754" r="66.1"></circle><circle cx="186.147" cy="201.739" r="66.1"></circle><circle cx="161.157" cy="213.559" r="66.1"></circle><circle cx="138.389" cy="228.882" r="66.1"></circle><circle cx="118.174" cy="247.352" r="66.1"></circle><circle cx="100.857" cy="268.599" r="66.1"></circle><circle cx="86.794" cy="292.264" r="66.1"></circle><circle cx="76.316" cy="318.019" r="66.1"></circle><circle cx="69.781" cy="345.466" r="66.1"></circle><circle cx="67.518" cy="374.289" r="66.1"></circle><circle cx="712.577" cy="449.729" r="66.1"></circle><circle cx="712.577" cy="428.072" r="66.1"></circle><circle cx="712.577" cy="406.403" r="66.1"></circle><circle cx="712.577" cy="384.733" r="66.1"></circle><circle cx="712.577" cy="363.077" r="66.1"></circle><circle cx="712.577" cy="341.408" r="66.1"></circle><circle cx="712.577" cy="319.738" r="66.1"></circle><circle cx="712.577" cy="298.069" r="66.1"></circle><circle cx="712.577" cy="276.412" r="66.1"></circle><circle cx="712.577" cy="254.743" r="66.1"></circle><circle cx="712.577" cy="233.073" r="66.1"></circle><circle cx="712.577" cy="211.417" r="66.1"></circle><circle cx="712.577" cy="189.748" r="66.1"></circle><circle cx="712.577" cy="168.078" r="66.1"></circle><circle cx="712.577" cy="146.422" r="66.1"></circle><circle cx="712.577" cy="124.753" r="66.1"></circle><circle cx="712.577" cy="103.083" r="66.1"></circle><circle cx="712.577" cy="81.413" r="66.1"></circle><circle cx="712.577" cy="59.757" r="66.1"></circle><circle cx="712.577" cy="38.088" r="66.1"></circle><circle cx="712.577" cy="16.418" r="66.1"></circle><circle cx="712.577" cy="-5.238" r="66.1"></circle><circle cx="712.577" cy="-26.907" r="66.1"></circle><circle cx="712.577" cy="-48.577" r="66.1"></circle><circle cx="662.966" cy="-44.161" r="66.1"></circle><circle cx="646.429" cy="-21.024" r="66.1"></circle><circle cx="629.893" cy="2.113" r="66.1"></circle><circle cx="613.356" cy="25.25" r="66.1"></circle><circle cx="596.819" cy="48.387" r="66.1"></circle><circle cx="580.282" cy="71.524" r="66.1"></circle><circle cx="580.282" cy="465.515" r="66.1"></circle></g></svg>
						</div>
						<h2 style="color:#fefefe;">Welcome to <?php echo wp_get_theme()->Name; ?></h2>
						<p style="color:#fefefe;">Version <?php echo wp_get_theme()->Version; ?></p>
					</div>
					<div class="welcome-panel-column-container">
						<div class="welcome-panel-column">
							<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
								<rect width="48" height="48" rx="4" fill="#1E1E1E"></rect>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M32.0668 17.0854L28.8221 13.9454L18.2008 24.671L16.8983 29.0827L21.4257 27.8309L32.0668 17.0854ZM16 32.75H24V31.25H16V32.75Z" fill="white"></path>
							</svg>
							<div class="welcome-panel-column-content">
								<h3>Theme Support</h3>
								<p><?php echo esc_html__('Envato allows 1 license for 1 project located on 1 domain. It means that 1 purchase key can be used only for 1 site. Each additional site will require an additional purchase key.','harry'); ?></p>
								<a href="https://help.themepure.net/support/">Go to support</a>
							</div>
						</div>
						<div class="welcome-panel-column">
							<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
								<rect width="48" height="48" rx="4" fill="#1E1E1E"></rect>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M18 16h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H18a2 2 0 0 1-2-2V18a2 2 0 0 1 2-2zm12 1.5H18a.5.5 0 0 0-.5.5v3h13v-3a.5.5 0 0 0-.5-.5zm.5 5H22v8h8a.5.5 0 0 0 .5-.5v-7.5zm-10 0h-3V30a.5.5 0 0 0 .5.5h2.5v-8z" fill="#fff"></path>
							</svg>
							<div class="welcome-panel-column-content">
								<h3>Start Customizing</h3>
								<p>Configure your site’s logo, header, menus, and more in the Customizer.</p>
								<a class="load-customize hide-if-no-customize" href="<?php echo wp_customize_url(); ?>">Open the Customizer</a>
							</div>
						</div>
						<div class="welcome-panel-column">
							<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
								<rect width="48" height="48" rx="4" fill="#1E1E1E"></rect>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M31 24a7 7 0 0 1-7 7V17a7 7 0 0 1 7 7zm-7-8a8 8 0 1 1 0 16 8 8 0 0 1 0-16z" fill="#fff"></path>
							</svg>
							<div class="welcome-panel-column-content">
								<h3>Discover a new way to build your site.</h3>
								<p><?php echo wp_get_theme()->Name; ?> is a new kind of theme.</p>
								<a href="#">Learn about <?php echo wp_get_theme()->Name; ?>.</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<form action="" method="post">
				<?php wp_nonce_field( 'license_deactivate_nonce', 'license_deactivate_nonce' ); ?>
				<button type="submit" class="button button-primary" name="deactive_license">Deactivate License Key</button>
			</form>
		</div>
	<?php }

	if(isset($_POST['register_theme'])){
		if(!isset($_POST['confirm_activation'])){
			echo '<div class="notice notice-error"><p>Please confirm the check field!</p></div>';

			return;
		}
	}
	
	if(isset($_POST['purchase_code'])) { 
		$purchase_code = $_POST['purchase_code'];
	} else {
		$purchase_code = '';
	}
	
	if(isset($_POST['purchase_code'])) {

		$verify_purchase_code = checkPurchaseCode($_POST['purchase_code']);

		if( is_wp_error($verify_purchase_code) ){
			echo '<div class="notice notice-error"><p>' .$verify_purchase_code->errors['tp_api_error'][0]. '</p></div>';
		}else{
			$check_is_already_exists = wp_remote_get(
				"https://api.themepure.net/wp-json/wp/v2/purchase/?meta_key=purchase_code&meta_value={$purchase_code}&_fields=acf"
			);

			$data = json_decode( wp_remote_retrieve_body( $check_is_already_exists ), true);
			
			if( !empty($data) ){
				$metas =  $data[0]['acf'];
				if( $metas['purchase_code'] == $purchase_code && $metas['client_domain'] == $_SERVER['HTTP_HOST'] ){
					echo '<div class="notice notice-success"><p>'.esc_html__('The theme has already been activated.','harry').'</p></div>';
					update_option( 'tp_envato_purchase_code', $purchase_code );
					update_option( 'tp_envato_purchase_item_id', $verify_purchase_code['item']['id'] );
				}else{
					echo '<div class="notice notice-error"><p>This theme already active in different domain with the same license key!</p></div>';
				}
			}else{
				$post_new_data = wp_remote_post("https://api.themepure.net/wp-json/wp/v2/purchase/",
					array(
						"headers" 			=> array(
							"Authorization"	=> "Basic ".base64_encode("api:themeweb2023!"),
						),
						"body" 	=> array(
							"title" 	=> $verify_purchase_code['item']['name'],
							"status" 	=> "publish",
							"purchase_category" => 3,
							"acf" 		=> array(
								"item_id" 		=> $verify_purchase_code['item']['id'],
								"purchase_code" => $purchase_code,
								"client_name" 	=> $verify_purchase_code['buyer'],
								"client_domain" => $_SERVER['HTTP_HOST']
							)
						)
					)
				);

				$response_status = wp_remote_retrieve_response_code( $post_new_data );
				$response_body = json_decode(wp_remote_retrieve_body( $post_new_data ), true);
				if( $response_status == 400 || $response_status == 404 || $response_status == 401 ){
					echo '<div class="notice notice-error"><p>'.$response_body['message'].'</p></div>';
				}else{
					echo '<div class="notice notice-success"><p>'.esc_html__('The theme registered succesfully','harry').'</p></div>';
					update_option( 'tp_envato_purchase_code', $purchase_code );
					update_option( 'tp_envato_purchase_item_id', $verify_purchase_code['item']['id'] );
				}
			}
		}
		
	}

	if(isset($_POST['deactive_license'])){
		if( !isset($_POST['license_deactivate_nonce']) && !wp_verify_nonce($_POST['license_deactivate_nonce'], 'license_deactivate_nonce') ){
			echo '<div class="notice notice-error"><p>Nonce field not veryfied!</p></div>';
		}else{
			$license_code = get_option('tp_envato_purchase_code');
			$get_post_id = wp_remote_get(
			    "https://api.themepure.net/wp-json/wp/v2/purchase/?meta_key=purchase_code&meta_value={$license_code}&_fields=id"
			);

			$get_post_body = json_decode( wp_remote_retrieve_body($get_post_id), true);
			$post_id = $get_post_body[0]['id'];
			if( !empty($post_id) ){
				$response = wp_remote_request("https://api.themepure.net/wp-json/wp/v2/purchase/{$post_id}/", array(
					"headers" => array(
						"Authorization"	=> "Basic ".base64_encode("api:themeweb2023!"),
					),
					"method" => "DELETE",
				));

				$response_code = wp_remote_retrieve_response_code($response);

				if($response_code == 410 || $response_code == 404){
					echo '<div class="notice notice-warning"><p>The license already deactived!</p></div>';
				}else{
					echo '<div class="notice notice-success"><p>The license deactived!</p></div>';
				}

				update_option('tp_envato_purchase_code', '');
				update_option('tp_envato_purchase_item_id', '');
			}
		}
	}
}

function checkPurchaseCode($code) {
	$personalToken = "7r4Zx70kv1i9VcaGnosCz9oxnDN4rdyF";

	// Surrounding whitespace can cause a 404 error, so trim it first
	$code = trim($code);

	// Make sure the code looks valid before sending it to Envato
	// This step is important - requests with incorrect formats can be blocked!
	if (!preg_match("/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i", $code)) {
		return new WP_Error("tp_api_error", "Your purchase code is invalid!");
	}

	$url = "https://api.envato.com/v3/market/author/sale?code={$code}";
	$response = wp_remote_get($url, array(
		"headers" => array(
			"Authorization" => "Bearer {$personalToken}",
			"User-Agent" => "Purchase code verification script"
		)
	));

	if (is_wp_error($response)) {
		return new WP_Error("tp_api_error", "Failed to look up purchase code");
	}

	$responseCode = wp_remote_retrieve_response_code($response);

	switch ($responseCode) {
		case 404: return new WP_Error("tp_api_error", "Your purchase code is invalid!");
		case 403: return new WP_Error("tp_api_error", "The personal token is missing the required permission for this script");
		case 401: return new WP_Error("tp_api_error", "The personal token is invalid or has been deleted");
	}

	if ($responseCode !== 200) {
		return new WP_Error("tp_api_error", "Got status {$responseCode}, try again shortly");
	}

	$body = json_decode(wp_remote_retrieve_body($response), true);

	if ($body === false && json_last_error() !== JSON_ERROR_NONE) {
		return new WP_Error("tp_api_error", "Error parsing response, try again");
	}

	return $body;
}


function harry_is_theme_registered() {
	$purchase_code =  harry_get_registered_purchase_code();
	$registered_by_purchase_code =  ! empty( $purchase_code );

	// Purchase code entered correctly.
	if ( $registered_by_purchase_code ) {
		return true;
	}
}

/**
 * Filter TGMPA action links.
 */

function harry_tgmpa_filter_action_links( $action_links, $item_slug, $item, $view_context ) {
	$source = ! empty( $item['source'] ) ? $item['source'] : '';

	// Prevent installing theme's premium plugins.
	if ( 'External Source' === $source && ! harry_is_theme_registered() ) {
		$action_links = array(
			'harry_registration_required' => sprintf( __( '<a style="color: #ff0000;" href="%s">Register theme to unblock it</a>', 'harry' ), esc_url( admin_url( 'themes.php?page=register-theme' ) ) ),
		);
	}

	return $action_links;
}

$harry_tgmpa_prefix = ( defined( 'WP_NETWORK_ADMIN' ) && WP_NETWORK_ADMIN ) ? 'network_admin_' : '';
add_filter( 'tgmpa_' . $harry_tgmpa_prefix . 'plugin_action_links', 'harry_tgmpa_filter_action_links', 10, 4 );

/**
 * Admin Notice
 */

function harry_notice_for_activation() {
	if(empty(harry_get_registered_purchase_code())){
		echo '<div class="notice notice-warning">
			<p>' . sprintf(
			esc_html__( 'Enter your Envato Purchase Code to receive Theme and plugin updates %s', 'harry' ),
			'<a href="' . admin_url('themes.php?page=register-theme') . '">' . esc_html__( 'Enter Purchase Code', 'harry' ) . '</a>') . '</p>
		</div>';
	}
}
add_action('admin_notices', 'harry_notice_for_activation');



/**
 * While activating the theme
 */
function harry_activate_theme_action(){
	wp_redirect( admin_url('themes.php?page=register-theme') );
}

add_action( 'after_switch_theme', 'harry_activate_theme_action' );


/**
 * If license deactive try not to run the theme
 */

function harry_protect_activation(){
    if(empty(harry_get_registered_purchase_code())){
        wp_die('Your theme is not activate!');
    }
}
add_action('theme_activation', 'harry_protect_activation');