# APIs REST com PHP 7 e Slim Framework

Copie o arquivo `env.example.php` para `env.php` e preencha com as informações necessárias.

Rode no terminal `docker-compose build` e ` docker-compose up -d  ` para subir os containers.

Use o código da pasta sql/ para criar o seu banco de dados trabalhando com o SGBD MySQL.

<h1>Chamadas API</h1>

<strong>Criar Usuario (POST).</strong> <br>
url: http://localhost/v1/user<br>
POST Exemplo:<br>
{<br>
	"nome": "Marcelo",<br>
	"sobrenome": "Perez",<br>
	"cpf":"474504",<br>
	"email":"mogteetg@gmail.co",<br>
	"senha":"123",<br>
	"saldo":"200.20",<br>
	"tipo_usuario":1<br>
}<br>
<br>
<strong>Obter Usuario (GET).</strong> <br>
url: http://localhost/v1/user/1<br>
<br>
<br>
<strong>Fazer Transferencia (POST).</strong> <br>
url: http://localhost/v1/transfer<br>
POST Exemplo:<br>
{<br>
	"pagador":2,<br>
	"beneficiario":1,<br>
	"valor": 50.23<br>
}<br>
