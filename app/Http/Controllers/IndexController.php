<?php
/**
 * IndexController.php
 *
 * Netconf index controller
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

use Illuminate\Http\Request;
use Illuminate\View\View;

class IndexController extends Controller
{

    /**
     * Return the form
     *
     * @return View
     */
    public function indexPolflex(): View
    {
        return view('indexPolflex');
    }

    /**
     * Return the config template
     *
     * @param Request $request
     * @return View
     */
    public function configPolflex(Request $request): View
    {
        $validatedData = $request->validate([
                'name' => 'required|max:32|string',
                'subnet_lan' => 'required|max:18|string',
                'subnet_telemetry' => 'required|max:18|string',
                'admin_password' => 'required|min:16|max:128|string',
                'psk' => 'required|min:16|max:128|string',
                'pfx_file' => 'required|max:1024',
                'pfx_password' => 'required|min:8|max:128|string',
            ], [
                'name.required' => 'Name field is required.',
                'subnet_lan.required' => 'LAN subnet field is required.',
                'subnet_telemetry.required' => 'Telemetry subnet field is required.',
                'admin_password.required' => 'Firewall admin password field is required.',
                'psk.required' => 'Tunnel PSK field is required.',
                'pfx_file.required' => 'Certificate field is required.',
                'pfx_password.required' => 'Certificate password field is required.',
            ]);


        $validatedData['net_lan'] = IpUtils::findNetwork($validatedData['subnet_lan']);
        $validatedData['cidr_lan'] = IpUtils::findCidr($validatedData['subnet_lan']);
        $validatedData['gateway_lan'] = IpUtils::findGateway($validatedData['net_lan']);
        $validatedData['netmask_lan'] = IpUtils::findNetmask($validatedData['cidr_lan']);
        $validatedData['dhcp_start_lan'] = (string) long2ip(ip2long($validatedData['net_lan']) + 10); // todo constant
        $validatedData['dhcp_stop_lan'] = (string) long2ip(ip2long($validatedData['net_lan']) + 30); // todo variable
        $validatedData['net_telemetry'] = IpUtils::findNetwork($validatedData['subnet_telemetry']);
        $validatedData['cidr_telemetry'] = IpUtils::findCidr($validatedData['subnet_telemetry']);
        $validatedData['gateway_telemetry'] = IpUtils::findGateway($validatedData['net_telemetry']);
        $validatedData['ip_telemetry'] = IpUtils::findGateway($validatedData['gateway_telemetry']);
        $validatedData['netmask_telemetry'] = IpUtils::findNetmask($validatedData['cidr_telemetry']);





        $res = [];
        $openSSL = openssl_pkcs12_read($validatedData['pfx_file'], $res, $validatedData['pfx_password']);
var_dump($openSSL);
var_dump($res);
var_dump($validatedData['pfx_file']);
$test = $validatedData['pfx_file'];
//$test = $request->file('pfx_file');
var_dump($test);
/*      if(!$openSSL) {
//          throw new ClientException("Error: ".openssl_error_string());
var_dump($openSSL);
        }*/
        // this is the CER FILE
//      file_put_contents('CERT.cer', $res['pkey'].$res['cert'].implode('', $res['extracerts']));
/*      $validatedData['cert_pem'] = $res['pkey'].$res['cert'].implode('', $res['extracerts']);
        // this is the PEM FILE
//      $cert = $res['cert'].implode('', $res['extracerts']);
        $validatedData['cert_key'] = $res['cert'].implode('', $res['extracerts']);
//      file_put_contents('KEY.pem', $cert);
*/
        return view('configPolflex', $validatedData);
    }
}

/* ip ipv' ipv6 regex */
/**
 TODO:
- Import cert
- Format ticket
- Cut config
- Add auth
- Port old templates
*/
