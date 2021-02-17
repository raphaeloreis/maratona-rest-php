# Desafio Técnico Deliver IT

Amostra de REST API construida em PHP. <br/>
Usando PDO para manipular banco de dados MySQL.<br/>
Seguindo a formatação recomendada.<br/>
A criação do dockerfile não foi efetuada devido ao prazo.<br/>

## Execução
Importar o arquivo maratona.sql para o banco de dados mysql e editar as variáveis de conexão no arquivo ``config.php``:

```
define('DB_NAME', 'maratona');
define('DB_HOST', 'localhost');
define('DB_PASS', '');
define('DB_USER', 'root');
```

Enviar as requisições com seus respectivo corpo(se necessário) para os endereços abaixo para acessar os serviços:

### Corredor:
```
buscar por id
// MÉTODO : GET api/corredor/:id


buscar todos
// MÉTODO : GET api/corredor/

cadastrar
// MÉTODO : POST api/corredor/
{
    "nome": "The Flash",
    "cpf": "123.123.123-12",
    "nascimento": "2000-10-17"
}

remover todos
// MÉTODO : DELETE api/corredor/:id

atualizar id
// MÉTODO : PUT api/corredor/:id
{
    "nome": "The Flash",
    "cpf": "123.123.123-12",
    "nascimento": "2000-10-17"
}

```

### Prova:
```
buscar por id
// MÉTODO : GET api/prova/:id


buscar todos
// MÉTODO : GET api/prova/

cadastrar
// MÉTODO : POST api/prova/
{
    "tipo": "3km",
    "data": "2000-10-17"
}

remover todos
// MÉTODO : DELETE api/prova/:id

atualizar id
// MÉTODO : PUT api/prova/:id
{
    "tipo": "3km",
    "data": "2000-10-17"
}

```

### Registro:
```
buscar por id
// MÉTODO : GET api/registro/:id


buscar todos
// MÉTODO : GET api/registro/

cadastrar
// MÉTODO : POST api/registro/
{
    "id_corredor": "1",
    "id_prova": "1"
}

remover todos
// MÉTODO : DELETE api/registro/:id

atualizar id
// MÉTODO : PUT api/registro/:id
{
    "id_corredor": "1",
    "id_prova": "1"
}

```


### Resultado:
```
buscar por id
// MÉTODO : GET api/resultado/:id


buscar todos
// MÉTODO : GET api/resultado/

cadastrar
// MÉTODO : POST api/resultado/
{
    "id_corredor": "1",
    "id_prova": "1",
    "hora_inicio": "10:00:00",
    "hora_conclusao": "10:25:17"
}

remover todos
// MÉTODO : DELETE api/resultado/:id

atualizar id
// MÉTODO : PUT api/resultado/:id
{
    "id_corredor": "1",
    "id_prova": "1",
    "hora_inicio": "10:00:00",
    "hora_conclusao": "10:25:17"
}

```


### Listagem:
```
listagem geral por prova
// MÉTODO : GET api/listagem/geral


listagem por faixa etaria e prova
// MÉTODO : GET  api/listagem/idade


```