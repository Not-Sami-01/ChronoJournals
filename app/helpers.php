<?php
use Carbon\Carbon;

function checkLogin(): bool
{
  if (session()->has('user_id') && session()->has('auth_token') && session()->has('username') ) {
    return true;
  } else {
    return false;
  }
}
function encryptJournal($data, $key) {
  // Method for encryption
  $method = 'aes-256-cbc';
  
  // Create an initialization vector
  $ivLength = openssl_cipher_iv_length($method);
  $iv = openssl_random_pseudo_bytes($ivLength);
  
  // Encrypt the data
  $encryptedData = openssl_encrypt($data, $method, $key, 0, $iv);
  
  // Combine the IV and encrypted data
  $result = base64_encode($iv . $encryptedData);
  
  return $result;
}

function decryptJournal($data, $key) {
  // Method for decryption
  $method = 'aes-256-cbc';
  
  // Decode the base64 encoded data
  $decodedData = base64_decode($data);
  
  // Get the IV length
  $ivLength = openssl_cipher_iv_length($method);
  
  // Extract the IV and encrypted data
  $iv = substr($decodedData, 0, $ivLength);
  $encryptedData = substr($decodedData, $ivLength);
  
  // Decrypt the data
  $decryptedData = openssl_decrypt($encryptedData, $method, $key, 0, $iv);
  
  return $decryptedData;
}


function capFirstLetter($str){
  return ucfirst(strtolower($str));
}
// For displaying date on the home page
function formatDate($someThing){
  $dateString = $someThing;
  $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);
  if ($date === false) {
    // Handle the error, maybe return a default value or throw an exception
    return "Invalid date format";
  }
  return $date->format('F j, Y g:i a');
}

// For inserting date into database
function myFormatDateTime($dateString) {
  // Create a DateTime object from the input string
  $date = DateTime::createFromFormat('Y-m-d\TH:i', $dateString);
  
  // Check if the date was created successfully
  if ($date === false) {
      return "Invalid date format";
  }
  
  // Format the date to the desired output
  return $date->format('Y-m-d H:i:s');
}

// For displaying date on the edit page
function valueFormattedDate($dateString)
{
    // Convert the date string to a Carbon instance
    $date = Carbon::createFromFormat('Y-m-d H:i:s', $dateString);
    
    // Return the date in the format for datetime-local input
    return $date->format('Y-m-d\TH:i');
}

function filterString($str){
  $newString = str_replace('<p>&nbsp;</p>', '', $str);
  return $newString;
}
