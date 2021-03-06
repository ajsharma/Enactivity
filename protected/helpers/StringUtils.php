<?php
/**
 * Utilities functions for strings
 */
class StringUtils {

	/**
	 * Create a random string of letters and numbers
	 * @param integer $length number of characters in string
	 */
	public static function createRandomString($length = 10) {
		$chars = "abcdefghijkmnopqrstuvwxyz";
		$chars .= "ABCDEFGHIJKMNOPQRSTUVWXYZ";
		$chars .= "0123456789";
		srand((double) microtime() * 1000000);
		$randomString = '';

		for($i = 0; $i < $length; $i++) {
			$index = rand() % 33;
			$tmp = substr($chars, $index, 1);
			$randomString = $randomString . $tmp;
		}

		return $randomString;
	}

	/**
	 * Create a random string of letters and numbers
	 * @param integer $length number of characters in string
	 */
	public static function createRandomAlphaString($length = 10) {
		$chars = "abcdefghijkmnopqrstuvwxyz";
		$chars .= "ABCDEFGHIJKMNOPQRSTUVWXYZ";
		srand((double) microtime() * 1000000);
		$randomString = '';

		for($i = 0; $i < $length; $i++) {
			$index = rand() % 33;
			$tmp = substr($chars, $index, 1);
			$randomString = $randomString . $tmp;
		}

		return $randomString;
	}

	/**
	 * Create a random string of numbers
	 * @param integer $length number of characters in string
	 */
	public static function createRandomNumericString($length = 10) {
		$chars = "0123456789";
		srand((double) microtime() * 1000000);
		$randomString = '';

		for($i = 0; $i < $length; $i++) {
			$index = rand() % 33;
			$tmp = substr($chars, $index, 1);
			$randomString = $randomString . $tmp;
		}

		return $randomString;
	}

	/**
	 * Returns a 23 character unique string
	 * @return String
	 */
	public static function uniqueString() {
		$string = uniqid('', true);
		$string = str_replace('.', '', $string);
		return $string;
	}

	/**
	 * Truncates the given string to a set length, with the suffix if
	 * the initial string was longer than the length.
	 * @param string $string
	 * @param int $length defaults to 64
	 * @param string $suffix defaults to '...'
	 * @return string of provided length
	 */
	public static function truncate($string, $length = 64, $suffix = '...') {
		if(strlen($suffix) > $length) {
			throw new CHttpException("Truncation suffix is longer than length");
		}

		if(strlen($string) > $length) {
			$string = substr($string, 0, $length - strlen($suffix));
			$string = trim($string);
			$string .= $suffix;
		}
		return $string;
	}

	/**
	 * Create a random email address
	 * @return String email address
	 */
	public static function createRandomEmail() {
		return "pemail+" . StringUtils::uniqueString() . "@alpha.poncla.com";
	}

	/** 
	 * @return boolean if string is blank
	 **/
	public static function isBlank($value) {
		if(is_string($value)) {
			$value = trim($value);
		}
		return empty($value) && !is_numeric($value);
	}

	public static function isNotBlank($value) {
		return !self::isBlank($value);
	}
}
?>