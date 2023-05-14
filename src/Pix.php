<?php

namespace Messer\Pix;

use Messer\Pix\Constants;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class to make Pix image and code
 */
class Pix
{
    public function getBase()
    {
        return Constants::PIX_KEY;
    }

    public function generate($data)
    {
        $errorMessage = '';
        $data = json_decode(json_encode($data), false);

        $base = $this->pixDecoder($this->getBase());

        if (!empty($data->name)) {

            $base .= $this->pixDecoder(Constants::NAME) . urlencode($data->name);

        } else {
            
            $errorMessage =  "The 'name' is required.";
            throw new HttpException(500, $errorMessage);

        }

        if (!empty($data->city)) {

            $base .= $this->pixDecoder(Constants::CITY) . urlencode($data->city);

        } else {
            
            $errorMessage =  "The 'city' is required.";
            throw new HttpException(500, $errorMessage);

        }

        if (!empty($data->key)) {

            $base .= $this->pixDecoder(Constants::KEY) . urlencode($data->key);

        } else {

            $errorMessage =  "The 'key' (chave pix) is required.";
            throw new HttpException(500, $errorMessage);

        }
        
        if (!empty($data->value))
        {
            $base .= $this->pixDecoder(Constants::VALUE) . urlencode($data->value);
        }

        if (!empty($data->description))
        {
            $base .= $this->pixDecoder(Constants::DESCRIPTION) . urlencode($data->description);
        }

        $destiny = '';

        if(!empty($data->destiny)){

            $destiny = $data->destiny . "/";
            
            if (!is_dir($destiny)) {
                $errorMessage =  "The directory '{$data->destiny}' not exists.";
                throw new HttpException(500, $errorMessage);
            }
        }

        $response = '';
        $output = 'string';

        if (!empty($data->output))
        {
            $output = $data->output;
            switch ($output) {
                case 'string':
                    $base .= $this->pixDecoder(Constants::OUTPUT_STRING);
                    $response = $this->pixLoadString($base);
                    break;
                case 'image':
                    $base .= $this->pixDecoder(Constants::OUTPUT_IMAGE);
                    $response = $this->pixLoadImage($base, $destiny);
                    break;
                
                default:
                    $errorMessage =  "The output format isn't accepted. Try 'string' or 'image'.";
                    throw new HttpException(500, $errorMessage);
                    break;
            }
        }

        return $response;

    }

    public function pixLoadImage($base, $destiny) {
        $url = html_entity_decode($base);
        $image = file_get_contents($url);
        $unixTimestamp = time();
        $filename = $destiny . $this->pixDecoder(Constants::SIGNATURE) . $unixTimestamp . $this->pixDecoder(Constants::JPG);
        file_put_contents($filename, $image);
        return $filename;
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