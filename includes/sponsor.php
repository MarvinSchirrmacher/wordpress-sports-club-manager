<?php
class Sponsor {
	public static function echoCompanyLogo() {
		$id = intval(self::getCustomValue('sponsor_logo_id'));

		if ($id == 0) {
			return;
		}

		$output = '<div class="post-sub-thumbnail">';
		$output .= wp_get_attachment_image($id, 'medium');
		$output .= '</div>';
		
		echo $output;
	}

	public static function echoSponsorMeta() {
		$address_meta_keys = array(
	    	'sponsor_address_label',
	    	'sponsor_address_street',
	    	'sponsor_address_postcode',
	    	'sponsor_address_city'
	    );

		$output = '<h4>' . __('How to contact us', 'sportsclubmanager') . '</h4>';
		$output .= '<p>';
	    $output .= self::getCustomValue('sponsor_address_label', '%s<br/>');
	    $output .= self::getCustomValue('sponsor_address_street', '%s<br/>');
	    $output .= self::getCustomValue('sponsor_address_postcode');
	    $output .= self::getCustomValue('sponsor_address_city', ' %s<br/>');
	    $output .= self::getCustomValue('sponsor_phone_number', 'Tel.: <a href="tel:%1$s">%1$s</a><br/>');
	    $output .= self::getCustomValue('sponsor_url', '<a href="%1$s" target="_blank">%1$s</a>');
	    $output .= '</p>';

	    $output .= wpautop(self::getCustomValue(
	    	'sponsor_hours_of_business', '<p><b>' . __('Hours of business', 'sportsclubmanager') . '</b><br />%1$s</p>'
	    ));

	    echo $output;
	}

	public static function echoSponsorLocationMap() {
		$street = self::getCustomValue('sponsor_address_street');
		$postcode = self::getCustomValue('sponsor_address_postcode');
		$city = self::getCustomValue('sponsor_address_city');

		if (empty($street) || empty($postcode) || empty($city)) {
			return;
		}

		$address = $street . ', ' . $postcode . ' ' . $city;
	    $title = self::getCustomValue('sponsor_address_label');
		$descriptions = self::getCustomValue('sponsor_address_description');
		
		$output = '[flexiblemap width="100%"';
		$output .= !empty($title) ? ' title="' . $title . '"' : '';
		$output .= ' description="';
		$output .= !empty($description) ? $description . '"' : '';
		$output .= ' address="' . $address . '"]';
		
		echo do_shortcode($output);
	}

	public static function echoSponsorGallery() {
		$output = '[gallery link="file" columns="4" ids="';
		$output .= self::getCustomValue('sponsor_gallery_ids');
		$output .= '"]';
		echo do_shortcode($output);
	}

	public static function echoSponsorAdvertisingMedia() {
		//echo '<h4>' . __('Our used advertising media', 'sportsclubmanager') . '</h4>';
		the_terms($post->ID, 'advertising_medium', '<div class="tags-list">', '', '</div>');
	}

	public static function echoFooterImage($class = '') {
		$footer_image_path = get_option('scm_sponsor_footer_image');
		
		if (empty($footer_image_path)) {
			return;
		}
		
		echo sprintf(
			'<img class="%s" src="%s" />',
			$class,
			get_option('scm_sponsor_footer_image')
		);
	}

	public static function echoContactForm() {
		$id = self::getCustomValue('sponsor_contact_form_id');
		$parameters = self::getCustomValue('sponsor_contact_form_parameters');
		if (empty($id)) {
			return;
		}
		echo '<h4>' . __('Get in touch', 'sportsclubmanager') . '</h4>';
		echo do_shortcode('[quform id='.$id.' values="'.$parameters.'"]');
	}

	private static function getCustomValue($key, $format = '%s') {
		$values = get_post_custom_values($key);
		if (empty($values)) {
			return null;
		}
		$value = trim($values[0]);
		if (strlen($value) > 0) {
			return sprintf($format, $value);
		}
	}
}
?>