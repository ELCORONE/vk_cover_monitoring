<?php		
    $ip = "localhost";
    $port = "27015";
    
    $socket = socket_create(AF_INET, SOCK_DGRAM, 0);
    $result = socket_connect($socket, $ip, $port);
    
    if($result < 0) {
		echo "connect() failed.\nReason: ($result) \n";
		exit;
	}
    
    $data = "\xFF\xFF\xFF\xFF\x54\x53\x6F\x75\x72\x63\x65\x20\x45\x6E\x67\x69\x6E\x65\x20\x51\x75\x65\x72\x79\x00";
    socket_write($socket, $data, strlen($data));
    $out = socket_read($socket, 4096); 
    $queryData         = explode("\x00", substr($out, 6), 5);
    
    $server['name']        = $queryData[0];
    $server['map']         = $queryData[1];
    $server['game']        = $queryData[2];
    $server['description'] = $queryData[3];
    $packet                = $queryData[4];
    $server['players']     = ord(substr($packet, 2, 1));
    $server['playersmax']  = ord(substr($packet, 3, 1));
    $server['bots']        = ord(substr($packet, 4, 1));
    $server['dedicated']   =     substr($packet, 5, 1);
    $server['os']          =     substr($packet, 6, 2);
    $server['password']    = ord(substr($packet, 7, 1));
    $server['vac']         = ord(substr($packet, 8, 1));
	//echo $server['name'];
?>
