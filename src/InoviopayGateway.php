<?php 

namespace Omnipay\Inoviopay;

use Omnipay\Common\AbstractGateway;

class InoviopayGateway extends AbstractGateway
{

    public function getName()
    {
        return 'Inovio pay';
    }

    const ENDPOINT = 'https://api.inoviopay.com/payment/pmt_service.cfm';
    const REQUEST_API_VERSION = '4.3';
    const SITE_ID = '0';
    const REQUEST_RESPONSE_FORMAT = 'json';

    public function getDefaultParameters()
    {
        return [
            'req_username' => 'shilpa@netizens.email',
            'req_password'   => 'DRftgyhu!@#1',
            'request_action' => 'TESTGW',
            'request_response_format' => self::REQUEST_RESPONSE_FORMAT,
            'request_api_version' => self::REQUEST_API_VERSION,
            'site_id' => self::SITE_ID,
            'endpoint' => self::ENDPOINT
        ];
    }

    public function getReqUsername()
    {
        return $this->getParameter('req_username');
    }
    
    public function setReqUsername($value)
    {
        return $this->setParameter('req_username', $value);
    }

    public function getReqPassword()
    {
        return $this->getParameter('req_password');
    }
    
    public function setReqPassword($value)
    {
        return $this->setParameter('req_password', $value);
    }

    public function getRequestAction()
    {
        return $this->getParameter('request_action');
    }
    
    public function setRequestAction($value)
    {
        return $this->setParameter('request_action', $value);
    }

    public function getMerchAcctId()
    {
        return $this->getParameter('merch_acct_id');
    }
    
    public function setMerchAcctId($value)
    {
        return $this->setParameter('merch_acct_id', $value);
    }

    public function getProductId()
    {
        return $this->getParameter('product_id');
    }
    
    public function setProductId($value)
    {
        return $this->setParameter('product_id', $value);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest(Message\PurchaseRequest::class, $parameters);
    }

    public function createToken(array $parameters = array())
    {
        return $this->createRequest(Message\TokenRequest::class, $parameters);
    }

    public function getToken()
    {

        //echo 'call';

        $data = $this->getDefaultParameters();

        $body = $data ? http_build_query($data, '', '&') : null;

        echo "<pre>";
        print_r($body);

        $httpResponse = $this->httpClient->request(
            'POST',
            self::ENDPOINT,
            array(
                'Content-Type' => 'application/x-www-form-urlencoded'
            ),
            $body
        );
        // Empty response body should be parsed also as and empty array
        // $body = (string) $httpResponse->getBody()->getContents();
        // $jsonToArrayResponse = !empty($body) ? json_decode($body, true) : array();

        echo "<pre>";
        print_r($httpResponse->getBody()->getContents());
        //return $this->response = new RestResponse($this, $jsonToArrayResponse, $httpResponse->getStatusCode());

        //$response = $this->createToken()->send();
        // if ($createIfNeeded && !$this->hasToken()) {
        //     $response = $this->createToken()->send();
        //     // if ($response->isSuccessful()) {
        //     //     $data = $response->getData();
        //     //     if (isset($data['access_token'])) {
        //     //         $this->setToken($data['access_token']);
        //     //         $this->setTokenExpires(time() + $data['expires_in']);
        //     //     }
        //     // }
        // }

        //return $this->getParameter('token');
    }
}