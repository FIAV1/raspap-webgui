<?php

include_once('includes/status_messages.php');

/**
 *
 * Manage OpenVPN configuration
 *
 */
function DisplayOpenVPNConfig()
{

    exec('cat '. RASPI_OPENVPN_CLIENT_CONFIG, $returnClient);
    exec('cat '. RASPI_OPENVPN_SERVER_CONFIG, $returnServer);
    exec('pidof openvpn | wc -l', $openvpnstatus);

    // parse client settings
    foreach ($returnClient as $a) {
        if ($a[0] != "#") {
            $arrLine = explode(" ", $a) ;
            $arrClientConfig[$arrLine[0]]=$arrLine[1];
        }
    }

    // parse server settings
    foreach ($returnServer as $a) {
        if ($a[0] != "#") {
            $arrLine = explode(" ", $a) ;
            $arrServerConfig[$arrLine[0]]=$arrLine[1];
        }
    }
    echo renderTemplate("openvpn", compact(
        "status",
        "openvpnStatus"
    ));
}
