# AdvPL JSON Modern (v2026)


## Sobre
Evolução da biblioteca de manipulação de JSON para a empresa PROLUMINAS - Refino de Lubrificantes, focada em simplicidade e alta performance.

O **JsonModern** abstrai a complexidade de manipular dados JSON no Protheus, permitindo que desenvolvedores trabalhem com objetos dinâmicos de forma intuitiva, utilizando o motor nativo `JsonObject` para garantir o menor consumo de memória possível.


## Estrutura
- **`includes/json_modern.ch`**: Definições de comando para permitir a sintaxe amigável `[# 'chave']`.
- **`src/JsonModern.tlpp`**: Core da biblioteca utilizando a tecnologia TLPP e motor nativo TOTVS.
- **`examples/`**: Exemplos práticos de integração com tabelas do ERP.


## Instrução
- Protheus com suporte a **TLPP** (disponível por padrão em JAN/2026).
- AppServer atualizado.
```advpl
Local oJson
If U_ParseJSON('{"id": 1, "nome": "Teste"}', @oJson)
    ConOut(oJson[# "nome"]) // Saída: Teste
EndIf

## Licença e Créditos

Licença MIT. Disponível para modificação e distribuição livre, desde que atribua os créditos ao autor original.

## Autor
- **GitHub:** [trsilva23]
- **E-mail:** [trsilva23.contato@gmail.com] 

