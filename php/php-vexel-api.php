<?php

/*
 * A curl HTTP REST wrapper for the Vexel
 */

namespace Vexel;

class API
{
    protected $base_url = 'https://vexel.is/api/';  // URL for API requests
    protected $api_version = 'v1';                  // API version
    protected $api_key = '';                        // Data can be found in the account settings
    protected $api_secret = '';                     // Data can be found in the account settings
    protected $access_token;

    public function __construct()
    {
        $params = func_get_args();
        switch (count($params)) {
            case 0:
                $this->getDefaultAccessToken();
                break;
            case 1:
                $this->access_token = $params[0];
                break;
            case 2:
                $this->api_key = $params[0];
                $this->api_secret = $params[1];
                $this->getDefaultAccessToken();
                break;
            default:
                throw new \Exception("Invalid constructor. Please refer to the documentation or technical support.");
        }
    }

    // Accounts

    public function accountGetList()
    {
        return $this->httpRequest(
            [
                'operation' => 'accountGetList'
            ]
        );
    }

    public function accountGetOne(string $currency)
    {
        return $this->httpRequest(
            [
                'operation' => 'accountGetOne',
                'currency'  => $currency
            ]
        );
    }

    public function accountCreate(string $currency)
    {
        return $this->httpRequest(
            [
                'operation' => 'accountCreate',
                'currency'  => $currency
            ]
        );
    }

    public function accountReplenish(string $account)
    {
        return $this->httpRequest(
            [
                'operation' => 'accountReplenish',
                'account'   => $account
            ]
        );
    }

    public function accountCurrencyExchange(string $from, string $to, $sum)
    {
        return $this->httpRequest(
            [
                'operation'     => 'accountCurrencyExchange',
                'currency_from' => $from,
                'currency_to'   => $to,
                'sum'           => $sum
            ]
        );
    }

    public function accountWithdraw(
        string $account,
        $sum,
        string $system,
        string $receiver,
        string $card_way = '',
        string $bank_way = '',
        string $city = '',
        string $cont = '',
        array $other_data = []
    )
    {
        return $this->httpRequest(
            [
                'operation' => 'accountWithdraw',
                'account'   => $account,
                'sum'       => $sum,
                'system'    => $system,
                'receiver'  => $receiver,
                'card_way'  => $card_way,
                'bank_way'  => $bank_way,
                'city'      => $city,
                'cont'      => $cont,
                'other_data' => $other_data
            ]
        );
    }

    // Invoices

    public function createInvoice($data)
    {
        return $this->httpRequest($data);
    }

    public function getInvoice(string $invoice, $type = 'all')
    {
        return $this->httpRequest(
            [
                'operation'     => 'getInvoice',
                'invoice'       => $invoice,
                'type'          => $type
            ]
        );
    }

    public function getListInvoices()
    {
        return $this->httpRequest(
            [
                'operation' => 'getListInvoices'
            ]
        );
    }

    public function getStatusInvoice(string $invoice)
    {
        return $this->httpRequest(
            [
                'operation'     => 'getStatusInvoice',
                'invoice'       => $invoice
            ]
        );
    }

    public function getListInvoicePayments()
    {
        return $this->httpRequest(
            [
                'operation' => 'getListInvoicePayments'
            ]
        );
    }

    public function payInvoice(string $invoice, string $way)
    {
        return $this->httpRequest(
            [
                'operation'     => 'payInvoice',
                'invoice'       => $invoice,
                'way'           => $way
            ]
        );
    }

    public function payInvoiceVexel(string $invoice, string $way, string $vexel)
    {
        return $this->httpRequest(
            [
                'operation'     => 'payInvoiceVexel',
                'invoice'       => $invoice,
                'way'           => $way,
                'vexel'         => $vexel
            ]
        );
    }

    // Vexels

    public function vexelCreate(string $currency = 'usd', int $bc = 0, $deposit = false)
    {
        return $this->httpRequest(
            [
                'operation' => 'vexelCreate',
                'currency'  => $currency,
                'bc'        => $bc,
                'deposit'   => $deposit
            ]
        );
    }

    public function vexelVerify(string $vexels)
    {
        return $this->httpRequest(
            [
                'operation' => 'vexelVerify',
                'check'     => $vexels
            ]
        );
    }

    public function vexelDivide(string $vexel, int $count, $amount)
    {
        return $this->httpRequest(
            [
                'operation' => 'vexelDivide',
                'check'     => $vexel,
                'count'     => $count,
                'amount'    => $amount
            ]
        );
    }

    public function vexelChangeCurrency(string $vexels, $currency)
    {
        return $this->httpRequest(
            [
                'operation' => 'vexelChangeCurrency',
                'check'     => $vexels,
                'currency'  => $currency
            ]
        );
    }

    public function vexelChangeRequisites(string $vexels)
    {
        return $this->httpRequest(
            [
                'operation' => 'vexelChangeRequisites',
                'check'     => $vexels
            ]
        );
    }

    public function vexelMerge(string $vexels, $vexel = 'new', int $currency)
    {
        return $this->httpRequest(
            [
                'operation' => 'vexelMerge',
                'check'     => $vexels,
                'currency'  => $currency,
                'vexel'     => $vexel,
                'all_curr'  => 1
            ]
        );
    }

    public function vexelReplenish(string $vexels, $system, $sum = 0)
    {
        return $this->httpRequest(
            [
                'operation' => 'vexelReplenish',
                'check'     => $vexels,
                'system'    => $system,
                'sum'       => $sum
            ]
        );
    }

    public function vexelCurrenciesRate(string $vexels, $currency)
    {
        return $this->httpRequest(
            [
                'operation' => 'vexelCurrenciesRate',
                'check'     => $vexels,
                'currency'  => $currency
            ]
        );
    }

    public function vexelProtect(string $vexels, int $protected, int $type, $vexel_n, $value)
    {
        return $this->httpRequest(
            [
                'operation' => 'vexelProtect',
                'check'     => $vexels,
                'protected' => $protected,
                'type'      => $type,
                'vexel_n'   => $vexel_n,
                'value'     => $value
            ]
        );
    }

    public function vexelRedeem(string $vexels, $system, $receiver, $vexel, $sum, $fee = 0, int $city = 0, $cont = '')
    {
        return $this->httpRequest(
            [
                'operation' => 'vexelRedeem',
                'check'     => $vexels,
                'fee'       => $fee,
                'system'    => $system,
                'receiver'  => $receiver,
                'vexel'     => $vexel,
                'sum'       => $sum,
                'city'      => $city,
                'cont'      => $cont
            ]
        );
    }

    public function vexelVerifyCode(string $vexels, $number, $code)
    {
        return $this->httpRequest(
            [
                'operation' => 'vexelVerifyCode',
                'check'     => $vexels,
                'number'    => $number,
                'code'      => $code
            ]
        );
    }

    public function vexelHistory(string $vexels, $number, int $limit = 100, int $offset = 0)
    {
        return $this->httpRequest(
            [
                'operation' => 'vexelHistory',
                'check'     => $vexels,
                'number'    => $number,
                'limit'     => $limit,
                'offset'    => $offset
            ]
        );
    }

    // Other

    public function createWebHook(string $url)
    {
        return $this->httpRequest(
            [
                'operation' => 'createWebHook',
                'url'       => $url
            ]
        );
    }

    public function getAllSettings()
    {
        return $this->httpRequest(
            [
                'information' => 'getAllSettings'
            ]
        );
    }

    public function getReplenishList()
    {
        return $this->httpRequest(
            [
                'information' => 'getReplenishList'
            ]
        );
    }

    public function getRedeemList()
    {
        return $this->httpRequest(
            [
                'information' => 'getRedeemList'
            ]
        );
    }

    public function getFeesList()
    {
        return $this->httpRequest(
            [
                'information' => 'getFeesList'
            ]
        );
    }

    public function getCurrenciesList()
    {
        return $this->httpRequest(
            [
                'information' => 'getCurrenciesList'
            ]
        );
    }

    public function getProtectList()
    {
        return $this->httpRequest(
            [
                'information' => 'getProtectList'
            ]
        );
    }

    public function getLanguagesList()
    {
        return $this->httpRequest(
            [
                'information' => 'getLanguagesList'
            ]
        );
    }

    public function getGAKey()
    {
        return $this->httpRequest(
            [
                'information' => 'getGAKey'
            ]
        );
    }

    public function getInfoAboutCash()
    {
        return $this->httpRequest(
            [
                'information' => 'getInfoAboutCash'
            ]
        );
    }

    public function getRates()
    {
        return $this->httpRequest(
            [
                'information' => 'getRates'
            ]
        );
    }

    public function getRate(string $from, string $to, $amount)
    {
        return $this->httpRequest(
            [
                'information' => 'getRate',
                'from' => $from,
                'to' => $to,
                'amount' => $amount,
            ]
        );
    }

    private function getDefaultAccessToken()
    {
        if (empty($this->api_key)) {
            throw new \Exception("API Key not set.");
        }

        if (empty($this->api_secret)) {
            throw new \Exception("API Secret not set.");
        }

        $pretoken = base64_encode($this->api_key.':'.$this->api_secret);
        $get_token = $this->httpRequest(['token' => $pretoken], 'auth/app', false);

        if (is_array($get_token) && array_key_exists('access_token', $get_token)) {
            $this->access_token = $get_token['access_token'];
        } else {
            throw new \Exception("Something went wrong. Unable to get token.");
        }
    }

    private function httpRequest(array $params = [], string $url = 'application-data', bool $token = true)
    {
        if (function_exists('curl_init') === false) {
            throw new \Exception("cURL is not installed.");
        }

        $uri = $this->base_url.$this->api_version.'/'.$url;
        $headers = [];
        
        $curl = curl_init($uri);

        if ($token == true) {
            if (empty($this->access_token)) {
                throw new \Exception("API Access token not set.");
            }
            $headers[] = 'Authorization: Bearer '.$this->access_token;
            $params = http_build_query($params, '', '&');
        } elseif ($url == 'auth/app') {
            if (!array_key_exists('token', $params) || empty($params['token'])) {
                throw new \Exception("Unable to request token. The data is incorrect.");
            }
            $headers[] = 'Authorization: Basic '.$params['token'];
            $params = [];
        }

        curl_setopt($curl, CURLOPT_USERAGENT, "User-Agent: Mozilla/5.0 (compatible; Vexel PHP API)");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);

        $output = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if (curl_errno($curl)) {
            throw new \Exception(curl_error($curl));
        }

        if ($status != 200) {
            $this->problemWithAnswer($status);
        }

        curl_close($curl);

        $answer = json_decode($output, true);

        return $answer;
    }

    public function problemWithAnswer($status)
    {
        switch ($status) {
            case 400:
                // Check data
                throw new \Exception("Invalid credentials");
                break;
            case 401:
                // get new token and save it
                throw new \Exception("Token expired or incorrect");
                break;
            case 403:
                // Contact Support
                throw new \Exception("App inactive");
                break;
            
            default:
                // do something
                throw new \Exception("Error. HTTP code: ".$status);
                break;
        }
    }
}