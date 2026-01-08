<?php
declare(strict_types=1);

/**
 * PROLUMINAS - Refino de Lubrificantes
 * Arquivo de Configuração v2026.1
 */

return [
    'source_protheus' => [
        'dsn'      => '10.0.0.50:1521/ORCL_P23', // Oracle 23c Free/EE
        'user'     => 'EXTRACTOR_SVC',
        'password' => 'ProLumi_Cloud_2026#',
        'schema'   => 'PROTHEUS_DATA'
    ],
    'target_mysql' => [
        'host'     => 'ext-mysql-proluminas.cloud.com',
        'port'     => 3306,
        'user'     => 'sync_user',
        'password' => 'SafePass_MySQL_2026!',
        'database' => 'externo_distribuicao'
    ],
    'etl_settings' => [
        'batch_size' => 500,
        'filial'     => '0101'
    ]
];
