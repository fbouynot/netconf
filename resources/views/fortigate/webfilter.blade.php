config webfilter profile<br>
edit "{{ $name }}"<br>
set comment "{{ $descr }}"<br>
set inspection-mode flow-based<br>
set options block-invalid-url<br>
config web<br>
set urlfilter-table {{ $urlfilter }}<br>
end<br>
config ftgd-wf<br>
unset options<br>
config filters<br>
edit 1<br>
set category 2<br>
next<br>
edit 2<br>
set category 7<br>
next<br>
edit 3<br>
set category 8<br>
next<br>
edit 4<br>
set category 9<br>
next<br>
edit 5<br>
set category 11<br>
next<br>
edit 6<br>
set category 12<br>
next<br>
edit 7<br>
set category 13<br>
next<br>
edit 8<br>
set category 14<br>
next<br>
edit 9<br>
set category 15<br>
next<br>
edit 10<br>
set category 16<br>
next<br>
edit 11<br>
next<br>
edit 12<br>
set category 57<br>
next<br>
edit 13<br>
set category 63<br>
next<br>
edit 14<br>
set category 64<br>
next<br>
edit 15<br>
set category 65<br>
next<br>
edit 16<br>
set category 66<br>
next<br>
edit 17<br>
set category 67<br>
next<br>
edit 18<br>
set category 26<br>
set action block<br>
next<br>
edit 19<br>
set category 61<br>
set action block<br>
next<br>
edit 20<br>
set category 86<br>
set action block<br>
next<br>
edit 21<br>
set category 88<br>
set action block<br>
next<br>
edit 22<br>
set category 90<br>
set action block<br>
next<br>
edit 23<br>
set category 91<br>
set action block<br>
next<br>
end<br>
end<br>
next<br>
end<br>