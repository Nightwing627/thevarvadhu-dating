<?php
    $meta_keywords = $this->db->get_where('general_settings', array('general_settings_id' => 25))->row()->value;
    $meta_description = $this->db->get_where('general_settings', array('general_settings_id' => 24))->row()->value;
?>


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php echo $meta_description; ?>">
<meta name="keywords" content="<?php echo $meta_keywords; ?>">
<meta name="author" content="<?=$this->db->get_where('general_settings', array('general_settings_id' => 26))->row()->value?>">
<meta name="revisit-after" content="<?=$this->db->get_where('general_settings', array('general_settings_id' => 54))->row()->value?> day(s)">

<?php
    if($page == 'home' || $page == 'listing' || $page == 'plans' || $page == 'stories' || $page == 'story_detail')
    {
        
        $meta_title = $this->db->get_where('general_settings', array('general_settings_id' => 89))->row()->value;
        $site_name = $this->db->get_where('general_settings', array('general_settings_id' => 1))->row()->value;

        $seo_image_facebook = $this->db->get_where('general_settings', array('general_settings_id' => 90))->row()->value;

        if (!empty($seo_image_facebook) && file_exists('uploads/seo_image/'.$seo_image_facebook)) {
            $seo_image_facebook_url = base_url()."uploads/seo_image/".$seo_image_facebook;
        }else{
            $seo_image_facebook_url = base_url()."uploads/seo_image/seo_image_facebook _default.png";
        }

        $seo_image_twitter = $this->db->get_where('general_settings', array('general_settings_id' => 91))->row()->value;
        if (!empty($seo_image_twitter) && file_exists('uploads/seo_image/'.$seo_image_twitter)) {
            $seo_image_twitter_url = base_url()."uploads/seo_image/".$seo_image_twitter;
        }else{
            $seo_image_twitter_url = base_url()."uploads/seo_image/seo_image_twitter_default.png";
        }
    ?>
    <!-- Open Graph data -->
    <meta property="og:title" content="<?php echo $meta_title; ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="<?php  echo base_url().$page_url; ?>" />
    <meta property="og:image" content="<?php echo $seo_image_facebook_url; ?>" />
    <meta property="og:description" content="<?php echo $meta_description; ?>" />
    <meta property="og:site_name" content="<?php echo $site_name; ?>" />


    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="<?php echo $site_name; ?>">
    <meta name="twitter:title" content="<?php echo $meta_title; ?>">
    <meta name="twitter:description" content="<?php echo $meta_description; ?>">
    <!-- Twitter summary card with large image must be at least 280x150px -->
    <meta name="twitter:image:src" content="<?php echo $seo_image_twitter_url; ?>">
<?php } ?>
