# PROLUMINAS ETL-Sync v2026

## Sobre
Extração diária de movimentação de refino do ERP TOTVS Protheus implantado na empresa PROLUMINAS - Refino de Lubrificantes, para compartilhamento com parceiros logísticos em base MySQL externa.


## Estrutura
- **`includes/json_modern.ch`**: Definições de comando para permitir a sintaxe amigável `[# 'chave']`.
- **`src/JsonModern.tlpp`**: Core da biblioteca utilizando a tecnologia TLPP e motor nativo TOTVS.
- **`examples/`**: Exemplos práticos de integração com tabelas do ERP.

## Instrução
Obrigatório o seguinte Stack
- **PHP 8.4** (Strict Types + JIT)
- **Oracle 23c** (PL/SQL com hash SHA256 nativo para conformidade LGPD)
- **MySQL 8.0+**
- **Tailwind CSS** (Monitoramento)

1. Certifique-se de ter o **Oracle Instant Client 23** instalado.
2. Configure o arquivo `config.php` com os segredos do cofre de chaves da Proluminas.
3. Execute o script `prolumi_extractor.sql` no banco de produção.

Observação: Os dados de clientes são anonimizados em nível de banco de dados (Oracle) antes mesmo de chegarem à camada PHP, garantindo que o MySQL externo nunca contenha dados sensíveis brutos.


## Licença e Créditos

Licença MIT. Disponível para modificação e distribuição livre, desde que atribua os créditos ao autor original.

## Autor
- **GitHub:** [trsilva23]
- **E-mail:** [trsilva23.contato@gmail.com] 


