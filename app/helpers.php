<?php

function checkLogin(): bool
{
  if (session()->get('auth_token')) {
    return true;
  } else {
    return false;
  }
}
function encryptJournal($data, $key) {
  $key = sodium_crypto_secretbox_keygen(); // Generate key or use a key stored securely
  $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
  $encrypted = sodium_crypto_secretbox($data, $nonce, $key);
  return base64_encode($nonce . $encrypted);
}

function decryptJournal($data, $key) {
  $key = sodium_crypto_secretbox_keygen(); // Use the same key used for encryption
  $data = base64_decode($data);
  $nonce = substr($data, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
  $encrypted = substr($data, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
  return sodium_crypto_secretbox_open($encrypted, $nonce, $key);
}
