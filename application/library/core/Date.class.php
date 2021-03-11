<?php 
namespace library\core;

/**
 * Microdle Framework (https://microdle.com/).
 * Date conversions and operations.
 * 
 * @author Vincent SOYSOUVANH
 * 
 * @version 0.1
 * 
 * @package library.core
 */
class Date {
	/**
	 * YYYY-mm-dd date format.
	 * 
	 * @var string
	 */
	const YYYYMMDD_FORMAT = 'Y-m-d';
	
	/**
	 * dd/mm/YYYY date format.
	 * 
	 * @var string
	 */
	const DDMMYYYY_FORMAT = 'd/m/Y';
	
	/**
	 * Apply addition or substraction on date. Format date expected: Date::YYYYMMDD_FORMAT or Date::DDMMYYYY_FORMAT.
	 * 
	 * @param string $date Date in input format.
	 * @param integer $day Number of days to add or substract.
	 * @param integer $month (optional) Number of months to add or substract.
	 * @param integer $year (optional) Number of years to add or substract.
	 * @param string $outputFormat (optional) Output date format.
	 * @param string $inputFormat (optional) Input date format.
	 * 
	 * @return string Date result in output date format.
	 */
	static public function compute($date, $day, $month = 0, $year = 0, $outputFormat = Date::YYYYMMDD_FORMAT, $inputFormat = Date::YYYYMMDD_FORMAT) {
		if(!preg_match('/(\d+)[-\/](\d+)[-\/](\d+)/', $date, $e)) {
			return false;
		}
		if($inputFormat == Date::DDMMYYYY_FORMAT) {
			$y = $e[3];
			$e[3] = $e[1];
			$e[1] = $y;
		}
		return date($outputFormat, mktime(0, 0, 0, ((integer)$e[2]) + $month, ((integer)$e[3]) + $day, ((integer)$e[1]) + $year));
	}
	
	/**
	 * Convert timestamp to locale format.
	 * 
	 * @param integer $timestamp Timestamp UNIX.
	 * @param string $format (optional) Format. "%A %d %B %Y %T %H:%M:%S" by default.
	 * @param unknown_type $locale (optional) Locale. "fr_FR.UTF8" by default.
	 * @param string $i18n (optional) Language code. "fra" by default.
	 * 
	 * @return string
	 */
	static public function toLocale($timestamp, $format = '%A %d %B %Y %T %H:%M:%S', $locale = 'fr_FR.UTF8', $i18n = 'fra') {
		setlocale(LC_TIME, $locale, $i18n);
		return strftime($format, $timestamp);
	}
	
	/**
	 * Convert ddmmYYYY to YYYYmmdd format.
	 * 
	 * @param string $dmy dd/mm/YYYY format.
	 * 
	 * @return string YYYY-mm-dd format.
	 */
	static public function toYmd($dmy) {
		return preg_replace('/(\d{2})\/?(\d{2})\/?(\d{4})/', '$3-$2-$1', $dmy);
	}
	
	/**
	 * Convert YYYYmmdd to ddmmYYYY format.
	 * 
	 * @param string $ymd YYYY-mm-dd format.
	 * 
	 * @return string dd/mm/YYYY format.
	 */
	static public function toDmy($ymd) {
		return preg_replace('/(\d{4})-?(\d{2})-?(\d{2})/', '$3/$2/$1', $ymd);
	}
	
	/**
	 * Check date in dd/mm/YYYY format.
	 * 
	 * @param string $date Date in dd/mm/YYYY format.
	 * 
	 * @return boolean true if date is valid, otherwise false.
	 */
	static public function isDmy($date) {
		return preg_match('/(\d{2})\/?(\d{2})\/?(\d{4})/', $date, $e) ? checkdate($e[2], $e[1], $e[3]) : false;
	}
	
	/**
	 * Check date in YYYY-m-dd format.
	 * 
	 * @param string $date Date in YYYY-m-dd format.
	 * 
	 * @return boolean true if date is valid, otherwise false.
	 */
	static public function isYmd($date) {
		return preg_match('/(\d{4})-?(\d{2})-?(\d{2})/', $date, $e) ? \checkdate($e[2], $e[3], $e[1]) : false;
	}
	
	/**
	 * Check date in YYYY-m-dd format.
	 * 
	 * @param string $date Date to check.
	 * @param string $format (optional) Date format. "Y-m-d H:i:s" by default.
	 * 
	 * @return boolean true if date is valid, otherwise false.
	 */
	static public function isValid($date, $format = 'Y-m-d H:i:s') {
		$d = \DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) === $date;
	}
	
	/**
	 * Check major date.
	 * 
	 * @param string $ymd Date in yyyy-mm-dd format.
	 * @param integer $age Age. 18 by default.
	 * 
	 * @return boolean true if $date is major.
	 */
	static public function isMajor(string $ymd, $age = 18): bool {
		//Case dd/mm/yyyy format
		if(self::isDmy($ymd)) {
			//Convert date to yyyy-mm-dd
			$ymd = preg_replace('/(\d{2})\/?(\d{2})\/?(\d{4})/', '$3-$2-$1', $ymd);
		}
		
		//Case not a valid date in yyyy-mm-dd format
		if(!self::isValid($ymd, 'Y-m-d')) {
			return false;
		}
		
		//Return result
		return $ymd <= self::compute(date('Y-m-d'), 0, 0, -1 * $age);
	}
}
?>