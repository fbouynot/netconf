<?php

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


        /* Find net and CIDR based on subnet */
        $tmp_subnet = (array) explode('/', $validatedData['subnet_lan']);
        $validatedData['net_lan'] = (string) $tmp_subnet[0];
        $validatedData['cidr_lan'] = (int) $tmp_subnet[1];
        unset($tmp_subnet);
        /* Find Gateway based on net */
        $validatedData['gateway_lan'] = (string) long2ip(ip2long($validatedData['net_lan']) + 1);
        $validatedData['dhcp_start_lan'] = (string) long2ip(ip2long($validatedData['net_lan']) + 10);
        $validatedData['dhcp_stop_lan'] = (string) long2ip(ip2long($validatedData['net_lan']) + 30);
        /* Find Netmask from CIDR */
        $validatedData['netmask_lan'] = (string) long2ip(-1 << (32 - (int)$validatedData['cidr_lan']));

        /* Find net and CIDR based on subnet */
        $tmp_subnet = (array) explode('/', $validatedData['subnet_telemetry']);
        $validatedData['net_telemetry'] = (string) $tmp_subnet[0];
        $validatedData['cidr_telemetry'] = (int) $tmp_subnet[1];
        unset($tmp_subnet);
        /* Find Gateway based on net */
        $validatedData['gateway_telemetry'] = (string) long2ip(ip2long($validatedData['net_telemetry']) + 1);
        $validatedData['ip_telemetry'] = (string) long2ip(ip2long($validatedData['net_telemetry']) + 2);
        /* Find Netmask from CIDR */
        $validatedData['netmask_telemetry'] = (string) long2ip(-1 << (32 - (int)$validatedData['cidr_telemetry']));

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
- Découper config
- Ajout auth
- Port anciens templates
*/
