<?php

	/*
	Plugin Name: TCBD Calculator
	Plugin URI: http://tcoderbd.com/
	Description: This plugin will enable awesome calculator in your Wordpress theme.
	Author: Md Touhidul Sadeek
	Version: 1.0
	Author URI: http://tcoderbd.com
	*/

	/*  Copyright 2016 tCoderBD (email: info@tcoderbd.com)

		This program is free software; you can redistribute it and/or modify
		it under the terms of the GNU General Public License, version 2, as 
		published by the Free Software Foundation.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
		Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	*/

	// Exit if accessed directly
	defined( 'ABSPATH' ) || exit;

	// Define Plugin Directory
	define('TCBD_CALCULATOR_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
	
	
	// Hooks TCBD functions into the correct filters
	function tcbd_calculator_add_mce_button() {
		// check user permissions
		if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
			return;
		}
		// check if WYSIWYG is enabled
		if ( 'true' == get_user_option( 'rich_editing' ) ) {
			add_filter( 'mce_external_plugins', 'tcbd_calculator_add_tinymce_plugin' );
			add_filter( 'mce_buttons', 'tcmd_calculator_register_mce_button' );
		}
	}
	add_action('admin_head', 'tcbd_calculator_add_mce_button');

	// Declare script for new button
	function tcbd_calculator_add_tinymce_plugin( $plugin_array ) {
		$plugin_array['tcbd_calculator_mce_button'] = TCBD_CALCULATOR_PLUGIN_URL.'js/tinymce.js';
		return $plugin_array;
	}

	// Register new button in the editor
	function tcmd_calculator_register_mce_button( $buttons ) {
		array_push( $buttons, 'tcbd_calculator_mce_button' );
		return $buttons;
	}	

    function tcbd_calculator(){
		
		wp_enqueue_script( 'tcbd-calculator', TCBD_CALCULATOR_PLUGIN_URL. 'js/calculator.js', array(), '1.0' );
		
        wp_register_style('tcbd-calculator', TCBD_CALCULATOR_PLUGIN_URL. 'css/calculator.css', array(),'1.0', 'all');
        wp_enqueue_style('tcbd-calculator');
		
    }
    add_action('wp_enqueue_scripts','tcbd_calculator');
	
	function tcbd_calculator_shortcode($atts, $content){
		
		ob_start(); 
		extract ( shortcode_atts( array(
			'title'		=> 		''
		), $atts));
		
		?>
        <table class="calculator" id="calc">    
			<thead>
				<tr>
					<td colspan="4" class="calc_td_result">
						<input type="text" readonly="readonly" name="calc_result" id="calc_result" class="calc_result" onkeydown="javascript:key_detect_calc('calc',event);" />
					</td>
				</tr>			
			</thead>
			<tbody>
				<tr>
					<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="CE" onclick="javascript:f_calc('calc','ce');" />
					</td>
					<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="&larr;" onclick="javascript:f_calc('calc','nbs');" />
					</td>
					<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="%" onclick="javascript:f_calc('calc','%');" />
					</td>
					<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="+" onclick="javascript:f_calc('calc','+');" />
					</td>
				</tr>
				<tr>
					<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="7" onclick="javascript:add_calc('calc',7);" />
					</td>
					<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="8" onclick="javascript:add_calc('calc',8);" />
					</td>
					<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="9" onclick="javascript:add_calc('calc',9);" />
					</td>
					<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="-" onclick="javascript:f_calc('calc','-');" />
					</td>
				</tr>
							<tr>
					<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="4" onclick="javascript:add_calc('calc',4);" />
					</td>
					<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="5" onclick="javascript:add_calc('calc',5);" />
					</td>
					<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="6" onclick="javascript:add_calc('calc',6);" />
					</td>
					<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="x" onclick="javascript:f_calc('calc','*');" />
					</td>
				</tr>
				<tr>
					<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="1" onclick="javascript:add_calc('calc',1);" />
					</td>
					<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="2" onclick="javascript:add_calc('calc',2);" />
					</td>
					<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="3" onclick="javascript:add_calc('calc',3);" />
					</td>
					<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="&divide;" onclick="javascript:f_calc('calc','');" />
					</td>
				</tr>
				<tr>
					<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="0" onclick="javascript:add_calc('calc',0);" />
					</td>
					<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="&plusmn;" onclick="javascript:f_calc('calc','+-');" />
					</td>
					<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="," onclick="javascript:add_calc('calc','.');" />
					</td>
					<td class="calc_td_btn">
							<input type="button" class="calc_btn" value="=" onclick="javascript:f_calc('calc','=');" />
					</td>
			   </tr>			
			</tbody>
        </table>
        <script type="text/javascript">
                document.getElementById('calc').onload=init_calc('calc');
        </script>	
		
		<?php 
		
		
		$block = ob_get_clean();
		return $block;
	}
	add_shortcode('tcbd-calculator', 'tcbd_calculator_shortcode');
	