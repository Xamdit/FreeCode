<?php
header('Content-Type: application/json; charset=utf-8');
error_reporting(0);
date_default_timezone_set("Asia/Bangkok");
class SCB{
    function __construct(){
        $this->accountNo = $this->config()['accountNo'];
        $this->pin = $this->config()['pin'];
        $this->deviceId = $this->config()['deviceId'];
        $this->phone = $this->config()['phone'];
        $this->UserAgent = "Android/10;FastEasy/3.66.2/6960";
        $this->version = "65";
        $this->encrypt = "https://api.xpluem.dev/pin/encrypt";
        $this->API = "https://fasteasy.scbeasy.com";
    }
    public function config(){
        $jsonString = file_get_contents('./config.json');
        $data = json_decode($jsonString, true);
        return $data;
    }
    public function Curl($method, $url, $data, $headers, $check_header = false) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_HEADER => $check_header,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $headers,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        if ($check_header) {
            $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);
            $response_headers = [];
            foreach (explode("\r\n", $header) as $i => $line) {
                if ($i === 0) {
                    $response_headers['status'] = $line;
                } else {
                    [$key, $value] = explode(': ', $line);
                    $response_headers[$key] = $value;
                }
            }
            return json_encode(array('headers'=>$response_headers,'body'=>json_decode($body)));
        } else {
            return $response;
        }
    }
    public function messageError($data){
        return json_encode(array('status'=>"error",'Developer'=>"Patiphan Srieamkul","facebook"=>"https://www.facebook.com/xpluem",'data'=>array('msg'=>$data)));
    }
    public function messageSuccess($data){
        return json_encode(array('status'=>"success",'Developer'=>"Patiphan Srieamkul","facebook"=>"https://www.facebook.com/xpluem",'data'=>$data));
    }
    public function login(){
        $header = [
            'Accept-Language:th',
            'scb-channel:app',
            'User-Agent:'.$this->UserAgent,
            'Host:fasteasy.scbeasy.com:8443',
            'Connection:Keep-Alive',
            'Accept-Encoding:gzip',
            'Content-Type:application/json; charset=UTF-8'
        ];
        $payload = json_encode(
            array(
                "tilesVersion"=>$this->tilesVersion,
                "userMode"=>"INDIVIDUAL",
                "isLoadGeneralConsent"=>0,
                "deviceId"=>$this->deviceId,
                "jailbreak"=>0
            )
        );
        $response = json_decode($this->Curl("POST",$this->API.'/v3/login/preloadandresumecheck',$payload,$header,true),true);
        if($response['body']['status']['code'] == 1000){
            $Auth = $response['headers']['Api-Auth'];
            $header = [
                'Accept-Language:th',
                'scb-channel:app',
                'User-Agent:'.$this->UserAgent,
                'Host:fasteasy.scbeasy.com:8443',
                'Connection:Keep-Alive',
                'Accept-Encoding:gzip',
                'Api-Auth:'.$Auth,
                'Content-Type:application/json; charset=UTF-8'
            ];
            $payload = json_encode(
                array(
                    "loginModuleId" => "MovingPseudo"
                )
            );
            $response1 = json_decode($this->Curl("POST",$this->API."/isprint/soap/preAuth",$payload,$header),true);
            if($response1['status']['statuscode'] == 0){
                $pseudoSid = $response1['e2ee']['pseudoSid'];
                $pseudoRandom = $response1['e2ee']['pseudoRandom'];
                $pseudoPubKey = $response1['e2ee']['pseudoPubKey'];
                $pseudoOaepHashAlgo = $response1['e2ee']['pseudoOaepHashAlgo'];
                $header = [
                    'Content-Type:application/x-www-form-urlencoded'
                ];
                $data = "Sid=".$pseudoSid."&ServerRandom=".$pseudoRandom."&pubKey=".$pseudoPubKey."&pin=".$this->pin."&hashType=".$pseudoOaepHashAlgo;
                $response2 = $this->Curl("POST", $this->encrypt,$data,$header);
                $header = [
                    'Accept-Language:th',
                    'scb-channel:app',
                    'Api-Auth:'.$Auth,
                    'User-Agent:'.$this->UserAgent,
                    'Host:fasteasy.scbeasy.com:8443',
                    'Connection:Keep-Alive',
                    'Accept-Encoding:gzip',
                    'Content-Type:application/json;charset=UTF-8'
                ];
                $payload = json_encode(
                    array(
                        "pseudoPin"=>$response2,
                        "tilesVersion"=>$this->version,
                        "pseudoSid"=>$pseudoSid,
                        "deviceId"=>$this->deviceId
                    )
                );
                $response3 = json_decode($this->Curl("POST", $this->API.'/v1/fasteasy-login',$payload,$header,true),true);
                $Auth = $response3['headers']['Api-Auth'];
                $jsonData = file_get_contents('config.json');
                $obj = json_decode($jsonData);
                $obj->token = $Auth;
                $jsonData = json_encode($obj);
                file_put_contents('config.json', $jsonData);
            }else{
                return $this->messageError("เกิดข้อผิดพลาด");
            }
        }else{
            return $this->messageError("เกิดข้อผิดพลาด");
        }
    }
    public function balance(){
        $config = $this->config();
        $header = [
            'Api-Auth:'.$config['tosken'],
            'Content-Type: application/json',
        ];
        $payload = json_encode(
            array(
                "depositList"=>array(
                    array(
                        "accountNo"=>$this->accountNo
                    ),
                ),
                "numberRecentTxn"=>2,
                "tilesVersion"=>$this->version
            )
        );
        $response = json_decode($this->Curl("POST",$this->API.'/v2/deposits/summary',$payload,$header),true);
        if($response['status']['code'] == 1002){
            $this->login();
            $config = $this->config();
            $header = [
                'Api-Auth:'.$config['token'],
                'Content-Type: application/json',
            ];
            $payload = json_encode(
                array(
                    "depositList"=>array(
                        array(
                            "accountNo"=>$this->accountNo
                        ),
                    ),
                    "numberRecentTxn"=>2,
                    "tilesVersion"=>$this->version
                )
            );
            $response = json_decode($this->Curl("POST",$this->API.'/v2/deposits/summary',$payload,$header),true);
        }
        if($response['status']['code'] == 1000){
            return $this->messageSuccess(
                array(
                    'msg'=>"ดึงข้อมูลสำเร็จ",
                    'accountNo'=>$response['depositList'][0]['accountNo'],
                    'balance'=>number_format($response['depositList'][0]['availableBalance'],2)
                )
            );
        }else{
            return $this->messageError($response['status']['description']); 
        }
    }
    public function genTransRef($data){
        return md5($data);
    }
    public function transactions(){
        $config = $this->config();
        for($i = 0; $i <= 1; $i++){
            if($i == 0){
                $date_now = date("Y-m-d");
            }else{
                $date_now = $oneDayLater = date("Y-m-d", strtotime("-1 day", strtotime(date("Y-m-d"))));
            }
            $startDate = $date_now;
            $endDate = $date_now;
            $header = [
                'Accept-Language:th',
                'scb-channel:app',
                'Api-Auth:'.$config['token'],
                'User-Agent:'.$this->UserAgent,
                'Host:fasteasy.scbeasy.com:8443',
                'Connection:Keep-Alive',
                'Accept-Encoding:gzip',
                'Content-Type:application/json;charset=UTF-8'
            ];
            $payload = json_encode(
                array(
                    "accountNo"=>$this->accountNo,
                    "endDate"=>$endDate,
                    "pageNumber"=>"1",
                    "pageSize"=>"20",
                    "productType"=>"2",
                    "startDate"=>$startDate
                )
            );
            $response = json_decode($this->Curl("POST",$this->API.'/v2/deposits/casa/transactions',$payload,$header),true);
            if($response['status']['code'] == 1002){
                $this->login();
                $config = $this->config();
                $header = [
                    'Accept-Language:th',
                    'scb-channel:app',
                    'Api-Auth:'.$config['token'],
                    'User-Agent:'.$this->UserAgent,
                    'Host:fasteasy.scbeasy.com:8443',
                    'Connection:Keep-Alive',
                    'Accept-Encoding:gzip',
                    'Content-Type:application/json;charset=UTF-8'
                ];
                $payload = json_encode(
                    array(
                        "accountNo"=>$this->accountNo,
                        "endDate"=>$endDate,
                        "pageNumber"=>"1",
                        "pageSize"=>"20",
                        "productType"=>"2",
                        "startDate"=>$startDate
                    )
                );
                $response = json_decode($this->Curl("POST",$this->API.'/v2/deposits/casa/transactions',$payload,$header),true);
            }
            if($response['status']['code'] == 1000){
                $data[] = $response['data']['txnList'];
            }elseif($response['status']['code'] == 1011){
                continue;
            }else{
                return $this->messageError($response['status']['description']); 
            }
        }
        $count = count($data);
        for($i = 0; $i < $count; $i++){
            $count1 = count($data[$i]);
            for($x = 0; $x < $count1; $x++){
                $txnCode = $data[$i][$x]['txnCode']['code'];
                if($txnCode == "X1"){
                    $txnRemark = $data[$i][$x]['txnRemark'];
                    $type = "เงินเข้า";
                    $date = date('d-m-Y H:i:s', strtotime($data[$i][$x]['txnDateTime']));
                    $amount = $data[$i][$x]['txnAmount'];
                    if(strpos($txnRemark, "Prompt-IN") !== false) {
                        $name = explode("/",$txnRemark)[1];
                        $bank = "PromptPay";
                        $number = "-";
                    }elseif(strpos($txnRemark, "PromptPay") !== false) {
                        $name = explode(" ",$txnRemark)[2]." ".explode(" ",$txnRemark)[3]." ".explode(" ",$txnRemark)[4];
                        $bank = "PromptPay";
                        $number = explode(" ",$txnRemark)[1];
                    }elseif(strpos($txnRemark, "SCB") !== false) {
                        $name = explode(" ",$txnRemark)[3]." ".explode(" ",$txnRemark)[4]." ".explode(" ",$txnRemark)[5];
                        $bank = "SCB";
                        $number = explode(" ",$txnRemark)[2];
                    }else{
                        $name = $txnRemark;
                        try{
                            $bank = explode(")",explode("(",$txnRemark)[1])[0];
                            $number = explode("/",$txnRemark)[1];
                        } catch (Exception $e) {
                            $bank = "SCB";
                            $number = explode(" ",$txnRemark)[0];
                        }
                    }
                }elseif($txnCode == "X2"){
                    $txnRemark = $data[$i][$x]['txnRemark'];
                    $type = "เงินออก";
                    $name = explode(' ',$txnRemark)[4]." ".explode(' ',$txnRemark)[5];
                    $bank = explode(' ',$txnRemark)[1];
                    $number = explode(' ',$txnRemark)[2];
                    $amount = $data[$i][$x]['txnAmount'];
                    $date = date('d-m-Y H:i:s', strtotime($data[$i][$x]['txnDateTime']));
                }
                $output[] = array(
                    'type'=>$type,
                    'transRef'=>$this->genTransRef($number.number_format($amount,2)),
                    'name'=>$name,
                    'bank'=>$bank,
                    'number'=>$number,
                    'amount'=>number_format($amount,2),
                    'date'=>$date
                );
            }
        }
        return $this->messageSuccess(
            array(
                'msg'=>"ดึงข้อมูลสำเร็จ",
                "transactions"=>$output
            )
        );
    }
    public function scan($code){
        $config = $this->config();
        $header = [
            'Accept-Language:th',
            'scb-channel:app',
            'Api-Auth:'.$config['token'],
            'User-Agent:'.$this->UserAgent,
            'Host:fasteasy.scbeasy.com:8443',
            'Connection:Keep-Alive',
            'Accept-Encoding:gzip',
            'Content-Type:application/json;charset=UTF-8'
        ];
        $payload = json_encode(
            array(
                "tilesVersion"=>$this->version,
                "barcode"=>$code,
            )
        );
        $response = json_decode($this->Curl("POST",$this->API.'/v7/payments/bill/scan',$payload,$header),true);
        if($response['status']['code'] == 1002){
            $config = $this->config();
            $header = [
                'Accept-Language:th',
                'scb-channel:app',
                'Api-Auth:'.$config['token'],
                'User-Agent:'.$this->UserAgent,
                'Host:fasteasy.scbeasy.com:8443',
                'Connection:Keep-Alive',
                'Accept-Encoding:gzip',
                'Content-Type:application/json;charset=UTF-8'
            ];
            $payload = json_encode(
                array(
                    "tilesVersion"=>$this->version,
                    "barcode"=>$code,
                )
            );
            $response = json_decode($this->Curl("POST",$this->API.'/v7/payments/bill/scan',$payload,$header),true);
        }
        if($response['status']['code'] == 1000){
            $data = array(
                'msg'=>"ดึงข้อมูลสำเร็จ",
                'transRef'=>$response['data']['pullSlip']['transRef'],
                'date'=>date('d-m-Y H:i:s', strtotime($response['data']['pullSlip']['dateTime'])),
                'amount'=>number_format($response['data']['amount'],2),
                'sender'=>array(
                    'bank'=>$this->code($response['data']['pullSlip']['sender']['bankLogo']),
                    'name'=>$response['data']['pullSlip']['sender']['name'],
                    'number'=>$response['data']['pullSlip']['sender']['accountNumber'],
                ),
                'receiver'=>array(
                    'bank'=>$this->code($response['data']['pullSlip']['receiver']['bankLogo']),
                    'name'=>$response['data']['pullSlip']['receiver']['name'],
                    'number'=>$response['data']['pullSlip']['receiver']['proxyType'],
                )
            );
            return $this->messageSuccess($data);
        }else{
            return $this->messageError($response['status']['description']); 
        }
    }
    public function verification($number, $bankCode, $status = false, $amount1 = 1){
        $amount = str_replace(',','',$amount1);
        $checkCode = $this->checkCode($bankCode);
        if($checkCode == "ไม่พบธนาคาร"){
            return $this->messageError("ไม่พบธนาคาร"); 
        }else{
            $transferType = "ORFT";
            if ($bankCode == "014") {
                $transferType = "3RD";
            }
            $config = $this->config();
            $header = [
                'Accept-Language:th',
                'scb-channel:app',
                'Api-Auth:'.$config['token'],
                'User-Agent:'.$this->UserAgent,
                'Host:fasteasy.scbeasy.com:8443',
                'Connection:Keep-Alive',
                'Accept-Encoding:gzip',
                'Content-Type:application/json;charset=UTF-8'
            ];
            $payload = json_encode(
                array(
                    "accountFrom"=>$this->accountNo,
                    "accountFromType"=>"2",
                    "accountTo"=>$number,
                    "accountToBankCode"=>$bankCode,
                    "amount"=>$amount,
                    "annotation"=>null,
                    "transferType"=>$transferType
                )
            );
            $response = json_decode($this->Curl("POST",$this->API.'/v2/transfer/verification',$payload,$header),true);
            if($response['status']['code'] == 1002){
                $this->login();
                $config = $this->config();
                $header = [
                    'Accept-Language:th',
                    'scb-channel:app',
                    'Api-Auth:'.$config['token'],
                    'User-Agent:'.$this->UserAgent,
                    'Host:fasteasy.scbeasy.com:8443',
                    'Connection:Keep-Alive',
                    'Accept-Encoding:gzip',
                    'Content-Type:application/json;charset=UTF-8'
                ];
                $payload = json_encode(
                    array(
                        "accountFrom"=>$this->accountNo,
                        "accountFromType"=>"2",
                        "accountTo"=>$number,
                        "accountToBankCode"=>$bankCode,
                        "amount"=>$amount,
                        "annotation"=>null,
                        "transferType"=>$transferType
                    )
                );
                $response = json_decode($this->Curl("POST",$this->API.'/v2/transfer/verification',$payload,$header),true);
            }
            if($response['status']['code'] == 1000){
                $data = array(
                    'account'=>$response['data']['accountTo'],
                    'name'=>$response['data']['accountToName'],
                    'bank'=>$checkCode
                );
                if($status){
                    $data['amount'] = $amount;
                    $data['payload'] = array(
                        "accountFrom"=>$response['data']['accountTo'],
                        "accountFromName"=>$response['data']['accountFromName'],
                        "accountFromType"=>"2",
                        "accountTo"=>$response['data']['accountTo'],
                        "accountToBankCode"=>$response['data']['accountToBankCode'],
                        "accountToName"=>$response['data']['accountToName'],
                        "amount"=>$response['data']['amount'],
                        "botFee"=>0.0,
                        "channelFee"=>0.0,
                        "fee"=>0.0,
                        "feeType"=>"",
                        "pccTraceNo"=>$response['data']['pccTraceNo'],
                        "sequence"=>$response['data']['sequence'],
                        "terminalNo"=>$response['data']['terminalNo'],
                        "transactionToken"=>$response['data']['transactionToken'],
                        "transferType"=>$response['data']['transferType']
                    );
                }
                return $this->messageSuccess($data);
            }else{
                return $this->messageError($response['status']['description']); 
            }
        }
    }
    public function tranfers($number, $bankCode, $amount){
        $verification = json_decode($this->verification($number,$bankCode,true,$amount),true);
        $checkCode = $this->checkCode($bankCode);
        if(!$verification['data']['account']){
            return json_encode($verification);
        }elseif($checkCode == "ไม่พบธนาคาร"){
            return $this->messageError($checkCode); 
        }else{
            $config = $this->config();
            $header = [
                'Accept-Language:th',
                'scb-channel:app',
                'Api-Auth:'.$config['token'],
                'User-Agent:'.$this->UserAgent,
                'Host:fasteasy.scbeasy.com:8443',
                'Connection:Keep-Alive',
                'Accept-Encoding:gzip',
                'Content-Type:application/json;charset=UTF-8'
            ];
            $payload = json_encode($verification['data']['payload']);
            $response = json_decode($this->Curl("POST",$this->API.'/v3/transfer/confirmation',$payload,$header),true);
            if($response['status']['code'] == 1000){
                return $this->messageSuccess(
                    array(
                        'msg'=>"โอนเงินสำเร็จ",
                        'accountNo'=>$verification['data']['payload']['accountTo'],
                        'name'=>$verification['data']['payload']['accountToName'],
                        'amount'=>number_format($verification['data']['amount'],2),
                        'balance'=>number_format($response['data']['remainingBalance'],2),
                        'transactionId'=>$response['data']['transactionId'],
                        'date'=>date('d-m-Y H:i:s', strtotime($response['data']['transactionDateTime']))
                    )
                );
            }else{
                return $this->messageError($response['status']['description']); 
            }
        }
    }
    public function cleargroup(){
        $config = $this->config();
        $header = [
            'Api-Auth: '.$config['token'],
            'User-Agent: '.$this->UserAgent,
            'Accept-Language: th',
            'Content-Type: application/json'
        ];
        $group = json_decode($this->Curl("GET",$this->API.'/v1/bulktransferprofiles/group',[],$header),true);
        if($group["status"]["code"] == 1002){
            $this->login();
            $config = $this->config();
            $header = [
                'Api-Auth: '.$config['token'],
                'User-Agent: '.$this->UserAgent,
                'Accept-Language: th',
                'Content-Type: application/json'
            ];
            $group = json_decode($this->Curl("GET",$this->API.'/v1/bulktransferprofiles/group',[],$header),true);
        }
        if($group["status"]["code"] == 1000){
            $output = [];
            foreach($group["data"]["groupList"] as $grouplist){
                if($grouplist["groupName"] == "kom"){
                    $payload = json_encode(
                        array(
                            "groupId"=>$grouplist["groupId"]
                        )
                    );
                    $deletegrouplist = $this->Curl("DELETE",$this->API.':8443/v1/bulktransferprofiles/group',$payload,$header);
                    $output[] = $deletegrouplist;
                }
            }
        }
        return json_encode($output);
    }
    public function addgroup($groupName){
        $config = $this->config();
        $header = [
            'Api-Auth: '.$config['token'],
            'User-Agent: '.$this->UserAgent,
            'Accept-Language: th',
            'Content-Type: application/json'
        ];
        $payload = json_encode(
            array(
                "groupName"=>$groupName
            )
        );
        $addgroup =  json_decode($this->Curl("POST",$this->API.':8443/v1/bulktransferprofiles/group',$payload,$header),true);
        if($addgroup["status"]["code"] == 1002){
            $this->login();
            $config = $this->config();
            $header = [
                'Api-Auth: '.$config['token'],
                'User-Agent: '.$this->UserAgent,
                'Accept-Language: th',
                'Content-Type: application/json'
            ];
            $payload = json_encode(
                array(
                    "groupName"=>$groupName
                )
            );
            $addgroup = json_decode($this->Curl("POST",$this->API.':8443/v1/bulktransferprofiles/group',$payload,$header),true);
        }
        return $addgroup;
    }
    public function addrecipient($groupId, $ToBankCode, $ToBank, $amount){
        $bankCode = $ToBankCode === "022" ? 'CIMBT' : $ToBankCode;
        $transferType = $ToBankCode === '014' ? 'SCB' : 'OTHER';
        $config = $this->config();
        $header = [
            'Api-Auth: '.$config['token'],
            'User-Agent: '.$this->UserAgent,
            'Accept-Language: th',
            'Content-Type: application/json'
        ];
        $payload = json_encode(
            array(
                "groupId" => $groupId,
                "recipientList" => array(
                    array(
                        "bankCode" => $bankCode,
                        "subFunction" => $transferType,
                        "accountTo" => $ToBank,
                        "nickname" => "s01",
                        "amount" => $amount
                    )
                )
            )
        );  
        $addrecipient = json_decode($this->Curl("POST",$this->API.':8443/v1/bulktransferprofiles/group/recipient',$payload,$header),true);
        if($addrecipient["status"]["code"] == 1002){
            $this->login();
            $config = $this->config();
            $header = [
                'Api-Auth: '.$config['token'],
                'User-Agent: '.$this->UserAgent,
                'Accept-Language: th',
                'Content-Type: application/json'
            ];
            $payload = json_encode(
                array(
                    "groupId" => $groupId,
                    "recipientList" => array(
                        array(
                            "bankCode" => $bankCode,
                            "subFunction" => $transferType,
                            "accountTo" => $ToBank,
                            "nickname" => "s01",
                            "amount" => $amount
                        )
                    )
                )
            );        
            $addrecipient = json_decode($this->Curl("POST",$this->API.':8443/v1/bulktransferprofiles/group/recipient',$payload,$header),true);
        }
        return $addrecipient;
    }
    public function getrecipient($groupId){
        $config = $this->config();
        $header = [
            'Api-Auth: '.$config['token'],
            'User-Agent: '.$this->UserAgent,
            'Accept-Language: th',
            'Content-Type: application/json'
        ];
        $getrecipient = json_decode($this->Curl("GET",$this->API.':8443/v1/bulktransferprofiles/group/recipient?groupId='.$groupId,[],$header),true);
        if($getrecipient["status"]["code"] == 1002){
            $this->login();
            $config = $this->config();
            $header = [
                'Api-Auth: '.$config['token'],
                'User-Agent: '.$this->UserAgent,
                'Accept-Language: th',
                'Content-Type: application/json'
            ];
            $getrecipient = json_decode($this->Curl("GET",$this->API.':8443/v1/bulktransferprofiles/group/recipient?groupId='.$groupId,[],$header),true);
        }
        return $getrecipient;
    }
    public function verification1($groupId, $recipientId, $amount){
        $config = $this->config();
        $header = [
            'Api-Auth: '.$config['token'],
            'User-Agent: '.$this->UserAgent,
            'Accept-Language: th',
            'Content-Type: application/json'
        ];
        $payload = json_encode(
            array(
                "ownList" => array(),
                "otherList" => array(
                    array(
                        "amount" => $amount,
                        "recipientId" => $recipientId
                    )
                ),
                "accountFrom" => $this->accountNo,
                "scbList" => array(),
                "groupId" => $groupId
            )
        );           
        $verification1 = json_decode($this->Curl("POST",$this->API.':8443/v1/transfer/bulk/verification',$payload,$header),true);
        if($verification1["status"]["code"] == 1002){
            $this->login();
            $config = $this->config();
            $header = [
                'Api-Auth: '.$config['token'],
                'User-Agent: '.$this->UserAgent,
                'Accept-Language: th',
                'Content-Type: application/json'
            ];
            $payload = json_encode(
                array(
                    "ownList" => array(),
                    "otherList" => array(
                        array(
                            "amount" => $amount,
                            "recipientId" => $recipientId
                        )
                    ),
                    "accountFrom" => $this->accountNo,
                    "scbList" => array(),
                    "groupId" => $groupId
                )
            );           
            $verification1 = json_decode($this->Curl("POST",$this->API.':8443/v1/transfer/bulk/verification',$payload,$header),true);
        }
        return $verification1;
    }
    public function confirmation($transactionToken){
        $config = $this->config();
        $header = [
            'Api-Auth: '.$config['token'],
            'User-Agent: '.$this->UserAgent,
            'Accept-Language: th',
            'Content-Type: application/json'
        ];
        $payload = json_encode(
            array(
                "transactionToken" => $transactionToken,
            )
        );           
        $confirmation = json_decode($this->Curl("POST",$this->API.':8443/v1/transfer/bulk/confirmation',$payload,$header),true);
        if($confirmation["status"]["code"] == 1002){
            $this->login();
            $config = $this->config();
            $config = $this->config();
            $header = [
                'Api-Auth: '.$config['token'],
                'User-Agent: '.$this->UserAgent,
                'Accept-Language: th',
                'Content-Type: application/json'
            ];
            $payload = json_encode(
                array(
                    "transactionToken" => $transactionToken,
                )
            );           
            $confirmation = json_decode($this->Curl("POST",$this->API.':8443/v1/transfer/bulk/confirmation',$payload,$header),true);
        }
        return $confirmation;
    }
    public function bulktransferprofiles($ToBankCode, $ToBank, $amount){
        $cleargroup = $this->cleargroup();
        $addgroup = $this->addgroup("kom");
        if($addgroup["status"]["code"] != 1000){
            return json_encode($addgroup); 
        }
        $groupId = $addgroup["data"]["groupId"];
        $addrecipient = $this->addrecipient($groupId, $ToBankCode, $ToBank, $amount);
        if($addrecipient["status"]["code"] != 1000){
            return json_encode($addrecipient); 
        }
        $getrecipient = $this->getrecipient($groupId);
        if($getrecipient["status"]["code"] != 1000){
            return json_encode($getrecipient); 
        }
        $recipientId = $getrecipient["data"]["recipientList"]["otherList"][0]["recipientId"];
        $verification1 = $this->verification1($groupId, $recipientId, $amount);
        if($verification1["status"]["code"] != 1000){
            return json_encode($verification1); 
        }
        return json_encode($verification1);
        $transactionToken = $verification1["data"]["transactionToken"];
        $confirmation = $this->confirmation($transactionToken);
        $cleargroup = $this->cleargroup();
        return json_encode($confirmation);
    }
    public function checkCode($code){
        if($code == "014") {
            $bank = "ธนาคารไทยพาณิชย์";
        }elseif($code == "034") {
            $bank = "ธนาคารเพื่อการเกษตรแล";
        }elseif($code == "025") {
            $bank = "ธนาคารกรุงศรีอยุธยา";
        }elseif($code == "002") {
            $bank = "ธนาคารกรุงเทพ";
        }elseif($code == "022") {
            $bank = "ธนาคารซีไอเอ็มบี";
        }elseif($code == "017") {
            $bank = "ธนาคารซิตี้แบงก์";
        }elseif($code == "032") {
            $bank = "ธนาคารดอยช์แบงก์";
        }elseif($code == "033") {
            $bank = "ธนาคารอาคารสงเคราะห์";
        }elseif($code == "030") {
            $bank = "ธนาคารออมสิน";
        }elseif($code == "031") {
            $bank = "ธนาคารฮ่องกงและเซี่ยงไฮ้";
        }elseif($code == "070") {
            $bank = "ธนาคารไอซีบีซี";
        }elseif($code == "066") {
            $bank = "ธนาคารอิสลามแห่งประเทศไทย";
        }elseif($code == "004") {
            $bank = "ธนาคารกสิกรไทย";
        }elseif($code == "069") {
            $bank = "ธนาคารเกียรตินาคิน";
        }elseif($code == "TR" || $code == "006") {
            $bank = "ธนาคารกรุงไทย";
        }elseif($code == "073") {
            $bank = "ธนาคารแลนด์ แอนด์";
        }elseif($code == "039") {
            $bank = "ธนาคารมิซูโฮ";
        }elseif($code == "020") {
            $bank = "ธนาคารสแตนดาร์ดชาร์เตอร์ด";
        }elseif($code == "018") {
            $bank = "ธนาคารซูมิโตโม";
        }elseif($code == "065") {
            $bank = "ธนาคารธนชาต";
        }elseif($code == "071") {
            $bank = "ธนาคารไทยเครดิต";
        }elseif($code == "011" || $code == "011_2") {
            $bank = "ธนาคารทหารไทย";
        }elseif($code == "011") {
            $bank = "ธนาคารทหารไทย";
        }elseif($code == "067") {
            $bank = "ธนาคารทิสโก้";
        }elseif($code == "024") {
            $bank = "ธนาคารยูโอบี";
        }else{
            $bank = "ไม่พบธนาคาร";
        }
        return $bank;
    }
    public function code($value){
        $code = explode('.png',explode('/transfer/bank-logo/',$value)[1])[0];
        if($code == "014") {
            $bank = "ธนาคารไทยพาณิชย์";
        }elseif($code == "034") {
            $bank = "ธนาคารเพื่อการเกษตรแล";
        }elseif($code == "025") {
            $bank = "ธนาคารกรุงศรีอยุธยา";
        }elseif($code == "002") {
            $bank = "ธนาคารกรุงเทพ";
        }elseif($code == "022") {
            $bank = "ธนาคารซีไอเอ็มบี";
        }elseif($code == "017") {
            $bank = "ธนาคารซิตี้แบงก์";
        }elseif($code == "032") {
            $bank = "ธนาคารดอยช์แบงก์";
        }elseif($code == "033") {
            $bank = "ธนาคารอาคารสงเคราะห์";
        }elseif($code == "030") {
            $bank = "ธนาคารออมสิน";
        }elseif($code == "031") {
            $bank = "ธนาคารฮ่องกงและเซี่ยงไฮ้";
        }elseif($code == "070") {
            $bank = "ธนาคารไอซีบีซี";
        }elseif($code == "066") {
            $bank = "ธนาคารอิสลามแห่งประเทศไทย";
        }elseif($code == "004") {
            $bank = "ธนาคารกสิกรไทย";
        }elseif($code == "069") {
            $bank = "ธนาคารเกียรตินาคิน";
        }elseif($code == "TR" || $code == "006") {
            $bank = "ธนาคารกรุงไทย";
        }elseif($code == "073") {
            $bank = "ธนาคารแลนด์ แอนด์";
        }elseif($code == "039") {
            $bank = "ธนาคารมิซูโฮ";
        }elseif($code == "020") {
            $bank = "ธนาคารสแตนดาร์ดชาร์เตอร์ด";
        }elseif($code == "018") {
            $bank = "ธนาคารซูมิโตโม";
        }elseif($code == "065") {
            $bank = "ธนาคารธนชาต";
        }elseif($code == "071") {
            $bank = "ธนาคารไทยเครดิต";
        }elseif($code == "011" || $code == "011_2") {
            $bank = "ธนาคารทหารไทย";
        }elseif($code == "011") {
            $bank = "ธนาคารทหารไทย";
        }elseif($code == "067") {
            $bank = "ธนาคารทิสโก้";
        }elseif($code == "024") {
            $bank = "ธนาคารยูโอบี";
        }else{
            $bank = "ไม่พบธนาคาร";
        }
        return $bank;
    }
    public function showCode(){
        $data = array(
            array('code'=>"014", 'bank'=>"ธนาคารไทยพาณิชย์"),
            array('code'=>"034", 'bank'=>"ธนาคารเพื่อการเกษตรและสหกรณ์"),
            array('code'=>"025", 'bank'=>"ธนาคารกรุงศรีอยุธยา"),
            array('code'=>"002", 'bank'=>"ธนาคารกรุงเทพ"),
            array('code'=>"022", 'bank'=>"ธนาคารซีไอเอ็มบี"),
            array('code'=>"017", 'bank'=>"ธนาคารซิตี้แบงก์"),
            array('code'=>"032", 'bank'=>"ธนาคารดอยช์แบงก์"),
            array('code'=>"033", 'bank'=>"ธนาคารอาคารสงเคราะห์"),
            array('code'=>"030", 'bank'=>"ธนาคารออมสิน"),
            array('code'=>"031", 'bank'=>"ธนาคารฮ่องกงและเซี่ยงไฮ้"),
            array('code'=>"070", 'bank'=>"ธนาคารไอซีบีซี"),
            array('code'=>"066", 'bank'=>"ธนาคารอิสลามแห่งประเทศไทย"),
            array('code'=>"004", 'bank'=>"ธนาคารกสิกรไทย"),
            array('code'=>"069", 'bank'=>"ธนาคารเกียรตินาคิน"),
            array('code'=>"006", 'bank'=>"ธนาคารกรุงไทย"),
            array('code'=>"073", 'bank'=>"ธนาคารแลนด์ แอนด์"),
            array('code'=>"039", 'bank'=>"ธนาคารมิซูโฮ"),
            array('code'=>"020", 'bank'=>"ธนาคารสแตนดาร์ดชาร์เตอร์ด"),
            array('code'=>"018", 'bank'=>"ธนาคารซูมิโตโม"),
            array('code'=>"065", 'bank'=>"ธนาคารธนชาต"),
            array('code'=>"071", 'bank'=>"ธนาคารไทยเครดิต"),
            array('code'=>"011", 'bank'=>"ธนาคารทหารไทย"),
            array('code'=>"067", 'bank'=>"ธนาคารทิสโก้"),
            array('code'=>"024", 'bank'=>"ธนาคารยูโอบี")
        );
        return $this->messageSuccess($data);
    }
}
?>