<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       deligo.pl
 * @since      1.0.0
 *
 * @package    Bss_Basic_Social_Share
 * @subpackage Bss_Basic_Social_Share/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Bss_Basic_Social_Share
 * @subpackage Bss_Basic_Social_Share/public
 * @author     Deligo.pl <slawomir.s@deligo.pl>
 */
class Bss_Basic_Social_Share_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	protected $_share_services = [
        'f'=>'facebook',
        't'=>'twitter',
        'l'=>'linkedin',
        'p'=>'pinterest',
        'e'=>'email'
    ];

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->plugin_options = get_option( 'bss_settings' );

	}


    /**
     * Add shortcode for social icons
     */
    public function register_shortcodes() {
        add_shortcode( 'bbss', array( $this, 'render_shortcode' ) );
    }

    /**
     * Render shortcodes
     */
    public function render_shortcode($atts)
    {

        ob_start();
            include( Bss_Basic_Social_Share_Loader::locateTemplate('bss-basic-social-share-public-display.php') );
        return ob_get_clean();
    }

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

        if (!empty($this->plugin_options) &&
            (!isset($this->plugin_options['bss_share_stylesheet']) || $this->plugin_options['bss_share_stylesheet'] === 'yes')) {
            wp_enqueue_style($this->plugin_name,
                plugin_dir_url(__FILE__) . 'css/bss-basic-social-share-public.css',
                array(),
                $this->version,
                'all');
        }

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {




	}

	public function get_allowed_share_options() {
	    if(!(empty($this->plugin_options) && isset($this->plugin_options['bss_share_services']))){

            $shoptions  = explode(',',$this->plugin_options['bss_share_services']);

            array_walk($shoptions,function(&$service){
                $service = trim($service);
            });

            $selected_sh_services = array_intersect_key($this->_share_services,array_flip($shoptions));

            if(count($selected_sh_services)==0){
                return $this->_share_services;
            }

            return $selected_sh_services;
        }else{
	        return $this->_share_services;
        }
    }

	//share options

    public function share_facebook($str_page_title,$url_current_page,$settings = [])
    {

        $data = [
            'url'=>'https://www.facebook.com/sharer.php?u='.esc_attr($url_current_page),
            'class'=>'ssba_facebook_share',
            'icon'=> plugin_dir_url( __FILE__ ).'img'.'/facebook.png',
            'alt'=> 'Share on Facebook',
            'title'=>'Facebook'
        ];

        return $data;
    }

    public function share_twitter($str_page_title,$url_current_page,$settings = [])
    {


        // Format the URL into friendly code.
        $twitter_share_text =
            rawurlencode(html_entity_decode($str_page_title , ENT_COMPAT, 'UTF-8'));

        $data = [
            'url'=>'https://twitter.com/share?url='.esc_attr($url_current_page).'&amp;text='.esc_attr($twitter_share_text),
            'class'=>'bss_twitter_share',
            'icon'=> plugin_dir_url( __FILE__ ).'img'.'/twitter.png',
            'alt'=> 'Share on Twitter',
            'title'=>'Twitter'
        ];

        return $data;
    }

    public function share_linkedin($str_page_title,$url_current_page,$settings = [])
    {
        
        $data = [
            'url'=>'https://www.linkedin.com/shareArticle?mini=true&amp;url=' .esc_attr($url_current_page),
            'class'=>'bss_linkedin_share ssba_share_link',
            'icon'=> plugin_dir_url( __FILE__ ).'img'.'/linkedin.png',
            'alt'=> 'Share on LinkedIn',
            'title'=>'LinkedIn'
        ];

        return $data;
    }

    public function share_pinterest($str_page_title, $url_current_page,$settings = [])
    {
        
        $data = [
            'class'=>'ssba_pinterest_share',
            'icon'=> plugin_dir_url( __FILE__ ).'img'.'/pinterest.png',
            'alt'=> 'Pin on Pinterest',
            'title' => 'Pinterest'
        ];

        // If using featured images for Pinteres.
        // If this post has a featured image.
        if (has_post_thumbnail($settings['post_id'])) {
            // Get the featured image.
            $url_post_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($settings['post_id']), 'full');
            $url_post_thumb = $url_post_thumb[0];
            // Pinterest share link.
            $data['url'] = 'https://pinterest.com/pin/create/bookmarklet/?is_video=false&url=' .
                esc_attr($url_current_page) .
                '&media=' .
                esc_attr($url_post_thumb) .
                '&description=' .
                esc_attr($str_page_title) ;
        } else {
            // No featured image set.
            // Use the choice of pinnable images approach.
            $data['url'] = 'javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;//assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());';
            
        }


        return $data;
    }

    public function share_email($str_page_title, $url_current_page,$settings = [])
    {

        // Replace ampersands as needed for email link.
        $email_title = str_replace( '&', '%26', $str_page_title );

        $url = 'mailto:?subject=' . $email_title . '&amp;body=' . ' ' . $url_current_page;

        $data = [
            'url'=>$url,
            'class'=>'ssba_email_share',
            'icon'=> plugin_dir_url( __FILE__ ).'img'.'/email.png',
            'alt'=> 'Share via Email',
            'title' => 'Email'
        ];

        return $data;

    }

}