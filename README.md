# SISTEMA DE CONTATO

Sistema de Contato

### **Frameworks:**
- Laravel 8
- Vue 2
- Vuetify

### **GIT:**
- [https://github.com/tisomar/testenetshow.git](https://github.com/tisomar/testenetshow.git)

### **Desenvolvedor:**
- Tiago de Souza Marques Rodrigues - [tisomar@gmail.com](mailto:tisomar@gmail.com)

---

### **Pré-requisitos**
```
Docker
docker-compose
```
### **BUILD DOCKER**

```
docker-compose up -d --build

Comandos para acompanhar a subida dos containers:

docker logs testenetshow-cliente --follow
docker logs testenetshow-servico --follow
docker logs testenetshow-bd --follow

Obs: É necessário acompanhar o log até o fim a instalação das dependências do container cliente, servidor e bd(acompanhe no terminal até o container
cliente exibir -> App running at: - Local:   http://localhost:8080/)

docker exec -it testenetshow-servico php artisan migrate

```

### ** ROTA ** ###

cadastrar contato: [http://localhost:8080/api/contato](http://localhost:8080/api/contato)

### ** BANCO DE DADOS ** ###


| Banco de Dados no Container|            |
|---------------|---------------          | 
| **Host**             | 35.197.112.231   |
| **Porta**            | 5432             |
| **banco de dados**   | testenetshow     |
| **Usuário**          | testenetshow     |
| **Senha**            | testenetshow     |


| Banco de Dados Acesso Externo|          |
|---------------|---------------          | 
| **Host**             | localhost        |
| **Porta**            | 5434             |
| **banco de dados**   | testenetshow     |
| **Usuário**          | testenetshow     |
| **Senha**            | testenetshow     |

----

### **TABELAS DO SISTEMA** ### 

|                   |
|-------------------|
| contatos 		|

### **ENVIO DE E-MAIL** ### 

```
As configurações de email devem ser alteradas no .env:

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=3516f3f96b076e
MAIL_PASSWORD=cdd9cd2e6a4f8c
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=testenetshow@testenetshow.com
MAIL_TO_ADDRESS=tiagorodrigues@testenetshow.com
```

### **TESTE AUTOMATIZADO** ### 
```
Executar:
docker exec -it testenetshow-servico ./vendor/bin/phpunit

```
