<?php
/**
 *
 * ==========================================
 * Author: @Janez Kolar (jan3zkolar@gmail.com)
 * Last Edited: May 9rd, 2019 at 12:56pm
 * ==========================================
 *
 * function_name: featured_image
 *
 * description: Function looks for the array of images through WooCommerce product class and returns one image depending on the imageposition. Gallery for product variations was lacking images so this function solves this exact problem.
 *
 * @param [array] $images
 * @param [integer] $parentid
 * @param [integer] $imageposition
 * @return mixed: Url of the image depending on @param $imageposition to extract exactly that image from $images array (for variable products get images array from WP database from parent product with $parentid)
 */
function featured_image($images, $parentid, $imageposition){
    // *** IF STATEMENTS FOR CLOTHES (DIFFERENT PICTURES WITH 2:3 RATIO REQUIRED) ***
    if ($parentid == 21692) { // PUSH-UP BRAS
        $pushupbras = array(
            "https://vigoshop.hu/wp-content/uploads/2019/05/EMAG-HU-VIGO-nevidni-Push-Up-nedrček-1.jpg",
            "https://vigoshop.hu/wp-content/uploads/2019/05/EMAG-HU-VIGO-nevidni-Push-Up-nedrček-2.jpg",
            "https://vigoshop.hu/wp-content/uploads/2019/05/EMAG-HUVIGO-nevidni-Push-Up-nedrček-3.jpg",
            "https://vigoshop.hu/wp-content/uploads/2019/05/EMAG-HU-VIGO-nevidni-Push-Up-nedrček-4.jpg",
            "https://vigoshop.hu/wp-content/uploads/2019/05/EMAG-HUVIGO-nevidni-Push-Up-nedrček-5.jpg");
        $value = current(array_slice($pushupbras, $imageposition, 1));
        return $value;
    } elseif ($imageposition == 0) { // Always return the first image when imageposition == 0.
        $value = current(array_slice($images, 0, 1));
        return $value;
    } elseif ($parentid == 0) { // If the product is "simple", return the image from current $images array
        $value = current(array_slice($images, $imageposition, 1));
        return $value;
    } else { //If the product is a "variation" product, get array of images from parent product.
        $product = new WC_product($parentid);
        $attachment_ids = $product->get_gallery_attachment_ids();
        $galerija = array();
        foreach( $attachment_ids as $attachment_id ) {
            // Display the image URL
            $Original_image_url = wp_get_attachment_url( $attachment_id );
            $galerija[] = $Original_image_url;
        }
        $value = array_slice($galerija, $imageposition-1, 1);
        if($value) {
        return $value;
        } else {
            return '';
        }
    }
}
/**
 * //  ***for eMAG Marketplace only*** //
 * function_name: tax
 *
 * description: Function returns sale_price - VAT(27%).
 *
 * @param [integer] $price
 * @return integer: minus VAT
 */
function tax($price) {
    $vat = 0.27;
    $calculated_price = 0;
    $calculated_price = (intval($price)/(1 + $vat));
    return round($calculated_price, 2);
}
/**
 * //  ***for eMAG Marketplace only*** //
 * function_name: stock_checker
 *
 * description: Function checks if product is in stock and returns random stock.
 *
 * @param [string] $productstatus
 * @param [string] $stockstatus
 * @return integer: random stock - number between 5 - 25
 */
function stock_checker($productstatus, $stockstatus) {
    if ($productstatus == 'publish' and $stockstatus == 'instock') {
        return rand(5, 25);
    } else {
        return '0';
    }
}
/**
 * function_name: variations_name_stitcher
 *
 * description: Functions checks if product is a variation product and return parent title + attributes.
 *
 * @param [string] $title
 * @param [array] $producttype
 * @param [array of arrays] ...$attributes
 * @return string: For 'simple' products-->Title of the product;For 'variable' products-->Title of the product + attributes
 */
function variations_name_stitcher($title, $producttype, ...$attributes) {
    if ($producttype[0] == 'simple' || $producttype[0] == 'bundle') {
        return $title;
    } elseif ($producttype[0] == 'variable') {
        $clean_array = array_filter($attributes);
        $reordered_array = array_values($clean_array);
        if (count($reordered_array) == 1) {
            $title = $title . ", ";
            return $title . implode($reordered_array);
        } elseif (count($reordered_array) == 2) {
            $title = $title. ", ";
            return $title . $reordered_array[0] . ", " . $reordered_array[1];
        } elseif (count($reordered_array) == 3) {
            $title = $title. ", ";
            return $title . $reordered_array[0] . ", " . $reordered_array[1] . ", " . $reordered_array[2];
        }
    }
}
/**
 * function_name: parentidchecker
 *
 * description: Function is only returning parentid needed for grouping product variations in eMAG marketplace.
 *
 * @param [array] $producttype
 * @param [maybe integer or maybe string :D] $parentid
 * @return number Parent id for 'variable' products, for 'simple' products return empty string
 */
function parentidchecker($producttype,$parentid) {
    if ($producttype[0] == 'simple' || $producttype[0] == 'bundle') {
        return "";
    } else {
        return $parentid;
    }
}
/**
 * //  ***for eMAG Marketplace only*** //
 * function_name: wistia_iframe_constructor
 *
 * description: This function checks for wistia oembed URL in ACF meta field or in product description (with REGEX) and transforms it to <iframe> and then return $content with wistia <iframe> video at the beginning of $content.
 *
 * @param [string] $content
 * @param [integer] $parentid
 * @param [string] $videourl
 * @param [string] $productname
 * @return string: $content with wistia <iframe> video at the beginning
 */
function wistia_iframe_constructor($content, $parentid, $videourl, $productname) {
    $iframestart = '<iframe src="https://fast.wistia.net/embed/iframe/';
    $iframebetween = '?rel=0" title="';
    $seotitle = $productname;
    $iframeend = '" allowtransparency="true" frameborder="0" scrolling="no" name="wistia_embed" allowfullscreen mozallowfullscreen webkitallowfullscreen oallowfullscreen msallowfullscreen width="600" height="600"></iframe>';
    if (!empty($videourl)) { // check if ACF field for wistia ID not empty
        return $iframestart . $videourl . $iframebetween . $seotitle . $iframeend . $content;
    } elseif (empty($videourl)) {
        preg_match_all('/https?:\/\/(.+)?(wistia\.com|wi\.st)\/(medias|embed)\/.*/', $content, $wistiaurl, PREG_PATTERN_ORDER); //extract wistia URL video from content
        if (empty($wistiaurl[0])) { // check if array for scraping wistia URL from description is empty for simple and variable product
            $wistiaidfromparent = get_post_meta($parentid, 'product_video_url', true);
            if (!empty($wistiaidfromparent)) {
                return $iframestart . $wistiaidfromparent . $iframebetween . $seotitle . $iframeend . $content;
            } else {
                return $content;
            }
        } else {
            //extract wistia video ID from wistia URL
            preg_match_all('/\/medias\/(.+)(\?)/', $wistiaurl[0][0], $wistiaid, PREG_PATTERN_ORDER);
            $finalid = implode(', ', $wistiaid[1]);
            return $iframestart . $finalid . $iframebetween . $seotitle . $iframeend . $content;
        }
    }
}
/**
 * function_name: extract_ul_tags
 *
 * description: Function checks description for html <ul> </ul> tags and returns everything between them. (For extracting specifications.)
 *
 * @param [string] $description
 * @return string: Product specifications: everything between <ul> - </ul> tags from $description - product description.
 */
function extract_ul_tags($description) {
    preg_match_all("/<ul>(.*?)<\/ul>/s", $description, $out, PREG_PATTERN_ORDER);
    if (count($out[0]) == 0) {
    } elseif (count($out[0]) == 1) {
        return $out[0][0];
    } else {
        $sliced = array_slice($out[0], 0, -1); // All <ul></ul> tags without last one.
        $specifications = implode(" ", $sliced); // Group <ul> tags.
        return $specifications;
    }
}
/**
 * function_name: add_utm_code_to_url
 *
 * description: Function adds utm parameters to product URLs for checking statistics through Google Analytics.
 *
 * @param [array] $producttype
 * @param [string] $url
 * @return url: Product permalink with attached UTM codes
 */
function add_utm_code_to_url($producttype,$url) {
    $utm_code = 'utm_campaign=_Vigoshop&utm_source=xml&utm_medium=arukereso_hu';
    if ($producttype[0] == 'simple' || $producttype[0] == 'bundle') {
        $urlwithutm = $url . '?' . $utm_code; // Add utm_code with '?' first
        return $urlwithutm;
    } elseif ($producttype[0] == 'variable') {
        $urlwithutm = $url . '&' . $utm_code; // Add utm_code with '?' first
        return $urlwithutm;
    } else {
        $urlwithutm = $url . '?' . $utm_code; // Add utm_code with '?' first
        return $urlwithutm;
    }
}
/**
 * //  ***for eMAG Marketplace only*** //
 * function_name: acf_field_inserter
 *
 * description: Function returns given ACF (meta) field
 *
 * @param [array] $producttype
 * @param [integer] $postid
 * @param [integer] $parentid
 * @param [string] $emagcategory
 * @return ACF_Field: ACF field for a simple or variable product
 */
function acf_field_inserter($producttype, $postid, $parentid, $acffield) {
    if ($producttype[0] == 'simple') { // Check if simple product-->return emag category
        return $acffield;
    } else { // if variable product, get parent post ID from variation post ID and get emag acf field from that parent post ID
		$parentpostid = wp_get_post_parent_id($postid);
		$emagACF = get_field('category_emag', $parentpostid);
		return $emagACF;
    }
}
?>