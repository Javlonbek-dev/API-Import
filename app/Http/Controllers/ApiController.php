<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{

    public function fetchData()
    {
        $baseUrl = 'https://akkred.uz:8081/main/reestr-conf/';
        $allData = [];
        $nextPageUrl = $baseUrl;

        while ($nextPageUrl) {
            $response = Http::get($nextPageUrl);

            if ($response->successful()) {
                $data = $response->json();
                $allData = array_merge($allData, $data['results']);
                $nextPageUrl = $data['next'];
            } else {
                return response()->json(['message' => 'Failed to fetch data from the API'], 500);
            }
        }

        usort($allData, function($a, $b) {
            return $a['id'] <=> $b['id'];
        });

        $tableName = 'organizations';
        $statusMapping = [
            'active' => 1,
            'inactive' => 2,
            'pause' => 3,
            'extended' => 4
        ];

        $sql = "INSERT INTO `$tableName` (`id`, `created_at`, `updated_at`, `title_yurd_lisa`, `title_organ_short`, `title_organ`, `title_organ_type`, `address`, `address_organ`, `number`, `accreditation_date`, `validity_date`, `reissue_date`, `is_reissue_date`, `inn`, `phone`, `email`, `web_site`, `full_name_supervisor_ao`, `is_fact_address`, `phone_ao`, `email_ao`, `status_id`, `status_date`, `file_oblast`, `is_public`, `is_file_oblast`, `certificate`, `is_certificate`, `area`, `region_id`, `owner_ship_type_id`, `direction_id`) VALUES\n";

        foreach ($allData as $index => $row) {
            // Map the status value to the corresponding status ID
            $statusId = isset($statusMapping[$row['status']]) ? $statusMapping[$row['status']] : 'NULL';
            $validityDate = isset($row['validity_date']) ? $this->convertDateFormat($row['validity_date']) : 'NULL';
            $accreditationDate = isset($row['accreditation_date']) ? $this->convertDateFormat($row['accreditation_date']) : 'NULL';
            $reissueDate = isset($row['reissue_date']) ? $this->convertDateFormat($row['reissue_date']) : 'NULL';
            $statusDate = isset($row['status_date']) ? $this->convertDateFormat($row['status_date']) : 'NULL';

            $sql .= "(" .
                intval($row['id']) . "," .
                $this->formatValue($row['created_date']) . "," .
                $this->formatValue($row['modified_date']) . "," .
                $this->formatValue($row['title_yurd_lisa']) . "," .
                $this->formatValue($row['title_organ_short']) . "," .
                $this->formatValue($row['title_organ']) . "," .
                $this->formatValue($row['title_organ_type']) . "," .
                $this->formatValue($row['address']) . "," .
                $this->formatValue($row['address_organ']) . "," .
                $this->formatValue($row['number']) . "," .
                $this->formatValue($accreditationDate) . "," .
                $this->formatValue($validityDate) . "," .
                $this->formatValue($reissueDate) . "," .
                ($row['is_reissue_date'] ? '1' : '0') . "," .
                $this->formatValue($row['inn']) . "," .
                $this->formatValue($row['phone'], true) . "," .
                $this->formatValue($row['email'], true) . "," .
                $this->formatValue($row['web_site']) . "," .
                $this->formatValue($row['full_name_supervisor_ao']) . "," .
                ($row['is_fact_address'] ? '1' : '0') . "," .
                $this->formatValue($row['phone_ao'], true) . "," .
                $this->formatValue($row['email_ao'], true) . "," .
                $statusId . "," .
                $this->formatValue($statusDate) . "," .
                $this->formatValue($row['file_oblast']) . "," .
                ($row['is_public'] ? '1' : '0') . "," .
                ($row['is_file_oblast'] ? '1' : '0') . "," .
                $this->formatValue($row['certificate'], true) . "," .
                ($row['is_certificate'] ? '1' : '0') . "," .
                $this->formatValue($row['area']) . "," .
                'NULL,' .
                'NULL,' .
                'NULL' .
                ")";

            $sql .= $index < count($allData) - 1 ? ",\n" : ";\n";
        }

        Storage::put('data.sql', $sql);

        return response()->json(['message' => 'All data saved to SQL file successfully']);
    }

    private function formatValue($value, $allowNull = false)
    {
        if ($allowNull && ($value === null || $value === '')) {
            return 'NULL';
        }

        $escapedValue = str_replace("'", "''", $value);

        $escapedValue = str_replace("\\", "\\\\", $escapedValue);

        $escapedValue = str_replace('"', '\"', $escapedValue);

        return "'" . $escapedValue . "'";
    }

    private function convertDateFormat($date)
    {
        if (strpos($date, '.') !== false) {
            $parts = explode('.', $date);
            return $parts[2] . '-' . $parts[1] . '-' . $parts[0];
        }
        return $date;
    }

}
