<?php
use Carbon\Carbon;

// Checks if the user is logged in
function checkLogin(): bool
{
  if (session()->has('user_id') && session()->has('auth_token') && session()->has('username')) {
    return true;
  } else {
    return false;
  }
}

// Encrypts the journal using a key
function encryptJournal($data, $key)
{
  $method = 'aes-256-cbc';
  $ivLength = openssl_cipher_iv_length($method);
  $iv = openssl_random_pseudo_bytes($ivLength);
  $encryptedData = openssl_encrypt($data, $method, $key, 0, $iv);
  $result = base64_encode($iv . $encryptedData);

  return $result;
}

// Decrypts the journal using the key of encryption
function decryptJournal($data, $key)
{
  $method = 'aes-256-cbc';
  $decodedData = base64_decode($data);
  $ivLength = openssl_cipher_iv_length($method);
  $iv = substr($decodedData, 0, $ivLength);
  $encryptedData = substr($decodedData, $ivLength);
  $decryptedData = openssl_decrypt($encryptedData, $method, $key, 0, $iv);
  return $decryptedData;
}

// For making the first letter of a string capital 
function capFirstLetter($str)
{
  return ucfirst(strtolower($str));
}

// For displaying date on the home page
function formatDate($dateString)
{
  $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);
  if ($date === false) {
    return "Invalid date format";
  }
  return $date->format('F j, Y g:i a');
}

// For inserting date into database
function myFormatDateTime($dateInput)
{
  try {
    $date = new DateTime($dateInput);
    return $date->format('Y-m-d H:i:s');
  } catch (Exception $e) {
    return 'Invalid date';
  }
}

// For displaying date on the edit page
function valueFormattedDate($dateString)
{
  $date = Carbon::createFromFormat('Y-m-d H:i:s', $dateString);
  return $date->format('Y-m-d\TH:i');
}

// For showing data on the home page without newlines
function filterString($str)
{
  $newString = str_replace('<p>&nbsp;</p>', '', $str);
  return $newString;
}

// Reads a json file and returns data in the form of list
function readAndProcessJsonFile($filePath, $asArray = true)
{
  if (!file_exists($filePath)) {
    return ['error' => 'File not found'];
  }
  $myfile = fopen($filePath, "r");
  if (!$myfile) {
    return ['error' => 'Unable to open file'];
  }
  $fileContent = fread($myfile, filesize($filePath));
  fclose($myfile);
  $data = json_decode($fileContent, $asArray);
  if (json_last_error() !== JSON_ERROR_NONE) {
    return ['error' => 'Error decoding JSON: ' . json_last_error_msg()];
  }
  return $data;
}

// Converts UTC date time to Pakistan date tme
function convertToPakistanTime($timeString)
{
  $timezone = 'UTC';
  $dateTime = new DateTime($timeString, new DateTimeZone($timezone));
  $dateTime->setTimezone(new DateTimeZone('Asia/Karachi'));
  return $dateTime->format('Y-m-d H:i:s');
}

// Converts Pakistan date time to UTC date tme
function convertFromPakistanTimeToUTC($timeString)
{
  $dateTime = new DateTime($timeString, new DateTimeZone('Asia/Karachi'));
  $dateTime->setTimezone(new DateTimeZone('UTC'));
  return $dateTime->format('Y-m-d H:i:s');
}

// Gives month number 
function getMonth($dateString)
{
  $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);
  if ($date === false) {
    return "Invalid date format";
  }
  // Assuming $date is a DateTime object
  $monthNumber = $date->format('n'); // Single-digit month number (1-12)
  return $monthNumber;

}
// For getting only month and year
function getMonthAndYear($dateString){
  $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);
  if ($date === false) {
    return "Invalid date format";
  }
  // Assuming $date is a DateTime object
  $monthNumber = $date->format('F Y'); // Single-digit month number (1-12)
  return $monthNumber;
}
class helpers
{
    private $previousValue;

    public function __construct()
    {
        $this->previousValue = null; // Initialize the previous value
    }

    public function compareValue($currentValue)
    {
        if ($this->previousValue !== null) {
            if ($currentValue === $this->previousValue) {
                // echo "The passed value ($currentValue) is the same as the previously passed value.\n";
                return true;
            } else {
                // echo "The passed value ($currentValue) is different from the previously passed value ($this->previousValue).\n";
                $this->previousValue = $currentValue;
                return false;
            }
        } else {
            // echo "This is the first value being passed: $currentValue\n";
        }

        // Update the previous value
        $this->previousValue = $currentValue;
    }
}

// Json Prettifier

  function prettyPrintJson($jsonString) {
      // Decode the JSON string
      $decodedJson = json_decode($jsonString, true);
  
      // Check for JSON errors
      if (json_last_error() !== JSON_ERROR_NONE) {
          return 'Invalid JSON: ' . json_last_error_msg();
      }
  
      // Encode back to JSON with pretty print
      return json_encode($decodedJson, JSON_PRETTY_PRINT);
  }