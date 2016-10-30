<?php
namespace App\Services;

use Cache;
use Carbon\Carbon;
use Twitter;

class TwitterSearchService
{
    /**
     * Return lsit of tweets
     *
     * @param  string  $city  The city name
     * @param  string $lat   The lattitude
     * @param  string $lon   The longitude
     * @param  string $range The
     * @return array
     */
    public function byCity(string $city, string $geo, string $range = '50km')
    {
        // first check has cache
        if ($cache = $this->getCache($city)) {
            return $cache;
        }

        // search via twitter api
        // then parse the result
        $result = $this->sanitizeResult(Twitter::getSearch([
            'q' => $city,
            'geocode' => $geo . ',' . $range,
            'count' => 10
        ]));

        // cache the result
        $this->setCache($city, $result);

        // parse twitter result
        return $result;
    }

    /**
     * Parse twitter results
     *
     * @param  stdClass $result The twitter api result
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

    /**
     * Return cache results
     *
     * @param  string $city The city name
     * @return array|null
     */
    private function getCache(string $city)
    {
        return Cache::get($this->generateCachekey($city));
    }

    /**
     * Caching the api result
     *
     * @param string $city  The city name
     * @param mixed $value The result to cache
     * @return void
     */
    private function setCache(string $city, $value)
    {
        $expire = Carbon::now()->addSeconds(config('search.lifetime'));

        Cache::add($this->generateCachekey($city), $value, $expire);
    }

    /**
     * Return generated cache key base on the parameter
     *
     * @param  string $city The city name
     * @return string
     */
    private function generateCachekey(string $city)
    {
        return md5(strtolower($city));
    }
}
