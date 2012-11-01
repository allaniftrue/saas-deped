<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('toPDF')) {
    
    function toPDF($data="",$filename="saas_e_output.pdf",$watermark="") {
        $ci =& get_instance(); 
        $ci->load->library('mpdf');
        if(! empty($watermark)) {
            $ci->mpdf->SetWatermarkText($watermark);
            $ci->mpdf->showWatermarkText = true;
        }
        $ci->mpdf->SetCompression(TRUE);
        $ci->mpdf->charset_in = 'iso-8859-4';
        $ci->mpdf->WriteHTML($data);
        $ci->mpdf->Output($filename);
        exit;
    }
}

if(! function_exists('array_to_lower')) {
    function array_to_lower($needle, $haystack)  {
        return in_array( strtolower($needle), array_map('strtolower', $haystack) );
    }
}
?>
