<?php
/*
Copyright 2013 Samurai Factory Inc.(email : github-analyze@ml.ninja.co.jp)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class NinjaTools_API {
    const LOGIN_URL = 'https://www.ninja.co.jp/auth/client';
    const API_URL = 'https://www.ninja.co.jp/api/';
    const SERVICE = 'xapi';
    const SIG_ALGO_SHA256 = 'sha256';
    const SIG_ALGO_SHA512 = 'sha512';
    const SIG_ALGO_SHA256_HEX = 'sha256.hex';

    const ANALYSIS_SIG_KEY = 'analysis';
    const ANALYSIS_SIG_ALGO = self::SIG_ALGO_SHA256_HEX;

    private $_publicKey = null;
    private $_sigAlgo = null;
    private $_sigKey = null;

    function getPublicKey() {
        return $this->_publicKey;
    }
    function setPublicKey($publicKey) {
        $this->_publicKey = $publicKey;
    }

    function getSigKey() {
        return $this->_sigKey;
    }
    function setSigKey($key) {
        $this->_sigKey = $key;
    }

    function getSigAlgo() {
        if (empty($this->_sigAlgo)) {
            return 'sha512';
        } else {
            return $this->_sigAlgo;
        }
    }
    function setSigAlgo($algo) {
        $this->_sigAlgo = $algo;
    }

    function createSignature($params) {
        $query = http_build_query($params);
        switch ($this->getSigAlgo()) {
            case self::SIG_ALGO_SHA256_HEX:
                $retval = hash_hmac('sha256', $query, $this->getSigKey());
                break;
            case self::SIG_ALGO_SHA256:
            case self::SIG_ALGO_SHA512:
                $retval = base64_encode(
                    hash_hmac($this->getSigAlgo(), $query, $this->getSigKey(), true));
                break;
            default:
                $retval = base64_encode(
                    hash_hmac('sha512', $query, $this->getSigKey(), true));
                break;
        }
        return $retval;
    }

    function getAnalysisLists() {
        $this->setSigKey(self::ANALYSIS_SIG_KEY);
        $this->setSigAlgo(self::ANALYSIS_SIG_ALGO);

        $params = array();
        $params['publickey'] = (string)$this->getPublicKey();
        $params['method'] = 'getLists';
        $params['version'] = '1.0.0';
        $params['timestamp'] = time();
        ksort($params);
        $params['signature'] = $this->createSignature($params);
        $data = http_build_query($params, "", "&");
        $header = array(
            "Content-Type: application/x-www-form-urlencoded",
            "Content-Length: ".strlen($data)
        );
        $context = array(
            "http" => array(
                "method"  => "POST",
                "header"  => implode("\r\n", $header),
                "content" => $data
            )
        );
        $ret = @file_get_contents(self::API_URL . "analysis", false, stream_context_create($context));
        $body = json_decode($ret);
        if (isset($body->result) && !empty($body->result)) {
            return $body->result;
        } else {
            return false;
        }
    }
    
    function getAnalysisScript($tid) {
        $this->setSigKey(self::ANALYSIS_SIG_KEY);
        $this->setSigAlgo(self::ANALYSIS_SIG_ALGO);

        $params = array();
        $params['publickey'] = (string)$this->getPublicKey();
        $params['method'] = 'getScript';
        $params['version'] = '1.0.0';
        $params['timestamp'] = time();
        $params['options'] = array($tid);

        ksort($params);
        $params['signature'] = $this->createSignature($params);
        $data = http_build_query($params, "", "&");
        $header = array(
            "Content-Type: application/x-www-form-urlencoded",
            "Content-Length: ".strlen($data)
        );
        $context = array(
            "http" => array(
                "method"  => "POST",
                "header"  => implode("\r\n", $header),
                "content" => $data
            )
        );
        $ret = @file_get_contents(self::API_URL . "analysis", false, stream_context_create($context));

        $body = json_decode($ret);
        if (isset($body->result) && !empty($body->result)) {
            return $body->result;
        } else {
            return false;
        }
    }


    function clientLogin($email, $password, $service=self::SERVICE, $loginUri=self::LOGIN_URL) {
        if (!($email && $password)) {
            return false;
        }
        $post_data = array(
            "email" => $email,
            "password" => $password,
            "service" => $service
        );
        $data = http_build_query($post_data, "", "&");
        $header = array(
            "Content-Type: application/x-www-form-urlencoded",
            "Content-Length: ".strlen($data)
        );
        $context = array(
            "http" => array(
                "method"  => "POST",
                "header"  => implode("\r\n", $header),
                "content" => $data
            )
        );
        $ret = @file_get_contents($loginUri, false, stream_context_create($context));
        
        $body = json_decode($ret);
        if (isset($body->api) && !empty($body->api)) {
            $this->setPublicKey($body->api);
            return true;
        } else {
            return false;
        }
    }
}
