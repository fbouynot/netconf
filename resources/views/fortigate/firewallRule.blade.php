config firewall policy<br>
    edit 0<br>
        set srcintf "{{ $srcintf }}"<br>
        set dstintf "{{ $dstintf }}"<br>
        set srcaddr "{{ $srcaddr }}"<br>
        set dstaddr "{{ $dstaddr }}"<br>
        set action {{ $action }}<br>
        set schedule "always"<br>
        set service {{ $services }}<br>
        {{-- If there is a specified webfilter profile --}}
        @isset($webfilter)
            set utm-status enable<br>
            set fsso disable<br>
            set webfilter-profile " {{ $webfilter }}"<br>
            set ssl-ssh-profile "certificate-inspection"<br>
        @endisset
        {{-- If nat is enabled --}}
        @isset($nat)
            set nat {{ $nat }}<br>
        @endisset
    next<br>
end<br>
