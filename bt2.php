<!DOCTYPE html>
<html>
<body>
<?php
    //c1
$string = "Hello World";
echo "Number of characters: " . strlen($string);
    //c2
$string = "Hello World, this is a test";
echo "Number of words: " . str_word_count($string);
    //c3
$string = "Hello World";
echo "Reversed string: " . strrev($string);
    //c4
$string = "Hello World";
$substring = "World";
echo "Position of substring: " . strpos($string, $substring);
    //c5
$string = "Hello World";
$old_substring = "World";
$new_substring = "Universe";
echo "Replaced string: " . str_replace($old_substring, $new_substring, $string);
    //c6
$string = "Hello World";
$substring = "Hello";
if (strncmp($string, $substring, strlen($substring)) === 0) {
    echo "String starts with substring";
} else {
    echo "String does not start with substring";
}
    //c7
$string = "hello world";
echo "Uppercase string: " . strtoupper($string);
    //c8
$string = "HELLO WORLD";
echo "Lowercase string: " . strtolower($string);
    //c9
$string = "hello world";
echo "Title case string: " . ucwords($string);
    //c10
$string = "   Hello World   ";
echo "Trimmed string: " . trim($string);
    //c11
$string = "   Hello World";
echo "Left-trimmed string: " . ltrim($string);
    //c12
$string = "Hello World   ";
echo "Right-trimmed string: " . rtrim($string);
    //c13
$string = "Hello,World,PHP";
$array = explode(",", $string);
print_r($array);
    //c14
$array = array("Hello", "World", "PHP");
$string = implode(", ", $array);
echo "Joined string: " . $string;
    //c15
$string = "Hello";
$padded_string = str_pad($string, 10, "*", STR_PAD_BOTH);
echo "Padded string: " . $padded_string;
    //c16
$string = "Hello World";
$substring = "World";
if (strrchr($string, $substring) !== false) {
    echo "String ends with substring";
} else {
    echo "String does not end with substring";
}
    //c17
$string = "Hello World";
$substring = "World";
if (strstr($string, $substring) !== false) {
    echo "String contains substring";
} else {
    echo "String does not contain substring";
}
    //c18
$string = "Hello World! @#$";
$clean_string = preg_replace("/[^a-zA-Z0-9]/", "", $string);
echo "Clean string: " . $clean_string;
    //c19
$string = "123";
if (is_int($string)) {
    echo "String is an integer";
} else {
    echo "String is not an integer";
}
    //c20
$email = "example@gmail.com"; // replace with the email address to check

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email is valid";
} else {
    echo "Email is not valid";
}
?>