<?php 

namespace Omnipay\Inoviopay\Message;

class PurchaseRequest extends AuthorizeRequest
{
    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $data                   = parent::getData();
        $data['request_action'] = 'CCAUTHCAP';

        return $data;
    }
}