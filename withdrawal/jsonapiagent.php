﻿<?php
class JsonApiAgent implements IApiService
{
    private $root_url = "https://api2.libertyreserve.com/json/";
    public $auth;
    
    function __construct(Authentication $a)
    {
        $this->auth = $a;    
    }
   
    private static function generateId()
    {
        return time() . rand(0, 9999);
    }

    private function buildAuthenticationTag($auth, $extras = '')  
    {             
        $id = $this->generateId();                                                
        return "Id=".$id."&Account=".$this->auth->accountId."&Api=".$this->auth->apiName."&Token=".$this->auth->createAuthToken($id, $extras);
    }

    public function accountName($accountToRetrieve)
    {
        $request = $this->buildAuthenticationTag($auth) . "&search=$accountToRetrieve";
                                                           
        $url = $this->root_url."accountname";
        $responce = $this->getResponse($request, $url);
        
        $account = $this->parseAccountNameResponse($responce);
        
        return $account->Accounts[0]->Name;
    }
    
    public function balance($currency)
    {
        $request = $this->buildAuthenticationTag($auth);
        
        
        $url = $this->root_url."balance";
        $response = $this->getResponse($request, $url);
        $balance = $this->parseBalanceResponse($response);
        
        return $balance->$currency;
    }
    
    public function history($dateFrom, $dateTo, $currency="", $direction="", $source="", $anonymous="", $reference="", $relatedAccount="", $amountFrom="", $amountTo="")
    {
        $extras[0] = $dateFrom;
        $extras[1] = $dateTo;                        
                   
        $url = $this->root_url."history";
        
        $requestParams = "&From=$dateFrom&Till=$dateTo&Currency=$currency&Direction=$direction&RelatedAccount=$relatedAccount&Reference=$reference&Source=$source&Private=$anonymous&AmountFrom=$amountFrom&AmountTo=$amountTo";
        
        $pageNumber = 0;
        $history = array();
        while(true)
        {
            $request = $this->buildAuthenticationTag($auth, $extras) . "$requestParams&Page=".($pageNumber);               
            $response = $this->getResponse($request, $url);
          
            $history = array_merge($history, ($this->parseHistoryResponse($response)));
            if(!$this->hasMorePages($response))
              return $history;       
            $pageNumber++;
        };
        
    }
    
    public function findTransaction($receiptId)
    {
        $extras[0] = $receiptId;
        $request = $this->buildAuthenticationTag($auth, $extras) . "&Batch=$receiptId";
        
        $url = $this->root_url."findtransaction";
        $response = $this->getResponse($request, $url);
        
        $findTransfer = $this->parseHistoryResponse($response);
        return $findTransfer[0];
    }
    
    public function transfer($payee, $currency, $amount, $private, $purpose, $reference="", $memo="")
    {
        $extras[0] = $reference;
        $extras[1] = $payee;
        $extras[2] = strtolower($currency);
        $extras[3] = $amount;
        
        $request = $this->buildAuthenticationTag($auth, $extras)."&Payee=$payee&Currency=$currency&Amount=$amount&Memo=$memo&Private=$private&Purpose=$purpose&Type=transfer&Reference=$reference";
                 
        $url = $this->root_url."transfer";
        $response = $this->getResponse($request, $url);
        
        $history = $this->parseHistoryResponse($response);   
        return $history[0];
    }
    
    private function getResponse($data, $url)
    {
        if (!function_exists('curl_init')) {
            die("Curl library not installed.");
            return "";
        }
        $agent = "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_6; en-us) AppleWebKit/525.27.1 (KHTML, like Gecko) Version/3.2.1 Safari/525.27.1";
        $handler  = curl_init();
        curl_setopt($handler, CURLOPT_URL, $url);
        curl_setopt($handler, CURLOPT_HEADER, 0);
        curl_setopt($handler, CURLOPT_POST, true);
        curl_setopt($handler, CURLOPT_POSTFIELDS, $data);
        // ignore SSL certificate
        curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($handler, CURLOPT_USERAGENT, $agent);
        //curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        ob_start();
        curl_exec($handler);
        curl_close($handler);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    private function parseAccountNameResponse($response)
    {      
      
        try {
            $response = json_decode($response);       
            $this->checkError($response);
    
            return $response;
        }
        catch (Exception $e) {
            $this->outputError($e);
        }
    }
    
    private function parseBalanceResponse($response)
    {
        try {
            $response = json_decode($response);
            $this->checkError($response);
            
            $response = $response -> Balance;        
            return $response;
        }
        catch (Exception $e) {
            $this->outputError($e);
        }
    }
    
    private function parseHistoryResponse($response)
    {
        try {
            $response = json_decode($response);
            $this->checkError($response);
            
            if($response -> Transactions)
              $response = $response -> Transactions;
            else
              $response = $response -> Transaction;
                    
            $count = count($response); 
            if(is_array($response))
            {
                $i = 0;
                $historyArray = array();
                do {       
                    $HistoryItem = new HistoryItem;
                    
                    $HistoryItem->Batch = (int)$response[$i]->Batch;
                    $HistoryItem->Date = (string)$response[$i]->Date;
                    $HistoryItem->Amount = (string)$response[$i]->Amount;
                    $HistoryItem->Fee = (string)$response[$i]->Fee;
                    $HistoryItem->Balance = (string)$response[$i]->Balance;
                    $HistoryItem->Currency = (string)$response[$i]->Currency;
                    $HistoryItem->Payer = (string)$response[$i]->Payer;
                    $HistoryItem->PayerName = (string)$response[$i]->PayerName;
                    $HistoryItem->Payee = (string)$response[$i]->Payee;
                    $HistoryItem->PayeeName = (string)$response[$i]->PayeeName;
                    $HistoryItem->Memo = (string)$response[$i]->Memo;
                    if(empty($response[$i]->Private)) $response[$i]->Private = 2;
                    $HistoryItem->Private = (int)$response[$i]->Private; 
                    $HistoryItem->Reference = (string)$response[$i]->Reference;
                    $HistoryItem->Source = (string)$response[$i]->Source;
                    array_push($historyArray, $HistoryItem);   
                } while(++$i < $count);
            }
            else
            {
                $historyArray = array();
                $HistoryItem = new HistoryItem;
                
                $HistoryItem->Batch = (int)$response->Batch;
                $HistoryItem->Date = (string)$response->Date;
                $HistoryItem->Amount = (string)$response->Amount;
                $HistoryItem->Fee = (string)$response->Fee;
                $HistoryItem->Balance = (string)$response->Balance;
                $HistoryItem->Currency = (string)$response->Currency;
                $HistoryItem->Payer = (string)$response->Payer;
                $HistoryItem->PayerName = (string)$response->PayerName;
                $HistoryItem->Payee = (string)$response->Payee;
                $HistoryItem->PayeeName = (string)$response->PayeeName;
                $HistoryItem->Memo = (string)$response->Memo;
                if(empty($response->Private)) $response->Private = 2;
                $HistoryItem->Private = (int)$response->Private;
                $HistoryItem->Reference = (string)$response->Reference;
                $HistoryItem->Source = (string)$response->Source;
                array_push($historyArray, $HistoryItem);   
                
            }  
            return $historyArray;
        }
        catch (Exception $e) {
            $this->outputError($e);
        }
    }
  
    function hasMorePages($response)
    {  
        try {
            $response = json_decode($response);
            $this->checkError($response); 

            return (bool)$response->HasMore;
        }
                
        catch (Exception $e) {
            $this->outputError($e);
        }
    }    
  
    private function checkError($response)
    {
        if ($response->Error)
            throw new Exception($response->Error->ErrorMessage, $response->Error->ErrorCode);
        return $error;
    }
    
    private function outputError($e)
    {
        echo $e->getCode();
        echo $e->getMessage();
        die;
    }         
}
?>
