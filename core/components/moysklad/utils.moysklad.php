<?php
if (!function_exists('http-chunked-decode')) { 
/** 
* dechunk an http 'transfer-encoding: chunked' message 
*  
* @param string $chunk the encoded message 
* @return string the decoded message.  If $chunk wasn't encoded properly it will be returned unmodified. 
**/ 
   function http_chunked_decode($chunk) { 
      $currentEncoding = mb_internal_encoding();
      mb_internal_encoding('ISO-8859-1');
      $result = '';
      $parts = explode("\r\n", $chunk);
      if (count($parts) == 1) { 
         return $chunk;
      }
      $chunkLen = 0;
      $thisChunk = '';
      while (($part = array_shift($parts)) !== NULL) {
         if ($chunkLen) {
            $thisChunk .= $part. "\r\n";
            if (mb_strlen($thisChunk) == $chunkLen) {
               $result .= $thisChunk;
               $chunkLen = 0;
               $thisChunk = '';
            } else if (mb_strlen($thisChunk) == $chunkLen + 2) {
               // Chunk is complete, remove trailing CRLF
               $result .= mb_substr($thisChunk, 0, -2);
               $chunkLen = 0;
               $thisChunk = '';
            } else if (mb_strlen($thisChunk) > $chunkLen) {
               // Data is malformed
               return FALSE;
            }
         } else {
            if ($part === '') continue;
            if (!$chunkLen = hexdec($part)) break;
         }
      }
      mb_internal_encoding($currentEncoding);
      return ($chunkLen) ? FALSE : $result;
   } 
}

function XML2JSON($xml) {
   function normalizeSimpleXML($obj, &$result) {
      $data = $obj;
      if (is_object($data)) {
         $data = get_object_vars($data);
      }
      if (is_array($data)) {
         foreach ($data as $key => $value) {
            $res = null;
            normalizeSimpleXML($value, $res);
            if (($key == '@attributes') && ($key)) {
               $result = $res;
            } else {
               $result[$key] = $res;
            }
         }
      } else {
         $result = $data;
      }
   }
   normalizeSimpleXML($xml, $result);
   return json_encode($result);
} 

?>