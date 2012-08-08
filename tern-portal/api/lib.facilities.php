<?php
$data = array();
header('Content-type: application/json');
array_push($data, array('Supersites & OzFlux <br/>Calperum Mallee', '-34.002717', '140.587683','SO|800080|CCCCCC','&#34;Calperum Mallee&#34; AND (Supersite OR OzFlux)'));
array_push($data, array('Supersites & OzFlux <br/>Cape Tribulation', '-16.103117', '145.446917','SO|800080|CCCCCC','&#34;Cape Tribulation&#34; AND (Supersite OR OzFlux)'));
array_push($data, array('Supersites & OzFlux <br/>Robson Creek', '-17.117594', '145.630203','SO|800080|CCCCCC','&#34;Robson Creek&#34; AND (Supersite OR OzFlux)'));
array_push($data, array('Supersites & OzFlux <br/>Periurban', '-27.388056', '152.877778','SO|800080|CCCCCC','Periurban AND (Supersites OR Ozflux)'));
array_push($data, array('Supersites & OzFlux <br/>Warra', '-43.096300', '146.655600','SO|800080|CCCCCC','Warra AND (Supersites OR Ozflux)'));
array_push($data, array('Supersites<br/>Great Western Woodlands Salmon gum', '-30.191000', '120.655231','S|FF0000|000000','Supersites Great Western Woodlands Salmon Gum'));
array_push($data, array('Supersites<br/>Great Western Woodlands Gimlet', '-30.191450', '120.650731','S|FF0000|000000','Supersites Great Western Woodlands Gimlet'));
array_push($data, array('Supersites & OzFlux <br/>Great Western Woodlands Tower', '-30.191333', '120.654139','SO|800080|CCCCCC','&#34;Great Western Woodlands&#34;  AND (Supersites OR Ozflux)'));
array_push($data, array('OzFlux <br/>Adelaide River', '-13.077000', '131.118000','O|00FFFF|000000','OzFlux Adelaide River'));
array_push($data, array('OzFlux <br/>Daly River Pasture', '-14.063333', '131.318056','O|00FFFF|000000','OzFlux Daly River Pasture'));
array_push($data, array('OzFlux <br/>Daly River Uncleared', '-14.159200', '131.388100','O|00FFFF|000000','OzFlux Daly River Uncleared'));
array_push($data, array('OzFlux <br/>Dargo', '-37.133444', '147.170917','O|00FFFF|000000','OzFlux Dargo'));
array_push($data, array('OzFlux <br/>Dry River', '-15.257482,132.370784','O|00FFFF|000000','OzFlux Dry River'));
array_push($data, array('OzFlux <br/>Fogg Dam', '-12.545219', '131.307183','O|00FFFF|000000','OzFlux Fogg Dam'));
array_push($data, array('OzFlux <br/>Gnangara', '-31.376389', '115.713889','O|00FFFF|000000','OzFlux Gnangara'));
array_push($data, array('OzFlux <br/>Hamersley', '-22.298278', '117.694306','O|00FFFF|000000','OzFlux Hamersley'));
array_push($data, array('OzFlux <br/>Howard Springs', '-12.495200', '131.150050','O|00FFFF|000000','OzFlux Howard Springs'));
array_push($data, array('OzFlux <br/>Nimmo', '-36.215944', '148.552778','O|00FFFF|000000','OzFlux Nimmo'));
array_push($data, array('OzFlux <br/>Otway', '-38.525000', '142.810000','O|00FFFF|000000','OzFlux Otway'));
array_push($data, array('OzFlux <br/>Oxford', '-43.261944', '172.210833','O|00FFFF|000000','OzFlux Oxford'));
array_push($data, array('OzFlux <br/>Riggs Creek', '-36.643233', '145.570133','O|00FFFF|000000','OzFlux Riggs Creek'));
array_push($data, array('OzFlux <br/>Scott Farm', '-37.460000', '175.220000','O|00FFFF|000000','OzFlux Scott Farm'));
array_push($data, array('OzFlux <br/>Sturt Plains', '-17.150767', '133.350317','O|00FFFF|000000','OzFlux Sturt Plains'));
array_push($data, array('OzFlux <br/>Tumbarumba', '-35.655722', '148.152083','O|00FFFF|000000','OzFlux Tumbarumba'));
array_push($data, array('OzFlux <br/>Virginia Park', '-19.883333', '146.553889','O|00FFFF|000000','OzFlux Virginia Park'));
array_push($data, array('OzFlux <br/>Wallaby Creek', '-37.426222', '145.187250','O|00FFFF|000000','OzFlux Wallaby Creek'));
array_push($data, array('OzFlux <br/>Wombat State Forest', '-37.422222','144.094444','O|00FFFF|000000','Wombat State Forest'));
array_push($data, array('Supersites & OzFlux <br/>Alice Mulga', '-22.156883', '133.257751','SO|800080|CCCCCC','&#34;Alice Mulga&#34; AND (Supersites OzFlux)'));
 
print json_encode(array('status' =>'success', 'data' =>$data));
?>