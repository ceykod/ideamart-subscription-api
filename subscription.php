<?php


class Subscription {

    public function __construct(){
    }

    private function sendRequest($jsonObjectFields)
    {
        $ch = curl_init(SUBSCRIPTION_URL);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonObjectFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);
        return $this->handleResponse($res);
    }
    private function handleResponse($resp){
        if ($resp == "") {
            return "";
        } else {
            return $resp;
        }
    }
    public function sendQueryRequest($jsonObjectFields){
        $ch = curl_init(SUB_QUERY_URL);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonObjectFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);
        return $this->handleResponse($res);
    }

    public function sendBaseRequest($jsonObjectFields){
        $ch = curl_init(SUB_BASE_URL);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonObjectFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);
        return $this->handleResponse($res);
    }

    //**********************************************************************************************

    public function RegUser($applicationId, $password, $version, $subscriberId)
    {
        $arrayField = array(
            "applicationId" => $applicationId,
            "password" => $password,
            "version" => $version,
            "action" => 1,
            "subscriberId" => $subscriberId);

        $jsonObjectFields = json_encode($arrayField);
        return $this->sendRequest($jsonObjectFields);
    }
    public function UnregUser($applicationId, $password, $version, $subscriberId)
    {
        $arrayField = array(
            "applicationId" => $applicationId,
            "password" => $password,
            "version" => $version,
            "action" => 0,
            "subscriberId" => $subscriberId);

        $jsonObjectFields = json_encode($arrayField);
        return $this->sendRequest($jsonObjectFields);
    }

    public function getStatus($applicationId, $password, $subscriberId){
        $arrayField = array(
            "applicationId" => $applicationId,
            "password" => $password,
            "subscriberId" => $subscriberId);

        $jsonObjectFields = json_encode($arrayField);

        $resp=$this->sendQueryRequest($jsonObjectFields);
        $response = json_decode($resp, true);

        $statusDetail = $response['statusDetail'];
        $statusCode = $response['statusCode'];
        $status =$response['subscriptionStatus'];

        return $status;
    }

    public function getBaseSize($applicationId, $password){
        $arrayField = array(
            "applicationId" => $applicationId,
            "password" => $password);

        $jsonObjectFields = json_encode($arrayField);
        $resp=$this->sendBaseRequest($jsonObjectFields);
        $response = json_decode($resp, true);

        $statusDetail = $response['statusDetail'];
        $statusCode = $response['statusCode'];
        $status =$response['baseSize'];

        return $status;

    }


} 