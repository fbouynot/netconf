config firewall policy<br>
    edit 0<br>
        set srcintf "{{ $srcintf }}"<br>
        set dstintf "{{ $dstintf }}"<br>
        set srcaddr "{{ $srcaddr }}"<br>
        set dstaddr "{{ $dstaddr }}"<br>
        set action {{ $action }}<br>
        set schedule "always"<br>
        set service {{ $services }}<br>
        set nat {{ $nat }}<br>
    next<br>
end<br>
