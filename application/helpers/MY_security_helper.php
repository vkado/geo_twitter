<?php
/**
 * check data id.
 *
 * id_clean() will return data correct format.
 *
 * @access    public
 * @param    $id need to check
 * @param    $size the length of id (optional, default 11)
 *
 * @return    interger
 */
function id_clean($id,$size=11){
	return intval(substr($id,0,$size));
}
/**
 * check data string.
 *
 * db_clean() will return data correct format.
 *
 * @access    public
 * @param    $string need to check
 * @param    $size the length of string (optional, default 255)
 *
 * @return    string
 */
function db_clean($string,$size=255){
	return xss_clean(substr($string,0,$size));
}
?>