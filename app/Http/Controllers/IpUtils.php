<?php
/**
 * IpUtils.php
 *
 * Netconf IP Address utils library
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * @package    Netconf
 * @copyright  2022 Félix Bouynot
 * @author     Félix Bouynot <felix.bouynot@setenforce.one>
 */

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