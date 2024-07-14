<?php
if (!function_exists('getErrorPageTitle')) {
  function getErrorPageTitle($exception) {
    switch($exception->getStatusCode()) {
      case 404:
        return "404 - Not found";
      case 500:
        return "500 - Server error";
      default:
        return $exception->getStatusCode() . " - " . $exception->getMessage();
    }
  }
}