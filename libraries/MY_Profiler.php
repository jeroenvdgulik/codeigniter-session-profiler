<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Adds session data to the profiler in CodeIgniter 2.0
 * Adds a table row for each item of session data with the key and value
 * Shows both CI session data and custom session data
 *
 * Note: I did not write the original implementation, I just adapted it
 * for CodeIgniter >= 2.0 . You can find the implementation for 
 * CodeIgniter < 2.0 here: 
 * http://codeigniter.com/forums/viewthread/60066/
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Jeroen v.d. Gulik <http://isset.nl>
 * @license		DBAD License v1.0 <http://philsturgeon.co.uk/code/dbad-license>
 * @version		0.1
 */

class MY_Profiler extends CI_Profiler {

 	function MY_Profiler($config = array())
	{
		$this->_available_sections[] = 'session';
		parent::CI_Profiler($config);
	}

    function _compile_session()
	{
        $output  = "\n\n";
        $output .= '<fieldset style="border:1px solid #009999;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee">';
        $output .= "\n";
        $output .= '<legend style="color:#009999;">&nbsp;&nbsp;'.'SESSION DATA'.'&nbsp;&nbsp;</legend>';
        $output .= "\n";

        if (!is_object($this->CI->session))
		{
            $output .= "<div style='color:#009999;font-weight:normal;padding:4px 0 4px 0'>".'No SESSION data exists'."</div>";
        } 
		else
		{
		    $output .= "\n\n<table cellpadding='4' cellspacing='1' border='0' width='100%'>\n";
            $sess = get_object_vars($this->CI->session);

            foreach ($sess['userdata'] as $key => $val)
			{
                if ( ! is_numeric($key))
				{
                    $key = "'".$key."'";
                }

                $output .= "<tr><td width='50%' style='color:#000;background-color:#ddd;'>&#36;_SESSION[".$key."]&nbsp;&nbsp; </td><td width='50%' style='color:#009999;font-weight:normal;background-color:#ddd;'>";

                if (is_array($val))
				{
                    $output .= "<pre>" . htmlspecialchars(stripslashes(print_r($val, true))) . "</pre>";
                } 
				else
				{
                    $output .= htmlspecialchars(stripslashes($val));
                }

                $output .= "</td></tr>\n";
            }

			$output .= "</table>\n";
        }

        $output .= "</fieldset>";

        return $output;    
    }
}

/* End of file MY_Profiler.php */
/* Location: ./application/libraries/MY_Profiler.php */
