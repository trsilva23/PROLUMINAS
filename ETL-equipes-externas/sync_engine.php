<?php
declare(strict_types=1);

/**
 * PROLUMINAS - Refino de Lubrificantes
 * Engine de Sincronização Protheus -> MySQL
 * Data: Janeiro de 2026
 */

$config = require __DIR__ . '/config.php';

// Conexão Oracle (OCI8)
$ora_conn = oci_connect(
    $config['source_protheus']['user'],
    $config['source_protheus']['password'],
    $config['source_protheus']['dsn'],
    'AL32UTF8'
);

// Conexão MySQL (PDO)
$dsn_mysql = "mysql:host={$config['target_mysql']['host']};dbname={$config['target_mysql']['database']};charset=utf8mb4";
$mysql_pdo = new PDO($dsn_mysql, $config['target_mysql']['user'], $config['target_mysql']['password'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

echo "Conexões estabelecidas. Iniciando extração...\n";

// Chama Procedure PL/SQL
$sql = "BEGIN SP_EXTRACAO_PROLUMINAS(:data, :cursor); END;";
$stmt = oci_parse($ora_conn, $sql);
$data_ref = date('Ymd', strtotime('-1 day'));
$cursor = oci_new_cursor($ora_conn);

oci_bind_by_name($stmt, ":data", $data_ref);
oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);

oci_execute($stmt);
oci_execute($cursor);

// Preparar MySQL para inserção em massa
$insert_sql = "INSERT INTO faturamento_externo (id_prod, descricao, litros, valor, hash_cli, data_ref) 
               VALUES (?, ?, ?, ?, ?, ?)";
$insert_stmt = $mysql_pdo->prepare($insert_sql);

$mysql_pdo->beginTransaction();
$total = 0;

while ($row = oci_fetch_array($cursor, OCI_ASSOC)) {
    $insert_stmt->execute([
        $row['PRODUTO_ID'],
        $row['PRODUTO_DESC'],
        $row['QTD_LITROS'],
        $row['VALOR_TOTAL'],
        $row['CLIENTE_HASH'],
        $row['DATA_FATURAMENTO']
    ]);
    $total++;
}

$mysql_pdo->commit();
echo "ETL Concluído. Registros sincronizados: $total\n";
