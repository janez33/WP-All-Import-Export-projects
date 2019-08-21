<?php
/**
 * ==========================================
 * Author: @Janez Kolar (from Upwork.com) (kolarjanez@yahoo.com)
 * Last Edited: August 4th, 2019 at 23:27pm
 * ==========================================
 * function_name: set_status
 *  
 * @param [string] $notification_type
 * @return publish/draft
 */
function set_status($notification_type) {
    if ($notification_type == '03') {
        return 'draft';
    } else {
        return 'publish';
    }
}
/**
 * function_name: set_product_type
 *
 * description: Function is setting up type for woocommerce product - simple or variable.
 *
 * @param [string] $product_composition
 * @return simple/variable
 */
function set_product_type($product_composition) {
    if ($product_composition == '10') {
        return 'variable';
    } else {
        return 'simple';
    }
}
/**
 * function_name: set_format_attribute
 *
 * description: Function with switch statement for simple trancodification of file formats.
 *
 * @param [string] $product_form_feature_value
 * @return EPUB/PDF/Mobipocket/Reformatable
 */
function set_format_attribute($product_form_feature_value) {
    switch ($product_form_feature_value) {
        case 'E101':
            return 'EPUB';
            break;
        case 'E107':
            return 'PDF';
            break;
        case 'E127':
            return 'Mobipocket';
            break;
        case 'E200':
            return 'EPUB';
            break;
        case 'E201':
            return 'Reformatable';
            break;
        default:
            break;
    }
}
/**
 * function_name: set_drm
 *
 * description: Function is transcoding numbers to epub technical protection.
 *
 * @param [string] $epub_technical_protection
 * @return associated value for a given key
 */
function set_drm($epub_technical_protection) {
    $persons = array(
        "00"=>"None",
        "01"=>"DRM",
        "02"=>"Digital watermarking",
        "03"=>"Adobe DRM",
        "04"=>"Apple DRM",
        "05"=>"OMA DRM",
        "06"=>"Readium LCP DRM",
        "07"=>"Sony DRM"
    );
    return $persons[$epub_technical_protection];
}
/**
 * function_name: set_title
 *
 * description: Function is returning title.
 *
 * @param [string] $title_type
 * @param [string] $title_text
 * @param [string] $author
 * @return title of the book
 */
function set_title($title_type, $title_text, $author) {
    if ($title_type == '01') {
        return $title_text . ' - ' . $author;
    } else {
        return $title_text;
    }
}
/**
 * function_name: set_titre_original
 *
 * description: Function used to set custom field--> titre_original
 *
 * @param [string] $title_type
 * @param [string] $title_text
 * @param [string] $author
 * @return title+author or title
 */
function set_titre_original($title_type, $title_text, $author) {
    if ($title_type == '03') {
        return $title_text . ' - ' . $author;
    } else {
        return $title_text;
    }
}
/**
 * function_name: set_subtitle
 *
 * description: Function used to set "subtitle of the product" attribute.
 *
 * @param [string] $subtitle
 * @return subtitle
 */
function set_subtitle($subtitle) {
    if (!empty($subtitle)) {
        return $subtitle;
    }
}
/**
 * function_name: set_author_attribute
 *
 * description: Function for setting author attribute.
 *
 * @param [integer] $sequence_number
 * @param [string] $contributor_role
 * @param [string] $author
 * @return author
 */
function set_author_attribute($sequence_number, $contributor_role, $author) {
	if ($sequence_number == 1 && $contributor_role == 'A01') {
		return $author;
	} else {
	}
}
/**
 * function_name: set_preface_par
 *
 * description: Function for setting prefacé par attribute.
 *
 * @param [string] $contributor_role
 * @param [string] $author
 * @return author
 */
function set_preface_par($contributor_role, $author) {
    if ($contributor_role == 'A15') {
        return $author;
    } else {
    }
}
/**
 * function_name: set_description
 *
 * description: Function for setting up product description.
 *
 * @param [string] $text_type
 * @param [string] $text
 * @return text
 */
function set_description($text_type, $text) {
    if ($text_type == '03') {
        return $text;
    } else {
    }
}
/**
 * function_name: set_author_biography
 *
 * description: Function for setting "biography of the author" attribute.
 *
 * @param [integer] $sequence_number
 * @param [string] $contributor_role
 * @param [string] $biographical_note
 * @return BiographicalNote
 */
function set_author_biography($sequence_number, $contributor_role, $biographical_note) {
    if ($sequence_number == 1 && $contributor_role == 'A01') {
        return $biographical_note;
    }
}
/**
 * function_name: set_language
 *
 * description: Function for setting "Language of the text" attribute.
 *
 * @param [string] $language_role
 * @param [string] $language_code
 * @return Français/Anglais
 */
function set_language($language_role, $language_code) {
    if($language_role == "01"){
        switch ($language_code):
        Case "fre": return "Français";
        Case "eng": return "Anglais";
        endswitch;
        }
}
/**
 * function_name: set_taille_attribute
 *
 * description: Function for setting "Size of the file in MB" attribute.
 *
 * @param [integer] $ExtentType
 * @param [integer] $ExtentValue
 * @param [integer] $ExtentUnit
 * @return calculated file size
 */
function set_taille_attribute($ExtentType,$ExtentValue,$ExtentUnit) {
	if ($ExtentType == "22") {
        switch ($ExtentUnit):
        Case "19": return $ExtentValue;
        Case "17": return ($ExtentValue/1000000);
        endswitch;
    }
}
/**
 * function_name: set_number_of_pages
 *
 * description: Function for setting "Number of pages in the printed edition" attribute.
 *
 * @param [integer] $ExtentType
 * @param [integer] $ExtentValue
 * @return number of pages
 */
function set_number_of_pages($ExtentType, $ExtentValue) {
	if ($ExtentType=="0") {
	    return $ExtentValue ;
	}
}
/**
 * function_name: set_tag
 *
 * description: Function for setting tags of the product.
 * ATTENTION: You have to use FORLOOP in WPAllImport field!
 * [FOREACH({DescriptiveDetail[1]/Subject})][set_tag({SubjectSchemeIdentifier}, {SubjectHeadingText})][ENDFOREACH]
 *
 * @param [string] $subject_scheme_identifier
 * @param [string] $subject_heading_text
 * @return product tags
 */
function set_tag($subject_scheme_identifier, $subject_heading_text) {
    if ($subject_scheme_identifier == "20") {
        return $subject_heading_text;
    }
}
/**
 * function_name: set_website_link
 *
 * description: Function for setting "Publisher corporate website link" attribute.
 *
 * @param [string] $website_role
 * @param [string] $publisher_name
 * @param [string] $website_link
 * @return publishername + (website link)
 */
function set_website_link($website_role, $publisher_name, $website_link) {
    if ($website_role == "01") {
        return $publisher_name . " " . "(" . $website_link . ")";
    }
}
/**
 * function_name: set_audience
 *
 * description: Function for setting audience custom field.
 *
 * @param [string] $audience_code_type
 * @return audience
 */
function set_audience($audience_code_type) {
    if ($audience_code_type == "01") {
        return "Général";
    } else if ($audience_code_type == "02") {
        return "Jeune";
    }
}
/**
 * function_name: set_gtin
 *
 * description: Function for setting GTIN-13 attribute.
 *
 * @param [string] $product_id_type
 * @param [integer] $id_value
 * @return gtin
 */
function set_gtin($product_id_type, $id_value) {
    if ($product_id_type == "03") {
        return $id_value;
    }
}
/**
 * function_name: set_short_description
 *
 * description: Function for setting short description.
 *
 * @param [string] $text_type
 * @param [string] $text
 * @return short description text
 */
function set_short_description($text_type, $text) {
    if ($text_type == "02") {
        return $text;
    }
}
/**
 * function_name: set_index
 *
 * description: Function for setting index attribute.
 *
 * @param [string] $text_type
 * @param [string] $text
 * @return index text
 */
function set_index($text_type, $text) {
    if ($text_type == "04") {
        return $text;
    }
}
/**
 * function_name: set_extrait
 *
 * description: Function for setting extrait attribute.
 *
 * @param [string] $text_type
 * @param [string] $text
 * @return extrait text
 */
function set_extrait($text_type, $text) {
    if ($text_type == "14") {
        return $text;
    }
}
/**
 * function_name: set_description_attribute
 *
 * description: Function for setting extrait attribute.
 *
 * @param [string] $text_type
 * @param [string] $text
 * @return description attribute
 */
function set_description_attribute($text_type, $text) {
    if ($text_type == "06") {
        return $text;
    }
}
/**
 * function_name: set_edition
 *
 * description: Function for setting edition attribute.
 *
 * @param [string] $imprint_name
 * @param [string] $website_role
 * @param [string] $website_link
 * @return imprint_name or imprint_name with website_link
 */
function set_edition($imprint_name, $website_role, $website_link) {
    if ($website_role == "01") {
        return $imprint_name;
    } else if (!empty($website_link)) {
        return $imprint_name . " " . "(" . $website_link . ")";
    }
}
/**
 * function_name: set_imprint_id_value
 *
 * description: Function for setting GLN Number custom field.
 *
 * @param [string] $imprint_id_value
 * @param [string] $imprint_id_type
 * @return imprint_id_value
 */
function set_imprint_id_value($imprint_id_value, $imprint_id_type) {
    if ($imprint_id_type == "06") {
        return $imprint_id_value;
    }
}
/**
 * function_name: set_pays_inclus
 *
 * description: Function for setting "countries included" custom field.
 *
 * @param [string] $sales_rights_type
 * @param [string] $countries_included
 * @return countries_included
 */
function set_pays_inclus($sales_rights_type, $countries_included) {
    $countries_included_array = explode(' ', $countries_included);
    if ($sales_rights_type == '01' && (in_array("BJ", $countries_included_array)) && (in_array("CI", $countries_included_array)) && (in_array("SN", $countries_included_array)) && (in_array("TG", $countries_included_array)) && (in_array("NE", $countries_included_array)) && (in_array("BF", $countries_included_array)) && (in_array("ML", $countries_included_array)) && (in_array("GN", $countries_included_array))) {
        return implode(",", $countries_included_array);
    }
}
/**
 * function_name: set_regions_inclues
 *
 * description: Function for setting "regions included" custom field.
 *
 * @param [string] $sales_rights_type
 * @param [string] $countries_excluded
 * @param [string] $regions_included
 * @return regions_included
 */
function set_regions_inclues($sales_rights_type, $countries_excluded, $regions_included) {
    if ($sales_rights_type == '01' && $regions_included == "WORLD" && empty($countries_excluded)) {
        return $regions_included;
    }
}
/**
 * function_name: calculate_price_{country}
 *
 * description: Function for calculating and setting price for different countries in custom fields.
 *
 * @param [integer] $price
 * @param integer $multiplier
 * @param float $nearest
 * @param integer $minus
 * @return calculated_price
 */
function calculate_price_benin( $price_amount, $country, $multiplier, $nearest, $minus) {
	$nearest = .01;
    if ( (!empty( $price_amount)) && ($country == "BJ")) {
		// strip any extra characters from price
		$price = preg_replace("/[^0-9,.]/", "", $price_amount);
        // perform calculations and return final price
        $final_price = (( round ( ( $price * $multiplier ) / $nearest ) * $nearest ) - $minus);
		return $final_price;
    }
}
function calculate_price_togo( $price_amount, $country, $multiplier, $nearest, $minus) {
	$nearest = .01;
    if ( (!empty( $price_amount)) && ($country == "TG")) {
		// strip any extra characters from price
		$price = preg_replace("/[^0-9,.]/", "", $price_amount);
        // perform calculations and return final price
        $final_price = (( round ( ( $price * $multiplier ) / $nearest ) * $nearest ) - $minus);
		return $final_price;
    }
}
function calculate_price_senegal( $price_amount, $country, $multiplier, $nearest, $minus) {
	$nearest = .01;
    if ( (!empty( $price_amount)) && ($country == "SN")) {
		// strip any extra characters from price
		$price = preg_replace("/[^0-9,.]/", "", $price_amount);
        // perform calculations and return final price
        $final_price = (( round ( ( $price * $multiplier ) / $nearest ) * $nearest ) - $minus);
		return $final_price;
    }
}
function calculate_price_cotedivoire( $price_amount, $country, $multiplier, $nearest, $minus) {
	$nearest = .01;
    if ( (!empty( $price_amount)) && ($country == "CI")) {
		// strip any extra characters from price
		$price = preg_replace("/[^0-9,.]/", "", $price_amount);
        // perform calculations and return final price
        $final_price = (( round ( ( $price * $multiplier ) / $nearest ) * $nearest ) - $minus);
		return $final_price;
    }
}
function calculate_price_mali( $price_amount, $country, $multiplier, $nearest, $minus) {
	$nearest = .01;
    if ( (!empty( $price_amount)) && ($country == "ML")) {
		// strip any extra characters from price
		$price = preg_replace("/[^0-9,.]/", "", $price_amount);
        // perform calculations and return final price
        $final_price = (( round ( ( $price * $multiplier ) / $nearest ) * $nearest ) - $minus);
		return $final_price;
    }
}
function calculate_price_burkinafaso( $price_amount, $country, $multiplier, $nearest, $minus) {
	$nearest = .01;
    if ( (!empty( $price_amount)) && ($country == "BF")) {
		// strip any extra characters from price
		$price = preg_replace("/[^0-9,.]/", "", $price_amount);
        // perform calculations and return final price
        $final_price = (( round ( ( $price * $multiplier ) / $nearest ) * $nearest ) - $minus);
		return $final_price;
    }
}
function calculate_price_guinea( $price_amount, $country, $multiplier, $nearest, $minus) {
	$nearest = .01;
    if ( (!empty( $price_amount)) && ($country == "GN")) {
		// strip any extra characters from price
		$price = preg_replace("/[^0-9,.]/", "", $price_amount);
        // perform calculations and return final price
        $final_price = (( round ( ( $price * $multiplier ) / $nearest ) * $nearest ) - $minus);
		return $final_price;
    }
}
function calculate_price_niger( $price_amount, $country, $multiplier, $nearest, $minus) {
	$nearest = .01;
    if ( (!empty( $price_amount)) && ($country == "NE")) {
		// strip any extra characters from price
		$price = preg_replace("/[^0-9,.]/", "", $price_amount);
        // perform calculations and return final price
        $final_price = (( round ( ( $price * $multiplier ) / $nearest ) * $nearest ) - $minus);
		return $final_price;
    }
}
/**
 * function_name: set_edition_type
 *
 * description: Function for setting "edition type" custom field.
 *
 * @param [string] $editon_type
 * @return "Edition exclusivement Digitale"
 */
function set_edition_type($editon_type) {
    if ($editon_type == "DGO") {
        return "Edition exclusivement Digitale";
    }
}
/**
 * function_name: set_collection
 *
 * description: Function for setting "collection" attribute.
 *
 * @param [integer] $collection_type
 * @param [string] $title_element_level
 * @param [string] $part_number
 * @param [string] $title_text
 * @return collection
 */
function set_collection($collection_type, $title_element_level, $part_number, $title_text) {
    if (($collection_type < 10 || $collection_type < 11) && ($title_element_level == "02")) {
        return $title_text . " " . $part_number;
    } else {
        return $title_text;
    }
}
/**
 * function_name: set_sous_collection
 *
 * description: Function for setting "sous_collection" custom field.
 *
 * @param [integer] $collection_type
 * @param [string] $title_element_level
 * @param [string] $part_number
 * @param [string] $title_text
 * @return sous_collection
 */
function set_sous_collection($collection_type, $title_element_level, $part_number, $title_text) {
    if (($collection_type < 10 || $collection_type < 11) && ($title_element_level == "03")) {
        return $title_text . " " . $part_number;
    } else {
        return $title_text;
    }
}
/**
 * function_name: set_dimensions
 *
 * description: Function for setting "dimensions" custom field.
 *
 * @param [string] $measure_type_one
 * @param [string] $measure_type_two
 * @param [string] $measure_unit_code
 * @param [integer] $measurement_one
 * @param [integer] $measurement_two
 * @return H * W + mm
 */
function set_dimensions($measure_type_one, $measure_type_two, $measure_unit_code, $measurement_one, $measurement_two) {
    $h = "";
    $w = "";
    if ($measure_type_one == "01" && $measurement_one !== 0) {
        $h = $measurement_one;
    }
    if ($measure_type_two == "02" && $measurement_two !== 0) {
        $w = $measurement_two;
    }
    return $h . " " . "*" . " " . $w . " " . $measure_unit_code;
}
/**
 * function_name: set_images
 *
 * description: Function for getting images with applied rules.
 *
 * @param [string] $resource_content_type
 * @param [string] $resource_mode
 * @param [string] $resource_version_feature_type
 * @param [integer] $feature_value
 * @param [string] $resource_link
 * @return URLs of images separated with comma
 */
function set_images($resource_content_type, $resource_mode, $resource_version_feature_type, $feature_value, $resource_link) {
    // Make 2 arrays from comma separated string from 2 multiple nodes--> $resource_verstion_feature_type & $feature_value
    $resource_version_feature_type_array = explode(',', $resource_version_feature_type);
    $feature_value_array = explode(',', $feature_value);
    // Iterate through each of these 2 arrays and finally check if sentence and return images.
    foreach($resource_version_feature_type_array as $resource1) {
        foreach($feature_value_array as $resource2) {
            if ($resource_content_type == '01' && $resource_mode == '03' && $resource1 == '03' && $resource2 >= 600) {
                return $resource_link . ',';
            }
        }
    }
}
/**
 * function_name: set_apercu
 *
 * description: Function for getting images with applied rules.
 *
 * @param [string] $resource_content_type
 * @param [string] $resource_mode
 * @param [string] $resource_version_feature_type
 * @param [integer] $feature_value
 * @param [string] $resource_link
 * @return URLs that links to a file or a web-based sample product
 */
function set_apercu($resource_content_type, $resource_mode, $resource_version_feature_type, $feature_value, $resource_link) {
    // Make 2 arrays from comma separated string from 2 multiple nodes--> $resource_verstion_feature_type & $feature_value
    $resource_version_feature_type_array = explode(',', $resource_version_feature_type);
    $feature_value_array = explode(',', $feature_value);
    // Iterate through each of these 2 arrays and finally check if sentence and return images.
    foreach($resource_version_feature_type_array as $resource1) {
        foreach($feature_value_array as $resource2) {
            if ($resource_content_type == '15' && $resource_mode == '04' && $resource1 == '01' && $resource2 >= 600) {
                return $resource_link . '|';
            }
        }
    }
}
/**
 * function_name: set_websiterole
 *
 * description: Function for setting "Site du livre ou de la collection" custom field.
 *
 * @param [string] $website_role
 * @return website_role
 */
function set_websiterole($website_role) {
    if ($website_role == '02' || $website_role == '14') {
        return $website_role;
    }
}
/**
 * function_name: set_pays_exclus
 *
 * description: Function for setting "pays_exclus" custom field.
 *
 * @param [string] $sales_rights_type
 * @param [string] $countries_included
 * @param [string] $countries_excluded
 * @param [string] $regions_included
 * @return countries_excluded
 */
function set_pays_exclus($sales_rights_type, $countries_included, $countries_excluded, $regions_included) {
    $countries_included_array = explode(' ', $countries_included);
    $countries_excluded_array = explode(' ', $countries_excluded);
    if ($sales_rights_type == '03' && (in_array("BJ", $countries_included_array)) && (in_array("CI", $countries_included_array)) && (in_array("SN", $countries_included_array)) && (in_array("TG", $countries_included_array)) && (in_array("NE", $countries_included_array)) && (in_array("BF", $countries_included_array)) && (in_array("ML", $countries_included_array)) && (in_array("GN", $countries_included_array))) {
		return implode(",", $countries_excluded_array);
	} else if ($sales_rights_type == '03' && $regions_included == 'WORLD' && (in_array("BJ", $countries_excluded_array)) && (in_array("CI", $countries_excluded_array)) && (in_array("SN", $countries_excluded_array)) && (in_array("TG", $countries_excluded_array)) && (in_array("NE", $countries_excluded_array)) && (in_array("BF", $countries_excluded_array)) && (in_array("ML", $countries_excluded_array)) && (in_array("GN", $countries_excluded_array))) {
        return implode(",", $countries_excluded_array);
    }
}
/**
 * function_name: set_regular_price1
 * description: Function for checking if unpriced_item_type is present and equal to 1.
 *
 * @param [string] $unpriced_item_type
 * @return 0
 */
function set_regular_price1($unpriced_item_type) {
    if ($unpriced_item_type == '01') {
        return 0;
    }
}
/**
 * function_name: set_regular_price2
 * description: Function for setting up regular price.
 *
 * @param [string] $unpriced_item_type
 * @return 0
 */
function set_regular_price2($price_type, $price_status, $countries_included, $currency_code, $regionsincluded, $price_amount, $multiplier, $nearest, $minus) {
    $nearest = .01;
    if ($price_type == '03' && $price_status == '02' && $currency_code == 'EUR' && ($countries_included == 'BJ' || $regions_included == 'WORLD')) {
        // strip any extra characters from price
		$price = preg_replace("/[^0-9,.]/", "", $price_amount);
        // perform calculations and return final price
        $final_price = (( round ( ( $price * $multiplier ) / $nearest ) * $nearest ) - $minus);
		return $final_price;
    }
}
/**
 * function_name: set_publishing_status
 * description: Function for setting product status.
 *
 * @param [string] $publishing_status
 * @return private/publish
 */
function set_publishing_status($publishing_status) {
    if ($publishing_status == '08') {
        return 'private';
    } else if ($publishing_status == '04') {
        return 'publish';
    }
}
/**
 * function_name: set_coming_soon
 * description: Function for setting coming_soon custom field.
 *
 * @param [string] $publishing_status
 * @return 'yes'
 */
function set_coming_soon($publishing_status) {
    if ($publishing_status == '02') {
        return 'yes';
    }
}
/**
 * function_name: transform_date
 * 
 * description: Function for transforming all different date formats to DD/MM/YYYY.
 *
 * @param [string or integer] $date
 * @param [string] $date_format
 * @param [string] $publishing_date_role
 * @return date in this format DD/MM/YYYY
 */
function transform_date($date, $date_format, $publishing_date_role) {
    if ($publishing_date_role == '01') {
        // Every $date_format should be transformed to this final format: DD/MM/YYYY
        switch ($date_format) {
            case '00':
                // Date format: YYYYMMDD
                $myDateTime = DateTime::createFromFormat('Ymd', $date);
                $newDateString = $myDateTime->format('d/m/Y');
                return $newDateString;
                break;
            case '01':
                // Date format: YYYYMM
                $myDateTime = DateTime::createFromFormat('Ym', $date);
                $newDateString = $myDateTime->format('01/m/Y');
                return $newDateString;
                break;
            case '02':
                // Date format: YYYYWW
                $year = substr($date, 0, 4);
                $week = substr($date, 4);
                $myDateTime = new DateTime();
                $myDateTime->setISODate($year, $week);
                return $myDateTime->format('d/m/Y');
                break;
            case '03':
                // Date format: YYYYQ
                $quarter = substr($date, 4);
                $year = substr($date, 0, 4);
                // Switch statement because we don't know in which format quarter comes : string(01) or integer(1)
                switch ($quarter) {
                    case '01':
                        return '01/01/' . $year;
                        break;
                    case '02':
                        return '01/04/' . $year;
                        break;
                    case '03':
                        return '01/07/' . $year;
                        break;
                    case '04':
                        return '01/10/' . $year;
                        break;
                    default:
                        return "error";
                }
            case '13':
            case '14':
                // Date format: YYYYMMDDThhmmda
                $myDateTime = new DateTime($date);
                $newDateString = $myDateTime->format('d/m/Y');
                return $newDateString;
            case '20':
                // Date format: YYYYMMDD
                $myDateTime = DateTime::createFromFormat('Ymd', $date);
                $newDateString = $myDateTime->format('d/m/Y');
                return $newDateString;
                break;
            case '21':
                // Date format: YYYYMM
                $myDateTime = DateTime::createFromFormat('Ym', $date);
                $newDateString = $myDateTime->format('01/m/Y');
                return $newDateString;
                break;
        }
    }
}
/**
 * function_name: set_category
 *
 * description: Function for setting hierarhial categories via JSON file with categorization values.
 *
 * @param [integer] $subject_scheme_identifier
 * @param [string] $subject_code
 * @return product category hierarhy
 */
function set_category($subject_scheme_id, $subject_code) { //WHENI'M DONE I NEED TO RENAME THAT FUNCTION TO ORIGINAL AND DELETE EXISTING FUNCTION
    $prefix = "Livres>Ebook>"; // add hierarhy for every category
	$file_url = 'https://api.myjson.com/bins/p2vw3'; // path to JSON file with categorization values
    $data = file_get_contents($file_url); // put the contents of the file into a variable
    $categories = json_decode($data, true); // decode the JSON feed
    if ($subject_scheme_id !== '20') {
        switch ($subject_scheme_id) {
            case 10:
            case 12:
            case 93:
                foreach ($categories as $category) {
                    $trim_percent = rtrim($category['Code'], '%');
                    if (($category['Scheme ID'] == $subject_scheme_id) && (strpos($subject_code, $trim_percent) == $trim_percent)) {
                    echo $prefix . $category['Catégorie'] . '|';
                    }
                }
                break;
            case 29:
                foreach ($categories as $category) {
                    if (($category['Scheme ID'] == $subject_scheme_id) && ($subject_code == $category['Code'])) {
                       echo $prefix . $category['Catégorie'] . '|';
                    }
                }
                break;
            default:
        }
    }
}
?>