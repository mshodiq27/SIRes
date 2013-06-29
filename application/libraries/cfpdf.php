<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cfpdf{
	function __construct(){
		require_once APPPATH.'/libraries/fpdf/fpdf.php';
	}
}
?>