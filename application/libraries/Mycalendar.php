<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	Prashant Shukla
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Mycalendar Class
 *
 * Permits email to be sent using Mail, Sendmail, or SMTP.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Prashant Shukla
 * @link		http://cztn.co.in
 */

class Mycalendar{
	
	private $CI;
 
    function __construct()
    {
        $this->CI = get_instance();
    }
 	function isItValidDate($date) {
  if(preg_match("/^(\d{2})\/(\d{2})\/(\d{4})$/", $date, $matches))
   {
    if(checkdate($matches[2], $matches[1], $matches[3]))
      {
       return true; 
      }
   }
 }
	function NumberOfDayInMonth($month, $year)
    {
       $timespan  = mktime(0, 0, 0, $month,1,$year);
		$no= date("t", $timespan);
		return (int)$no;
    }
	
	function GetDayName($day,$month,$year,$format)
    {
       $timespan  = mktime(0, 0, 0, $month,$day,$year);
	   if($format==='S'){$name= date("D", $timespan);}
	   if($format==='L'){$name= date("l", $timespan);}
		return $name;
    }
	function GetMonthName($month,$year,$format)
    {
       $timespan  = mktime(0, 0, 0, $month,1,$year);
	   if($format==='S'){$name= date("M", $timespan);}
	   if($format==='L'){$name= date("F", $timespan);}
		return $name;
    }
	function GetTimestampFromDate($yyyymmdd){
		return $timestamp = strtotime($yyyymmdd);
	}
	
	function GetTimestampDateForReport($d){
		$d	= explode('/', $d);
		$yyyymmdd =  $d[2].'-'.$d[1].'-'.$d[0];
		return $timestamp = strtotime($yyyymmdd);
	}
	
	function GetDateFromTimestamp($timestamp){
		return date('Y-m-d', $timestamp);
		
		}
	
	function GetDaysDataFromMonth($month, $year, $Format){
		
		$NoofDays = $this->NumberOfDayInMonth($month, $year);
		
		if($NoofDays!=0){
			for($i=1; $i<=$NoofDays; $i++){
				$NDay = $this->GetDayName($i,$month,$year,$Format);
				
				$d[$i]=$NDay;
				if($NDay=='Sun' || $NDay=='Sunday'){$a=1;$s+=$a;$data[$NDay]=$s;}
				if($NDay=='Mon' || $NDay=='Monday'){$a=1;$m+=$a;$data[$NDay]=$m;}
				if($NDay=='Tue' || $NDay=='Tuesday'){$a=1;$t+=$a;$data[$NDay]=$t;}
				if($NDay=='Wed' || $NDay=='Wednesday'){$a=1;$w+=$a;$data[$NDay]=$w;}
				if($NDay=='Thu' || $NDay=='Thursday'){$a=1;$th+=$a;$data[$NDay]=$th;}
				if($NDay=='Fri' || $NDay=='Friday'){$a=1;$f+=$a;$data[$NDay]=$f;}
				if($NDay=='Sat' || $NDay=='Saturday'){$a=1;$st+=$a;$data[$NDay]=$st;}	
			}
			
			$data['Days'] = $d;
			$data['NoOfDays']=$NoofDays;
			$data['MonthName']=$this->GetMonthName($month,$year,$Format);
			return $data
			;
			
			
			
			
			}
		
	}
	function getIndianCurrency(float $number)
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
    $digits = array('', 'hundred','thousand','lakh', 'crore','arab');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? '' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal) ? "and " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
   return strtoupper(($Rupees ? $Rupees . 'Rupees ' : '') . $paise).' ONLY';
}
	 
}
?>