config vpn ipsec phase1-interface<br>
edit "{{ $name }}"<br>
set interface "dmz"<br>
set ike-version 2<br>
set peertype any<br>
set proposal chacha20poly1305-prfsha256<br>
set dhgrp 14<br>
@if(isset($remote_gateway))
    set remote-gw {{ $remote_gateway }}<br>
@else
    set remote-gw x.x.x.x<br>
@endif
set psksecret {{ $psk }}<br>
next<br>
end<br>