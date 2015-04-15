<?php

use ppconv\Converter;

class CoverterTest extends PHPUnit_Framework_TestCase {

   public function testToPgArray() {
      $pgString = Converter::toPgArray(array(
                  "a",
                  "b",
                  "c"
      ));
      $this->assertEquals('{"a","b","c"}', $pgString);
   }

   public function testToPgArray_empty_array() {
      $pgString = Converter::toPgArray(array());
      $this->assertEquals('{}', $pgString);
   }

   public function testToPgArray_assoc_array() {
      $pgString = Converter::toPgArray(array(
                  "a" => "x",
                  "b" => "y"
      ));
      $this->assertEquals('{"x","y"}', $pgString);
   }

   public function testToPgArray_with_strings_containing_single_quotes() {
      $pgString = Converter::toPgArray(array(
                  "a'a",
                  "b'b"
      ));
      $this->assertEquals('{"a\'a","b\'b"}', $pgString);
   }

   public function testToPgArray_with_strings_containing_double_quotes() {
      $pgString = Converter::toPgArray(array(
                  'a"a',
                  'b"b'
      ));
      $this->assertEquals('{"a\"a","b\"b"}', $pgString);
   }

   public function testToPhpArray() {
      $arr = Converter::toPhpArray('{"a","b","c"}');
      $this->assertEquals('a', $arr[0]);
      $this->assertEquals('b', $arr[1]);
      $this->assertEquals('c', $arr[2]);
      $this->assertEquals(3, count($arr));
   }

   public function testToPhpArray_empty_array() {
      $arr = Converter::toPhpArray('{}');
      $this->assertEquals(0, count($arr));
   }

   public function testToPhpArray_empty_array_ws() {
      $arr = Converter::toPhpArray(' { } ');
      $this->assertEquals(0, count($arr));
   }
}
