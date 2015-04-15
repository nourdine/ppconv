<?php

namespace ppconv;

class Converter {

   const WS = " ";

   /**
    * Takes a postgres array representation string and returns a php array.
    * Does NOT support yet recursion.
    * 
    * @param string $text
    * @return array
    */
   public static function toPhpArray($pgArrayString) {
      $pgArrayString = trim($pgArrayString, self::WS . '{}'); // remove {, } and the empty space char.
      if ($pgArrayString === "") {
         return array();
      }
      return str_getcsv(trim($pgArrayString, '{}'));
   }

   /**
    * Takes an array and returns an array-like postgres string.
    * Support recursion.
    * 
    * @param array $array
    * @return string
    */
   public static function toPgArray(array $set) {
      $result = array();
      foreach ($set as $t) {
         if (is_array($t)) {
            $result[] = self::toPgArray($t);
         } else {
            $t = str_replace('"', '\\"', $t); // escape double quote
            if (!is_numeric($t)) // quote only non-numeric values
               $t = '"' . $t . '"';
            $result[] = $t;
         }
      }
      return '{' . implode(",", $result) . '}';
   }
}
