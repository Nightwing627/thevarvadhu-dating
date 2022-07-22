<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 */

if ( ! function_exists('clear_path_cache'))
{
    function clear_path_cache($uri)
    {
        $CI =& get_instance();
        $path = $CI->config->item('cache_path');
        //path of cache directory
        $cache_path = ($path == '') ? APPPATH.'cache/' : $path;

        $uri =  $CI->config->item('base_url').
        $CI->config->item('index_page').
        $uri;
        $cache_path .= md5($uri);

        return @unlink($cache_path);
    }
}


/**
 * Clears all cache from the cache directory
 */

if ( ! function_exists('clear_all_cache')) 
{
    function clear_all_cache()
    {
        $CI =& get_instance();
        $path = $CI->config->item('cache_path');

        $cache_path = ($path == '') ? APPPATH.'cache/' : $path;

        $handle = opendir($cache_path);
        while (($file = readdir($handle))!== FALSE) 
        {
            //Leave the directory protection alone
            if ($file != '.htaccess' && $file != 'index.html')
            {
            @unlink($cache_path.'/'.$file);
            }
        }
        closedir($handle);       
    }
}
