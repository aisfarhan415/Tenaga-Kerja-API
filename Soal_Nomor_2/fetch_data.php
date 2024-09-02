<?php
$apiUrl = "http://34.101.235.69/ekatalog/apiv1/datatable/tenagakerja";
$apiKey = "api_SECRET";
$sessionToken = "SESSION_TOKEN_SECRET";

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => $apiUrl . "?offset=0",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "X-DreamFactory-Api-Key: $apiKey",
        "X-DreamFactory-Session-Token: $sessionToken"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $responseArray = json_decode($response, true);

    echo '<table border="1">';
    echo '<thead><tr><th>No</th><th>Provinsi</th><th>Kabupaten/Kota</th><th>Tenaga Kerja</th><th>Kode</th><th>Satuan</th><th>Harga OH</th><th>Harga OJ</th><th>Sumber Data</th></tr></thead>';
    echo '<tbody>';

    if (isset($responseArray['data']) && is_array($responseArray['data'])) {
        $no = 1;
        foreach ($responseArray['data'] as $row) {
            echo '<tr>';
            echo '<td>' . $no++ . '</td>';
            echo '<td>' . htmlspecialchars($row['provinsi'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($row['kabkota'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($row['tenagakerja'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($row['kode'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($row['satuan'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($row['harga_oh'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($row['harga_oj'] ?? '') . '</td>';
            echo '<td>' . htmlspecialchars($row['sumberdata'] ?? '') . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="9">No data available</td></tr>';
    }

    echo '</tbody></table>';
}
?>
