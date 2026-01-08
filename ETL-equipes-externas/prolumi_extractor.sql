-- Procedure para extração otimizada de dados de refino (Tabela SD2 - Itens de Nota Fiscal)
CREATE OR REPLACE PROCEDURE SP_EXTRACAO_PROLUMINAS (
    p_data_ref IN VARCHAR2,
    p_cursor   OUT SYS_REFCURSOR
) AS 
BEGIN
    OPEN p_cursor FOR
    SELECT 
        D2_COD      AS PRODUTO_ID,
        D2_DESC     AS PRODUTO_DESC,
        D2_QUANT    AS QTD_LITROS,
        D2_TOTAL    AS VALOR_TOTAL,
        -- Em 2026, a LGPD exige anonimização robusta
        STANDARD_HASH(D2_CLIENTE, 'SHA256') AS CLIENTE_HASH, 
        TO_DATE(D2_EMISSAO, 'YYYYMMDD')      AS DATA_FATURAMENTO
    FROM SD2010
    WHERE D_E_L_E_T_ = ' '
    AND D2_EMISSAO >= p_data_ref;
END;
/
