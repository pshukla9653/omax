<?php

class Mycontroller extends CI_Controller {

	public $layout; 
	public $dlayout;
	public $month;
	public $year;
	public function __construct	() { 
	
		parent::__construct();
		$this->load->library('curl');
		$this->layout	= 'layout/main';
		$this->dlayout	= 'layout/main_download';
		$this->month 	= array(1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',
		10=>'October',11=>'November',12=>'December');
		$this->year 	= array('2017'=>'2017','2018'=>'2018','2019'=>'2019','2020'=>'2020','2021'=>'2021','2022'=>'2022');
	}
	

private function sms__unicode($message){
$hex1='';
if (function_exists('iconv')) {
$latin = @iconv('UTF-8', 'ISO-8859-1', $message); if (strcmp($latin, $message)) {
$arr = unpack('H*hex', @iconv('UTF-8', 'UCS- 2BE', $message));
$hex1 = strtoupper($arr['hex']);
}
if($hex1 ==''){
$hex2='';
$hex='';
for ($i=0; $i < strlen($message); $i++){
$hex = dechex(ord($message[$i]));
$len =strlen($hex);
$add = 4 - $len; if($len < 4){
for($j=0;$j<$add;$j++){
$hex="0".$hex;
}
}
$hex2.=$hex;
}
return $hex2;
}
else{
return $hex1;
}
}
else{
print 'iconv Function Not Exists !';
}
}
	
	
	public function sendtextunicode($api,$destination,$msg){
	
	
      $url = 'username='.$api[0]->uname;
      $url.= '&password='.$api[0]->pass;
      $url.= '&type=2&dlr=1';
      $url.= '&destination='.$destination;
      $url.= '&source='.$api[0]->sender_id;
      $url.= '&message='.$msg;
      $urltouse =  $api[0]->sURL.'?'.$url;
	
	/*echo $destination;
	echo $msg;
	echo $urltouse;
	echo var_dump($api);
		echo $msg;exit;*/ 
	
		$ch = curl_init();
		
		$fr=curl_setopt($ch, CURLOPT_POST, false);
		
		curl_setopt($ch, CURLOPT_URL, $urltouse);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); $output = curl_exec($ch);
		curl_close($ch);
		if(!$output){ $output = file_get_contents($urltouse); }
		if($return == '1'){ return $output; }else{ return $output; }
		 return $urltouse;
		
	}
	public function sendSMS($number,$msg){
	
      $url = 'username=omaxss';
      $url.= '&pass=a12345678';
      $url.= '&route=trans1';
	  $url.= '&senderid=OMAXSS';
      $url.= '&numbers='.$number;
      $url.= '&message='.urlencode($msg);
      $urltouse ='http://173.45.76.226:81/send.aspx?'.$url;
 
		$ch = curl_init();
		
		$fr=curl_setopt($ch, CURLOPT_POST, false);
		
		curl_setopt($ch, CURLOPT_URL, $urltouse);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); $output = curl_exec($ch);
		curl_close($ch);
		if(!$output){ $output = file_get_contents($urltouse); }
		if($return == '1'){ return $output; }else{ return $output; }
		 return $output; 
	}
	public function convertDatetoMysqlDate($date){
		$d	= explode('/', $date);
		return $d[2].'-'.$d[1].'-'.$d[0];
		}
	public function getSmsBalance(){
      	$urltouse = 'http://173.45.76.226:81/balance.aspx?username=omaxss&pass=a12345678';
		
		$result = $this->curl->simple_get($urltouse);
		
		return $result;	
	}
	
	private function unicode($message){
$hex1='';
if (function_exists('iconv')) {
$latin = @iconv('UTF-8', 'ISO-8859-1', $message); if (strcmp($latin, $message)) {
$arr = unpack('H*hex', @iconv('UTF-8', 'UCS- 2BE', $message));
$hex1 = strtoupper($arr['hex']);
}
if($hex1 ==''){
$hex2='';
$hex='';
for ($i=0; $i < strlen($message); $i++){
$hex = dechex(ord($message[$i]));
$len =strlen($hex);
$add = 4 - $len; if($len < 4){
for($j=0;$j<$add;$j++){
$hex="0".$hex;
}
}
$hex2.=$hex;
}
return $hex2;
}
else{
return $hex1;
}
}
else{
print 'iconv Function Not Exists !';
}
}

public function getPTax($grosssalary){
		if($grosssalary > 5999){
			if($grosssalary >= 6000 && $grosssalary <= 8999){
				return 80;
			}
			if($grosssalary >= 9000 && $grosssalary <= 11999){
				return 150;
			}
			if($grosssalary >= 12000){
				return 200;
			}
		}
		else{
			return 0;	
		}
}
	
	public function getIndianCurrency(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}
	
	function CTH_debug_var($data)
    {
        echo '<pre>';
			print_r($data);
		echo '</pre>';
    } 
	
	public function import_excel($file){
		//$file = './uploads/test.xls';
		
		$this->load->library('PHPExcel');
		$objPHPExcel = PHPExcel_IOFactory::load($file);
		//echo var_dump($objPHPExcel); exit;
		$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
		foreach ($cell_collection as $cell) {
    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
 
    //header will/should be in row 1 only. of course this can be modified to suit your need.
    if ($row == 1) {
        $header[$row][$column] = $data_value;
    } elseif($row != 1) {
        $arr_data[$row][$column] = $data_value;
    }
}
	$data['header'] = $header;
	$data['values'] = $arr_data;
		return $data;
	}
	
	public function import_result($file){
		//$file = './uploads/test.xls';
		
		//$this->load->library('PHPExcel');
		$objPHPExcel = PHPExcel_IOFactory::load($file);
		//echo var_dump($objPHPExcel); exit;
		$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
		foreach ($cell_collection as $cell) {
    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
 
    //header will/should be in row 1 only. of course this can be modified to suit your need.
    if ($row == 2) {
        $header[$row][$column] = $data_value;
    } elseif($row != 1) {
        $arr_data[$row][$column] = $data_value;
    }
}
	$data['header'] = $header;
	$data['values'] = $arr_data;
		return $data;
	}
	
	public function randomKey($length) {
    $pool = array_merge(range(0,9), range('a', 'z'),range('A', 'Z'));

    for($i=0; $i < $length; $i++) {
        $key .= $pool[mt_rand(0, count($pool) - 1)];
    }
    return $key;
}
	
	public function validateDateForExcel($string){
	
    	$matches = array();
    $pattern = '/^([0-9]{1,2})\\/([0-9]{1,2})\\/([0-9]{4})$/';
    if (!preg_match($pattern, $string, $matches)) return false;
    if (!checkdate($matches[2], $matches[1], $matches[3])) return false;
    return true;
		
		
	}
	public function getDuplicateValueKeys($my_arr) {
	
    array_filter($my_arr, 'strlen');
    $dups = array();
    $new_arr = array();
    $dup_vals = array();

    foreach ($my_arr as $key => $value) {
        if (!isset($new_arr[$value])) {
            $new_arr[$value] = $key;
        } else {
            array_push($dup_vals,$value);
        }
    }

    foreach ($my_arr as $key => $value) {
        if (in_array($value, $dup_vals)) {
            if (!isset($dups[$value])) {
                $dups[$value]=array($key);
            }else{
                array_push($dups[$value],$key);
            }
        }
    }
	foreach($dups as $key=>$value){
						$duplicaterecord[] = $key;
						foreach($value as $skey=>$svalue)
						{
							
							if($svalue!=''){
							$duplicateat[] = $svalue ;
							}
							}	
						}
		if($duplicaterecord[0]!==''){
			
		$data['duplicate']=implode(',', $duplicaterecord);
		$data['key'] = implode(',', $duplicateat);
		}
    return $data;
}

	public function showDups($array){
    
  $array_temp = array();

   foreach($array as $val)
   {
     if (!in_array($val, $array_temp))
     {
       $array_temp[] = $val;
     }
     else
     {
       echo 'duplicate = ' . $val . '<br />';
     }
   }
}

   

   
   
   
}
?>