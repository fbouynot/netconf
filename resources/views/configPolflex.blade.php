@extends('app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('ssh puxxxxxx@10.8.37.1') }}</div>
                    <div class="card-body">
                        @include('fortigate.ipsecPhase1', array(
                                'name' => $name,
                                'psk' => $psk
                                ))
                        config vpn ipsec phase1-interface<br>
                        edit "{{ $name }}"<br>
                        set interface "dmz"<br>
                        set ike-version 2<br>
                        set peertype any<br>
                        set proposal chacha20poly1305-prfsha256<br>
                        set dhgrp 14<br>
                        set remote-gw x.x.x.x<br>
                        set psksecret {{ $psk }}<br>
                        next<br>
                        end<br>
                        config vpn ipsec phase2-interface<br>
                        edit "{{ $name }}"<br>
                        set phase1name "{{ $name }}"<br>
                        set proposal chacha20poly1305<br>
                        set dhgrp 14<br>
                        set keepalive enable<br>
                        set src-subnet 10.0.0.0 255.0.0.0<br>
                        set dst-subnet {{ $net_lan }} {{ $netmask_lan }}<br>
                        next<br>
                        end<br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('ssh admin@192.168.1.99') }}</div>
                    <div class="card-body">
                        config system global<br>
                        set admin-sport 8443<br>
                        set admin-ssh-port 2222<br>
                        set admintimeout 10<br>
                        set alias "FortiGate-60F"<br>
                        set gui-certificates enable<br>
                        set hostname "{{ $name }}"<br>
                        set switch-controller enable<br>
                        set timezone 28<br>
                        set virtual-switch-vlan enable<br>
                        end<br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('ssh admin@192.168.1.99 -p 2222') }}</div>
                    <div class="card-body">
                        config system interface<br>
                        edit "internal"<br>
                        set vdom "root"<br>
                        set ip {{ $gateway_lan }} {{ $netmask_lan }}<br>
                        set allowaccess ping https ssh fgfm fabric<br>
                        set type hard-switch<br>
                        set stp enable<br>
                        set role lan<br>
                        next<br>
                        end<br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('ssh admin@') }}{{ $gateway_lan }}{{ __(' -p 2222') }}</div>
                    <div class="card-body">
                        config system admin<br>
                        edit "admin"<br>
                        set accprofile "super_admin"<br>
                        set vdom "root"<br>
                        set password {{ $admin_password }}<br>
                        next<br>
                        end<br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('ssh admin@') }}{{ $gateway_lan }}{{ __(' -p 2222') }}</div>
                    <div class="card-body">
                        config system interface<br>
                        edit "wan1"<br>
                        set vdom "root"<br>
                        set mode static<br>
                        set ip 192.168.1.2 255.255.255.0<br>
                        set allowaccess ping https ssh<br>
                        set type physical<br>
                        set role wan<br>
                        next<br>
                        edit "wan2"<br>
                        set vdom "root"<br>
                        set mode dhcp<br>
                        set allowaccess ping fgfm<br>
                        set status down<br>
                        set type physical<br>
                        set role wan<br>
                        next<br>
                        edit "dmz"<br>
                        set vdom "root"<br>
                        set ip 10.10.10.1 255.255.255.0<br>
                        set allowaccess ping https fgfm fabric<br>
                        set type physical<br>
                        set role dmz<br>
                        next<br>
                        edit "FGT-VARSOVIE-01"<br>
                        set vdom "root"<br>
                        set ip {{ $ip_telemetry }} 255.255.255.255<br>
                        set allowaccess ping fabric<br>
                        set type tunnel<br>
                        set remote-ip {{ $gateway_telemetry }} {{ $netmask_telemetry }}<br>
                        set interface "wan1"<br>
                        next<br>
                        end<br>
                        config system physical-switch<br>
                        edit "sw0"<br>
                        set age-val 0<br>
                        next<br>
                        end<br>
                        config system virtual-switch<br>
                        edit "internal"<br>
                        set physical-switch "sw0"<br>
                        config port<br>
                        edit "internal1"<br>
                        next<br>
                        edit "internal2"<br>
                        next<br>
                        edit "internal3"<br>
                        next<br>
                        edit "internal4"<br>
                        next<br>
                        edit "internal5"<br>
                        next<br>
                        end<br>
                        next<br>
                        end<br>
                        config system sso-admin<br>
                        end<br>
                        config system np6xlite<br>
                        edit "np6xlite_0"<br>
                        next<br>
                        end<br>
                        config system ha<br>
                        set override disable<br>
                        end<br>
                        config system snmp sysinfo<br>
                        set status enable<br>
                        set description "{{ $name }}"<br>
                        set contact-info "reseaubi@bouygues-immobilier.com"<br>
                        set location "POLOGNE [52.930467, 18.660876]"<br>
                        end<br>
                        config system snmp community<br>
                        edit 1<br>
                        set name "adm_byi"<br>
                        config hosts<br>
                        edit 1<br>
                        set ip 10.184.163.4 255.255.255.255<br>
                        next<br>
                        edit 2<br>
                        set ip 10.184.36.3 255.255.255.255<br>
                        next<br>
                        end<br>
                        set query-v1-status disable<br>
                        set trap-v1-status disable<br>
                        next<br>
                        end<br>
                        config system central-management<br>
                        set mode backup<br>
                        set type fortimanager<br>
                        set fmg "10.8.131.49"<br>
                        set fmg-source-ip {{ $ip_telemetry }}<br>
                        end<br>
                        config firewall internet-service-definition<br>
                        end<br>
                        config log fortianalyzer setting<br>
                        set status enable<br>
                        set server "10.8.131.49"<br>
                        set source-ip "{{ $ip_telemetry }}"<br>
                        set reliable enable<br>
                        end<br>
                        config system cluster-sync<br>
                        end<br>
                        config system email-server<br>
                        set server "notification.fortinet.net"<br>
                        set port 465<br>
                        set security smtps<br>
                        end<br>
                        config system automation-trigger<br>
                        edit "Network Down"<br>
                        set event-type event-log<br>
                        set logid 20099<br>
                        config fields<br>
                        edit 1<br>
                        set name "status"<br>
                        set value "DOWN"<br>
                        next<br>
                        end<br>
                        next<br>
                        edit "HA Failover"<br>
                        set event-type ha-failover<br>
                        next<br>
                        edit "Reboot"<br>
                        set event-type reboot<br>
                        next<br>
                        edit "FortiAnalyzer Connection Down"<br>
                        set event-type event-log<br>
                        set logid 22902<br>
                        next<br>
                        edit "License Expired Notification"<br>
                        set event-type license-near-expiry<br>
                        set license-type any<br>
                        next<br>
                        edit "Compromised Host Quarantine"<br>
                        next<br>
                        edit "Incoming Webhook Call"<br>
                        set event-type incoming-webhook<br>
                        next<br>
                        edit "Security Rating Notification"<br>
                        set event-type security-rating-summary<br>
                        next<br>
                        end<br>
                        config system automation-action<br>
                        edit "Network Down_email"<br>
                        set action-type email<br>
                        set email-subject "Network Down"<br>
                        next<br>
                        edit "HA Failover_email"<br>
                        set action-type email<br>
                        set email-subject "HA Failover"<br>
                        next<br>
                        edit "Reboot_email"<br>
                        set action-type email<br>
                        set email-subject "Reboot"<br>
                        next<br>
                        edit "FortiAnalyzer Connection Down_ios-notification"<br>
                        set action-type ios-notification<br>
                        next<br>
                        edit "License Expired Notification_ios-notification"<br>
                        set action-type ios-notification<br>
                        next<br>
                        edit "Compromised Host Quarantine_quarantine"<br>
                        set action-type quarantine<br>
                        next<br>
                        edit "Compromised Host Quarantine_quarantine-forticlient"<br>
                        set action-type quarantine-forticlient<br>
                        next<br>
                        edit "Security Rating Notification_ios-notification"<br>
                        set action-type ios-notification<br>
                        next<br>
                        end<br>
                        config system automation-stitch<br>
                        edit "Network Down"<br>
                        set status disable<br>
                        set trigger "Network Down"<br>
                        set action "Network Down_email"<br>
                        next<br>
                        edit "HA Failover"<br>
                        set status disable<br>
                        set trigger "HA Failover"<br>
                        set action "HA Failover_email"<br>
                        next<br>
                        edit "Reboot"<br>
                        set status disable<br>
                        set trigger "Reboot"<br>
                        set action "Reboot_email"<br>
                        next<br>
                        edit "FortiAnalyzer Connection Down"<br>
                        set trigger "FortiAnalyzer Connection Down"<br>
                        set action "FortiAnalyzer Connection Down_ios-notification"<br>
                        next<br>
                        edit "License Expired Notification"<br>
                        set trigger "License Expired Notification"<br>
                        set action "License Expired Notification_ios-notification"<br>
                        next<br>
                        edit "Compromised Host Quarantine"<br>
                        set status disable<br>
                        set trigger "Compromised Host Quarantine"<br>
                        set action "Compromised Host Quarantine_quarantine" "Compromised Host
                        Quarantine_quarantine-forticlient"<br>
                        next<br>
                        edit "Incoming Webhook Quarantine"<br>
                        set status disable<br>
                        set trigger "Incoming Webhook Call"<br>
                        set action "Compromised Host Quarantine_quarantine" "Compromised Host
                        Quarantine_quarantine-forticlient"<br>
                        next<br>
                        edit "Security Rating Notification"<br>
                        set trigger "Security Rating Notification"<br>
                        set action "Security Rating Notification_ios-notification"<br>
                        next<br>
                        end<br>
                        config system settings<br>
                        set gui-allow-unnamed-policy enable<br>
                        end<br>
                        config system dhcp server<br>
                        edit 1<br>
                        set default-gateway {{ $gateway_lan }}<br>
                        set netmask 255.255.255.224<br>
                        set interface "internal"<br>
                        config ip-range<br>
                        edit 1<br>
                        set start-ip {{ $dhcp_start_lan }}<br>
                        set end-ip {{ $dhcp_stop_lan }}<br>
                        next<br>
                        end<br>
                        set dns-server1 10.184.1.26<br>
                        set dns-server2 10.184.1.29<br>
                        set dns-server3 10.7.1.10<br>
                        next<br>
                        edit 2<br>
                        set ntp-service local<br>
                        set default-gateway 169.254.1.1<br>
                        set netmask 255.255.255.0<br>
                        set interface "fortilink"<br>
                        config ip-range<br>
                        edit 1<br>
                        set start-ip 169.254.1.2<br>
                        set end-ip 169.254.1.254<br>
                        next<br>
                        end<br>
                        set vci-match enable<br>
                        set vci-string "FortiSwitch" "FortiExtender"<br>
                        next<br>
                        end<br>
                        config firewall service group<br>
                        edit "Email Access"<br>
                        set member "DNS" "IMAP" "IMAPS" "POP3" "POP3S" "SMTP" "SMTPS"<br>
                        next<br>
                        edit "Web Access"<br>
                        set member "DNS" "HTTP" "HTTPS"<br>
                        next<br>
                        edit "Windows AD"<br>
                        set member "DCE-RPC" "DNS" "KERBEROS" "LDAP" "LDAP_UDP" "SAMBA" "SMB"<br>
                        next<br>
                        edit "Exchange Server"<br>
                        set member "DCE-RPC" "DNS" "HTTPS"<br>
                        next<br>
                        end<br>
                        config vpn certificate ca<br>
                        end<br>
                        config vpn certificate local<br>
                        edit "{{ $name }}"<br>
                        set password ENC
                        OXoODfJWUJA+nCJYG4fuSDyWqZIyjjKY6YDo72d/MZNrNjq0HY0o563tSUIOWBT4CvcavGd3xV39ElOBb8/iWsiH6phHUhmgBjhZztupK8WhVX4ndyI3knYmXysuyJ4uwtAfz795fSJ/uG92QMeDoJ0oY4EwZjNK3ayrWoU35Xd+nOTyqH7M9ZAeEFJ9GMkOcJldNw==<br>
                        set range global<br>
                        next<br>
                        end<br>
                        config webfilter ftgd-local-cat<br>
                        edit "custom1"<br>
                        set id 140<br>
                        next<br>
                        edit "custom2"<br>
                        set id 141<br>
                        next<br>
                        end<br>
                        config user setting<br>
                        set auth-cert "Fortinet_Factory"<br>
                        end<br>
                        config user group<br>
                        edit "SSO_Guest_Users"<br>
                        next<br>
                        edit "Guest-group"<br>
                        set member "guest"<br>
                        next<br>
                        end<br>
                        config vpn ssl settings<br>
                        set servercert "Fortinet_Factory"<br>
                        set port 443<br>
                        end<br>
                        config vpn ipsec phase1-interface<br>
                        edit "FGT-VARSOVIE-01"<br>
                        set interface "wan1"<br>
                        set ike-version 2<br>
                        set peertype any<br>
                        set net-device disable<br>
                        set proposal chacha20poly1305-prfsha256<br>
                        set dhgrp 14<br>
                        set remote-gw 83.238.100.214<br>
                        set psksecret {{ $psk }}<br>
                        next<br>
                        end<br>
                        config vpn ipsec phase2-interface<br>
                        edit "FGT-VARSOVIE-01"<br>
                        set phase1name "FGT-VARSOVIE-01"<br>
                        set proposal chacha20poly1305<br>
                        set dhgrp 14<br>
                        set keepalive enable<br>
                        set src-subnet {{ $net_lan }} {{ $netmask_lan }}<br>
                        set dst-subnet 10.0.0.0 255.0.0.0<br>
                        next<br>
                        edit "Telemetry"<br>
                        set phase1name "FGT-VARSOVIE-01"<br>
                        set proposal chacha20poly1305<br>
                        set dhgrp 14<br>
                        set keepalive enable<br>
                        set src-subnet {{ $ip_telemetry }} 255.255.255.255<br>
                        set dst-subnet {{ $gateway_telemetry }} 255.255.255.255<br>
                        next<br>
                        end<br>
                        @include('fortigate.urlfilter', array(
                                "mshrcstorageprod.blob.core.windows.net",
                                "domains.live.com",
                                "outlook.office365.com",
                                "r1.res.office365.com",
                                "r3.res.office365.com",
                                "r4.res.office365.com",
                                "smtp.office365.com",
                                "osub.microsoft.com",
                                "www.msftncsi.com",
                                "www.msftconnecttest.com",
                                "dns.msftncsi.com",
                                "edcg-ext.bouygues.com",
                                "edcg-int.bouygues.com",
                                "login.windows.net",
                                "sip.bi-polska.pl",
                                "enterpriseregistration.windows.net",
                                "*.outlook.com",
                                "*.store.core.windows.net",
                                "*.outlook.office.com",
                                "*.microsoftonline.com",
                                "*.microsoftonline-p.com",
                                "*.cloudapp.net",
                                "*.wns.windows.com",
                                "wdcpalt.microsoft.com",
                                "*.wdcpalt.microsoft.com",
                                "wd.microsoft.com",
                                "*.wd.microsoft.com",
                                "wdcp.microsoft.com",
                                "*.wdcp.microsoft.com",
                                "ussus1eastprod.blob.core.windows.net",
                                "ussus1westprod.blob.core.windows.net",
                                "usseu1northprod.blob.core.windows.net",
                                "usseu1westprod.blob.core.windows.net",
                                "ussuk1southprod.blob.core.windows.net",
                                "ussuk1westprod.blob.core.windows.net",
                                "ussas1eastprod.blob.core.windows.net",
                                "ussas1southeastprod.blob.core.windows.net",
                                "ussau1eastprod.blob.core.windows.net",
                                "ussau1southeastprod.blob.core.windows.net",
                                "www.microsoft.com/pkiops/crl",
                                "www.microsoft.com/pkiops/certs",
                                "crl.microsoft.com/pki/crl/products",
                                "www.microsoft.com/pki/certs",
                                "*.update.microsoft.com",
                                "*.officeconfig.msocdn.com",
                                "config.office.com",
                                "graph.windows.net",
                                "*.manage.microsoft.com",
                                "manage.microsoft.com",
                                "bouyguesimmobilier-my.sharepoint.com",
                                "bouyguesimmobilier.sharepoint.com"
                            ))
                        @include('fortigate.webfilter', array(
                                'name' => '"Acces-PDT-ExchangeOnline"',
                                'descr' => '"Pour corriger un probleme de déconnexion outlook"',
                                'fortigate.urlfilter' => '1'
                            ))
                        {{-- Firewall rules --}}
                        @include('fortigate.firewallRule', array(
                                'srcintf' => 'internal',
                                'dstintf' => 'wan1',
                                'srcaddr' => 'all',
                                'dstaddr' => 'all',
                                'action' => 'accept',
                                'services' => '"ALL"',
                                'fortigate.webfilter' => 'Acces-PDT-ExchangeOnline',
                                'nat' => 'enable'
                            ))
                        @include('fortigate.firewallRule', array(
                                'srcintf' => 'internal',
                                'dstintf' => 'wan1',
                                'srcaddr' => 'all',
                                'dstaddr' => 'all',
                                'action' => 'accept',
                                'services' => '"ALL"',
                                'nat' => 'enable'
                            ))
                        @include('fortigate.firewallRule', array(
                                'srcintf' => 'FGT-VARSOVIE-01',
                                'dstintf' => 'internal',
                                'srcaddr' => 'all',
                                'dstaddr' => 'all',
                                'action' => 'accept',
                                'services' => '"ALL"'
                            ))
                        @include('fortigate.firewallRule', array(
                                'srcintf' => 'internal',
                                'dstintf' => 'FGT-VARSOVIE-01',
                                'srcaddr' => 'all',
                                'dstaddr' => 'all',
                                'action' => 'accept',
                                'services' => '"ALL"'
                            ))
                        config router static<br>
                        edit 1<br>
                        set dst 10.0.0.0 255.0.0.0<br>
                        set device "FGT-VARSOVIE-01"<br>
                        next<br>
                        edit 2<br>
                        set gateway 192.168.1.1<br>
                        set device "wan1"<br>
                        next<br>
                        end<br>
                        config user tacacs+<br>
                        edit "Clearpass"<br>
                        set server "10.184.8.114"<br>
                        set secondary-server "10.184.8.115"<br>
                        set key ENC
                        d5r1FCwKbKpjtsA9gDIqtdRnAugsDZnXAaGDQY8358cMZr886oEqOJm/ty5ocs1bIQGtvv9KakTGjD226p6Wb/SvIrIxp+roho8mkWNox+ZPJZP9UN47fqJxcAdy1mmKX52ZjFD2ilFVwj1Z4+RCB1bPv5sif/74Mjqj41lB5qQb1yvEFvGTsDGKhdrtmFMxDtWr/Q==<br>
                        set secondary-key ENC
                        uyd1FvXaQA2Iz8NauMqfegLEp0jLHWZU5nKdGD/jDxpPanogLQA+iLhq2/hsMQzEfjOq/tqLdFFoOB5P2U1tuPYCrQxgEP9z6uoaICs6VBnEKOAgmd7N2uh1HcgN8hCmJsxE3XKljJlJB2SwpM+EVscHBfPdKSMhK6PhlfbGcj2hNz5XNaNHdODhSLBfq2+wNAXbaA==<br>
                        set authen-type pap<br>
                        set authorization enable<br>
                        set source-ip "{{ $ip_telemetry }}"<br>
                        next<br>
                        end<br>
                    </div>
                </div>
            </div>
        </div>
@endsection