<?php

namespace App\Http\Controllers;

class IpUtils
{
    /**
     * Find CIDR based on subnet
     *
     * @param string $subnet
     * @return int
     */
    public static function findCidr(string $subnet): int
    {
        $tmp_subnet = explode('/', $subnet);

        return (int)$tmp_subnet[1];
    }

    /**
     * Find Network based on subnet
     *
     * @param string $subnet
     * @return string
     */
    public static function findNetwork(string $subnet): string
    {
        $tmp_subnet = explode('/', $subnet);

        return $tmp_subnet[0];
    }

    /**
     * Find gateway based on network
     *
     * @param string $network
     * @return string
     */
    public static function findGateway(string $network): string
    {
        return (string)long2ip(ip2long($network) + 1);
    }

    /**
     * Find Netmask based on CIDR
     *
     * @param int $cidr
     * @return string
     */
    public static function findNetmask(int $cidr): string
    {
        return (string)long2ip(-1 << (32 - $cidr));
    }
}