<?php 
require_once('config.moysklad.php');
//require_once('CustomerOrder.php');
require_once('utils.moysklad.php');

class MoySkladService {

    private $entitiesIsLoad = false;
    private $categories = array();
    private $sizes = array();
    private $manufacturies = array();

    private function sendRequest($url, $method, $body = '')
    {
        $sock = fsockopen(MoySkladConfig::URL, MoySkladConfig::PORT, $errno, $errstr, 30);

        if (!$sock) die("$errstr ($errno)\n");

        fputs($sock, $method . " " . $url . " HTTP/1.1\r\n");
        fputs($sock, "Host: online.moysklad.ru\r\n");
        fputs($sock, "Authorization: Basic " . base64_encode(MoySkladConfig::AUTH) . "\r\n");
        fputs($sock, "Content-Type: application/xml; charset=utf-8 \r\n");
        fputs($sock, "Accept: */*\r\n");
        fputs($sock, "Content-Length: ". mb_strlen($body) ."\r\n");
        fputs($sock, "Connection: close\r\n\r\n");
        fputs($sock, "$body" . "\r\n\r\n");

        while ($str = trim(fgets($sock, 4096)));

        $result = '';//stream_get_contents($sock);

        while (!feof($sock)) {
         $result .= fgets($sock, 4096);
        }
        fclose($sock);
        return http_chunked_decode($result);
    }

    private function getDate($timestamp)
    {
        return date("Ymd", $timestamp) . "010000";
    }

    public function addOrder($order)
    {
        $result = $this->sendRequest("/exchange/rest/ms/xml/CustomerOrder", "PUT", $order->getXML());
        $xml = new SimpleXMLElement($result);
        return $xml->uuid;
    }

    public function deleteOrder($orderId)
    {
        return $this->sendRequest("/exchange/rest/ms/xml/CustomerOrder/" . $orderId, "DELETE", '');
    }

    public function getStock()
    {
        return new SimpleXMLElement($this->sendRequest("/exchange/rest/stock/xml?storeId=" . MoySkladConfig::SKLAD_ID, "GET"));
    }

    public function getGoods()
    {
        return new SimpleXMLElement($this->sendRequest("/exchange/rest/ms/xml/Good/list", "GET"));
    }

    public function getEntities()
    {
        return new SimpleXMLElement($this->sendRequest("/exchange/rest/ms/xml/CustomEntity/list", "GET"));
    }

    public function getRetailDemand($dateTime = null)
    {
        if (!$dateTime) {
            $dateTime = time();// - (60 * 60 * 24);
        }
        return new SimpleXMLElement($this->sendRequest("/exchange/rest/ms/xml/RetailDemand/list?filter=created%3e" . $this->getDate($dateTime), "GET"));
    }

   private function loadEntities()
   {
        $result = $this->getEntities();
        foreach($result->customEntity as $entity) {
         switch($entity->attributes()->entityMetadataUuid) {
            case MoySkladConfig::SIZES_METADATA_UUID:
               $this->sizes[] = $entity;
               break;
            case MoySkladConfig::CATEGORIES_METADATA_UUID:
               $this->categories[] = $entity;
               break;
            case MoySkladConfig::MANUFACTURIES_METADATA_UUID:
               $this->manufacturies[] = $entity;
               break;
         }
        }
        $this->entitiesIsLoad = true;
   }

   public function getSizes()
   {
      if (!$this->entitiesIsLoad) {
         $this->loadEntities();
      }
      return $this->sizes;
   }

   public function getCategories()
   {
      if (!$this->entitiesIsLoad) {
         $this->loadEntities();
      }
      return $this->categories;
   }

   public function getManufacturies()
   {
      if (!$this->entitiesIsLoad) {
         $this->loadEntities();
      }
      return $this->manufacturies;
   }

   
} // MoySkladRequest
?>