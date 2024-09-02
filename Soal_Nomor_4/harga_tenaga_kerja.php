<?php
function fetchTenagaKerja($apiKey, $sessionToken) {
    $url = 'http://34.101.235.69/ekatalog/apiv1/datatable/tenagakerja?offset=0';

    $headers = array(
        'X-DreamFactory-Api-Key: ' . $apiKey,
        'X-DreamFactory-Session-Token: ' . $sessionToken
    );

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
        return null;
    }

    curl_close($ch);

    return json_decode($response, true);
}

function filterTenagaKerja($apiKey, $sessionToken) {
    $data = fetchTenagaKerja($apiKey, $sessionToken);

    if (isset($data['data']) && is_array($data['data'])) {
        $filteredData = [];

        foreach ($data['data'] as $item) {
            $provinsi = isset($item['provinsi']) ? strtoupper(trim($item['provinsi'])) : '';
            $kabkota = isset($item['kabkota']) ? strtoupper(trim($item['kabkota'])) : '';

            if ($provinsi === 'ACEH') {
                $filteredData[] = $item;
            }
        }

        return $filteredData;
    }

    return [];
}

function generateHtmlTable($data) {
    if (empty($data)) {
        return '<p>No data available</p>';
    }

    $groupedData = [];
    foreach ($data as $item) {
        $kabkota = isset($item['kabkota']) ? strtoupper(trim($item['kabkota'])) : '';
        if (!isset($groupedData[$kabkota])) {
            $groupedData[$kabkota] = [];
        }
        $groupedData[$kabkota][] = $item;
    }

    $html = '<table border="1"><thead><tr><th>No</th><th>Provinsi</th><th>Kabupaten/Kota</th><th>Tenaga Kerja</th><th>Kode</th><th>Satuan</th><th>Harga OH</th><th>Harga OJ</th><th>Sumber Data</th></tr></thead><tbody>';

    foreach ($groupedData as $kabkota => $items) {
        foreach ($items as $index => $item) {
            $html .= '<tr>';
            $html .= '<td>' . ($index + 1) . '</td>';
            $html .= '<td>' . htmlspecialchars($item['provinsi']) . '</td>';
            $html .= '<td>' . htmlspecialchars($item['kabkota']) . '</td>';
            $html .= '<td>' . htmlspecialchars($item['tenagakerja']) . '</td>';
            $html .= '<td>' . htmlspecialchars($item['kode']) . '</td>';
            $html .= '<td>' . htmlspecialchars($item['satuan']) . '</td>';
            $html .= '<td>' . htmlspecialchars($item['harga_oh']) . '</td>';
            $html .= '<td>' . htmlspecialchars($item['harga_oj']) . '</td>';
            $html .= '<td>' . htmlspecialchars($item['sumberdata']) . '</td>';
            $html .= '</tr>';
        }
    }

    $html .= '</tbody></table>';

    return $html;
}

$apiKey = "api_key_SECRET";
$sessionToken = "sessionToken_SECRET";

$filteredData = filterTenagaKerja($apiKey, $sessionToken);

header('Content-Type: text/html');
echo generateHtmlTable($filteredData);
?>
