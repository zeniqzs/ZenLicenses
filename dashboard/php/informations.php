<?php
header('Content-Type: application/json');

function getExternalIP() {
    return file_get_contents('https://api.ipify.org?format=json');
}

function getIPv6() {
    return file_get_contents('https://api6.ipify.org?format=json');
}

function getISP($ip) {
    $response = file_get_contents("https://ipinfo.io/{$ip}/json");
    $data = json_decode($response, true);
    return $data['org'] ?? 'N/A';
}

function getSystemInfo() {
    $info = array();

    $ipv4 = json_decode(file_get_contents('https://api.ipify.org?format=json'), true);
    $info['ipv4'] = $ipv4['ip'] ?? 'N/A';

    $ipv6 = json_decode(file_get_contents('https://api6.ipify.org?format=json'), true);
    $info['ipv6'] = $ipv6['ip'] ?? 'N/A';

    $info['isp'] = getISP($info['ipv4']);

    $info['ram'] = shell_exec('grep MemTotal /proc/meminfo | awk \'{print $2 / 1024 " MB"}\'');

    $info['storage'] = shell_exec('df -h / | grep / | awk \'{print $2}\'');

    $info['cores'] = shell_exec('nproc');

    $info['software'] = php_uname('s') . ' ' . php_uname('r');

    return $info;
}

echo json_encode(getSystemInfo());
?>
