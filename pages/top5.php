<?php
include '../koneksi.php';

// Query to get top 5 data
$sql = "SELECT
                e.CODEEVENTCODE,
                i.LONGDESCRIPTION,
                COUNT(e.CODEEVENTCODE) AS TOTAL
            FROM
                ELEMENTSINSPECTIONEVENT e
                LEFT JOIN INSPECTIONEVENTTEMPLATE i ON i.EVENTCODE = e.CODEEVENTCODE
                AND i.ITEMTYPECODE = e.ELEMENTSINSELMITEMTYPECODE
            WHERE
                e.EVENTTYPE = '0'
                AND NOT e.CODEEVENTCODE IN ('001', '002')
            GROUP BY
                e.CODEEVENTCODE,
                i.LONGDESCRIPTION
            ORDER BY
                COUNT(e.CODEEVENTCODE) DESC
            ";

$result = db2_exec($conn1, $sql, array('cursor' => DB2_SCROLLABLE));

if ($result) {
    $rows = array();
    while ($row = db2_fetch_assoc($result)) {
        $rows[] = $row;
    }
    echo "<style>
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                padding: 8px 12px;
                border: 1px solid #ddd;
                text-align: center;
            }
            th {
                background-color: #f4f4f4;
            }
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }
            tr:hover {
                background-color: #f1f1f1;
            }
            tr.top5 {
                background-color: #ffeb3b;
            }
            a {
                color: #007bff;
                text-decoration: none;
            }
            a:hover {
                text-decoration: underline;
            }
          </style>";
    echo "<table>";
    echo "<tr><th>Event Code</th><th>Description</th><th>Total Defect</th></tr>";
    $row_count = 0;
    foreach ($rows as $row) {
        $row_class = ($row_count < 5) ? 'top5' : '';
        echo "<tr class='$row_class'><td>" . $row["CODEEVENTCODE"] . "</td><td>" . $row["LONGDESCRIPTION"] . "</td><td>" . number_format($row["TOTAL"]) . "</td></tr>";
        $row_count++;
    }
    echo "</table>";
} else {
    echo "0 results";
}
