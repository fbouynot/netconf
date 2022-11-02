config webfilter urlfilter<br>
edit 0<br>
set name "{{ $urlfilter }}"<br>
config entries<br>
@foreach ($fqdns as $fqdn)
    edit 0<br>
    set url "{{ $fqdn }}"<br>
    @if(Str::contains($fqdn, '*'))
        set type wildcard<br>
    @endif
    set action allow<br>
    next<br>
@endforeach
edit 0<br>
set url "*"<br>
set type wildcard<br>
set action block<br>
next<br>
end<br>
next<br>
end<br>
