<?php
/**
 * API: Export Database as SQL Download
 */
require_once '../../includes/config.php';

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Unauthorized access.");
}

try {
    $tables = array();
    $result = $pdo->query("SHOW TABLES");
    while ($row = $result->fetch(PDO::FETCH_NUM)) {
        $tables[] = $row[0];
    }

    $return = "-- FindIt Database Backup\n";
    $return .= "-- Generated: " . date('Y-m-d H:i:s') . "\n\n";

    foreach ($tables as $table) {
        // Table structure
        $result = $pdo->query("SHOW CREATE TABLE $table");
        $row = $result->fetch(PDO::FETCH_NUM);
        $return .= "\n\n" . $row[1] . ";\n\n";

        // Table data
        $result = $pdo->query("SELECT * FROM $table");
        $num_fields = $result->columnCount();

        while ($row = $result->fetch(PDO::FETCH_NUM)) {
            $return .= "INSERT INTO $table VALUES(";
            for ($j = 0; $j < $num_fields; $j++) {
                if (isset($row[$j])) {
                    $return .= $pdo->quote($row[$j]);
                } else {
                    $return .= 'NULL';
                }
                if ($j < ($num_fields - 1)) {
                    $return .= ',';
                }
            }
            $return .= ");\n";
        }
    }

    // Download headers
    $fileName = 'findit_db_backup_' . date('Y-m-d_H-i') . '.sql';
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . $fileName . "\"");
    echo $return;
    exit;

} catch (Exception $e) {
    die("Error generating backup: " . $e->getMessage());
}
?>
