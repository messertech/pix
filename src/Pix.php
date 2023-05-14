<?php

namespace Messer\Pix;

use Messer\Pix\Constants;

/**
 * Class to mask predefined or custom values
 */
class Pix
{
    public function getBase()
    {
        return Constants::PIX_KEY;
    }

    public function generate($data)
    {
        $data = json_decode(json_encode($data), false);

        $base = $this->pixDecoder($this->getBase());

        if(!empty($data->name))
        {
            $base .= $this->pixDecoder(Constants::NAME) . $data->name;
        }

        if (!empty($data->city))
        {
            $base .= $this->pixDecoder(Constants::CITY) . $data->city;
        }
        
        if (!empty($data->value))
        {
            $base .= $this->pixDecoder(Constants::VALUE) . $data->value;
        }

        if (!empty($data->key))
        {
            $base .= $this->pixDecoder(Constants::KEY) . $data->key;
        }

        $response = '';

        if (!empty($data->output))
        {
            switch ($data->output) {
                case 'string':
                    $base .= $this->pixDecoder(Constants::OUTPUT_STRING);
                    $response = $this->pixLoadString($base);
                    dd($response);
                    break;
                case 'image':
                    $base .= $this->pixDecoder(Constants::OUTPUT_IMAGE);
                    $response = $this->pixLoadImage($base);
                    dd($response);
                    break;
                
                default:
                    return 'erro!';
                    break;
            }
        }

        return $response;

    }

    public function pixLoadImage($base)
    {
        $image = file_get_contents($base);
        file_put_contents('messerpix-qrcode.jpg', $image); 
        return $image;
    }

    public function pixLoadString($base)
    {
        $ch = curl_init($base);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $returned = json_decode($response, true);
        $returned = json_decode(json_encode($returned), false);
        return $returned->brcode;
    }

    public function pixDecoder($value)
    {
        return base64_decode($value);
    }
}