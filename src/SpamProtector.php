<?php

namespace JohannEbert\LaravelSpamProtector;

use Exception;
use InvalidArgumentException;

class SpamProtector
{
    /**
     * Base url for the StopForumSpam api.
     */
    protected $apiUrl = 'http://api.stopforumspam.org/api';

    /**
     * Frequency of spam reports.
     */
    protected $frequency = 1;

    /**
     * Curl.
     */
    protected $curlEnabled;

    /**
     * Create a new SpamProtector Instance.
     *
     * @param int $frequency
     */
    public function __construct($frequency = null)
    {
        if (!is_null($frequency)) {
            $this->frequency = $frequency;
        }

        // Check if curl is enabled
        $this->curlEnabled = function_exists('curl_version');
    }

    /**
     * Checked the StopForumSpam API for email and return true if it is registered as a spam.
     *
     * @param $email
     * @return bool
     * @throws Exception
     */
    public function isSpamEmail($email)
    {
        return $this->isSpam('email', $email);
    }

    /**
     * Checked the StopForumSpam API for given type email|ip|username and return true if it is registered as a spam.
     *
     * @param string $type
     * @param        $value
     * @return bool
     * @throws Exception
     */
    public function isSpam($type = 'email', $value)
    {
        $fullApiUrl = $this->buildUrl($type, $value);
        $response = $this->sendRequest($fullApiUrl);

        if (!$response) {
            throw new Exception('API Check Unsuccessful on url: ' . $fullApiUrl);
        }

        $result = json_decode($response);

        // check format
        if (!isset($result->success) ||
            !isset($result->{$type}->appears) ||
            !isset($result->{$type}->frequency)
        ) {
            logger($response);
            if (is_array($response)) {
                $response = implode(', ', $response);
            }
            throw new Exception('Response has wrong format: ' . $response);
        }

        // check success
        if ($result->success == 1 && $result->{$type}->appears == 1) {
            // check frequency
            return $result->{$type}->frequency >= $this->frequency;
        }

        return false;
    }

    /**
     * Builds the URL for the spam check with given type email|ip|username and value for it,
     * return full api url.
     *
     * @param string $type
     * @param        $value
     * @return string
     */
    protected function buildUrl($type = 'email', $value)
    {
        $type = trim(strtolower($type));

        if (!in_array($type, ['ip', 'email', 'username'])) {
            throw new InvalidArgumentException('Type of ' . $type . ' is not supported by the API');
        }

        $url = $this->apiUrl . '?' . $type . '=' . urlencode($value) . '&f=json';

        return $url;
    }

    /**
     * Sends a GET request to a URL and returns the response.
     *
     * @param $url
     * @return bool|mixed|null|string
     */
    protected function sendRequest($url)
    {
        $response = null;

        if ($this->curlEnabled) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
        } else {
            $response = file_get_contents($url);
        }

        return $response;
    }

    /**
     * Checked the StopForumSpam API for IP address and return true if it is registered as a spam.
     *
     * @param $ip
     * @return bool
     * @throws Exception
     */
    public function isSpamIp($ip)
    {
        return $this->isSpam('ip', $ip);
    }

    /**
     * Checked the StopForumSpam API for username and return true if it is registered as a spam.
     *
     * @param $username
     * @return bool
     * @throws Exception
     */
    public function isSpamUsername($username)
    {
        return $this->isSpam('username', $username);
    }

    /**
     * @return int
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * @param int $frequency
     */
    public function setFrequency($frequency = 1)
    {
        $this->frequency = (int)$frequency;
    }
}
