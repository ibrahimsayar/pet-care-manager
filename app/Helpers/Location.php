<?php

namespace App\Helpers;

use Exception;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\GeoIp2Exception;
use GeoIp2\Model\Country;
use MaxMind\Db\Reader\InvalidDatabaseException;

class Location
{
    /**
     * @var string
     */
    private string $ipAddress;

    /**
     * @return Country|string
     * @throws InvalidDatabaseException
     */
    public function detectCountry(): Country|string
    {
        try {
            $reader = new Reader(storage_path('app/location/country.mmdb'));
            return $reader->country($this->ipAddress);
        } catch (GeoIp2Exception $exception) {
            return '';
        }
    }


    /**
     * @return Country|string
     * @throws InvalidDatabaseException
     */
    public function detectCity(): Country|string
    {
        try {
            $reader = new Reader(storage_path('app/location/city.mmdb'));
            return $reader->city($this->ipAddress);
        } catch (GeoIp2Exception $exception) {
            return '';
        }
    }


    /**
     * @param  string  $ipAddress
     * @return string
     * @throws InvalidDatabaseException
     */
    public function isoCode(string $ipAddress): string
    {
        $this->ipAddress = $ipAddress;

        $record = self::detectCountry();
        return $record->country->isoCode ?? '';
    }


    /**
     * @param  string  $ipAddress
     * @return string
     * @throws InvalidDatabaseException
     */
    public function countryName(string $ipAddress): string
    {
        $this->ipAddress = $ipAddress;

        $record = self::detectCountry();
        return $record->country->name ?? '';
    }
}
