<?php

namespace bwttest\app\models;


/**
 * Class Weather
 * @package bwttest\app\models
 */
class Weather
{
    /**
     * @param $url
     * @param string $referer
     * @return mixed
     */
    public function curl($url, $referer = 'https://www.google.com/')
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT,
            '	Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:52.0) Gecko/20100101 Firefox/52.0 ');
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_REFERER, $referer);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $html = curl_exec($ch);
        curl_close($ch);

        return $html;
    }

    /**
     * Data parsing by regular expressions
     *
     * @return mixed
     */
    public function parse()
    {
        $data = $this->curl('https://www.gismeteo.ua/weather-zaporizhia-5093/');

        preg_match('#(?<=<div class="temp">).*(?<=<dd class=\'value m_temp c\'>).*?(?=<span class="meas">)#si', $data, $temp);

        preg_match('#(?<=<dd class=\'value m_press torr\'>).*?(?=<span class="unit">)#si', $data, $pres);

        preg_match('#(?<=<dd class=\'value m_wind ms\' style=\'display:inline\'>).*?(?=<span class="unit">)#si', $data, $wind);

        preg_match('#(?<=title="Влажность">).*?(?=<span class="unit">)#si', $data, $hud);

        $weather['temp'] = strip_tags(trim($temp[0]));

        $weather['pres'] = strip_tags(trim($pres[0]));

        $weather['wind'] = strip_tags(trim($wind[0]));

        $weather['hud'] = strip_tags(trim($hud[0]));

        return $weather;
    }

}