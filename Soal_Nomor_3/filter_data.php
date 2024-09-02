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

function filterData($apiKey, $sessionToken, $searchTerm) {
    $data = fetchTenagaKerja($apiKey, $sessionToken);

    if (isset($data['data']) && is_array($data['data'])) {
        $filteredData = array_filter($data['data'], function($item) use ($searchTerm) {
            return stripos($item['tenagakerja'], $searchTerm) !== false;
        });

        return $filteredData;
    }

    return [];
}

$apiKey = "apiKey_SECRET";
$sessionToken = "apikey_SECRET";
$searchTerm = 'sopir'; // Menggunakan 'sopir' sebagai contoh

$filteredData = filterData($apiKey, $sessionToken, $searchTerm);

if (!empty($filteredData)) {
    echo '<table border="1" cellpadding="5" cellspacing="0">';
    echo '<thead><tr><th>No</th><th>Provinsi</th><th>Kabupaten/Kota</th><th>Tenaga Kerja</th><th>Kode</th><th>Satuan</th><th>Harga OH</th><th>Harga OJ</th><th>Sumber Data</th></tr></thead>';
    echo '<tbody>';

    foreach ($filteredData as $index => $item) {
        echo '<tr>';
        echo '<td>' . ($index + 1) . '</td>';
        echo '<td>' . htmlspecialchars($item['provinsi']) . '</td>';
        echo '<td>' . htmlspecialchars($item['kabkota']) . '</td>';
        echo '<td>' . htmlspecialchars($item['tenagakerja']) . '</td>';
        echo '<td>' . htmlspecialchars($item['kode']) . '</td>';
        echo '<td>' . htmlspecialchars($item['satuan']) . '</td>';
        echo '<td>' . htmlspecialchars($item['harga_oh']) . '</td>';
        echo '<td>' . htmlspecialchars($item['harga_oj']) . '</td>';
        echo '<td>' . htmlspecialchars($item['sumberdata']) . '</td>';
        echo '</tr>';
    }

    echo '</tbody></table>';
} else {
    echo 'Data tidak ditemukan atau tidak ada yang sesuai dengan kriteria filter.';
}
?>
