<?php
namespace App\Services;

use Twitter;

class TwitterSearchService
{
    /**
     * Return lsit of tweets
     *
     * @todo Apply caching
     * @param  string  $city  The city name
     * @param  string $lat   The lattitude
     * @param  string $lon   The longitude
     * @param  string $range The
     * @return array
     */
    public function byCity(string $city, string $geo, string $range = '50km')
    {
        // search via twitter api
        // then parse the result
        $result = Twitter::getSearch([
            'q' => $city,
            'geocode' => $geo . ',' . $range,
            'count' => 10
        ]);

        // parse twitter result
        return $this->sanitizeResult($result);
    }

    /**
     * Parse twitter results
     *
     * @param  stdClass $result [description]
     * @return array
     */
    private function sanitizeResult($result)
    {
        $results = [];
        foreach ($result->statuses as $item) {
            $results[] = [
                'id' => $item->id,
                'profile_image_url_https' => $item->user->profile_image_url_https,
                'text' => $item->text,
                'created_at' => $item->created_at,
                'geo' => $item->geo,
            ];
        }

        return $results;
    }

}
