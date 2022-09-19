# APIs REST com PHP 7 e Slim Framework

Copie o arquivo `env.example.php` para `env.php` e preencha com as informações necessárias.

Rode no terminal `docker-compose build` e ` docker-compose up -d  ` para subir os containers.

Use o código da pasta sql/ para criar o seu banco de dados trabalhando com o SGBD MySQL.

<h1>Chamadas API</h1>

<h2>Criar Usuario (POST) <h2>
url: http://localhost/v1/user
POST Exemplo:
{
	"nome": "Marcelo",
	"sobrenome": "Perez",
	"cpf":"474504",
	"email":"mogteetg@gmail.co",
	"senha":"123",
	"saldo":"200.20",
	"tipo_usuario":1
}

<h2>Obter Usuario (GET) <h2>
url: http://localhost/v1/user/1


<h2>Fazer Transferencia (POST) <h2>
url: http://localhost/v1/transfer
POST Exemplo:
{
	"pagador":2,
	"beneficiario":1,
	"valor": 50.23
}
