# hypnobox-test

Uma aplicação API Laravel utilizando Sanctum com autenticação para o teste técnico da Hypnobox.

Esse projeto está disponível na URL:  
<https://github.com/mayerbrenno/hypnobox-test>

Bibliotecas e instalações necessárias:  
Docker  
PHP => 8.3+

## Clonando a aplicação

Vá para qualquer pasta no seu sistema ou para sua home  
***cd ~***

***git clone:*** <https://github.com/mayerbrenno/hypnobox-test>

Acessar o diretório da aplicação:  
***cd hypnobox-test***

## Configuração do projeto para o Docker

Criar o .env a partir do arquivo de exemplo  
***cp .env-docker.example .env***

Criar e subir os containers  
***docker compose up -d***

Acessar o container da aplicação

**docker exec -it hypno-app bash**
![Alt text](demo/images/image.png?raw=true "Title")

### Dentro do container executar esses comandos

Instalar dependencias  
***composer install***

Gerar chave da aplicação  
***php artisan key:generate***

Executar migrações para criar as tabelas  
***php artisan migrate***

Para popular a base de dados  
***php artisan db:seed***

Para acessa a aplicação, colocar o endereço no navegador:  
***localhost:8989***

## Testando a API com Postman ou similares

### Autenticação

Primeiramente envie uma requisição **POST** para **localhost:8989/api/register** com um objeto **JSON** para criar um usuário.

**Lembre-se de colocar os headers:**  
*Accept: application/json  
Content-Type: application/json*

```JSON
{
    "name": "{Nome de usuário}",
    "email": "{email}",
    "password": "{senha}"
}
```

O sistema irá te responder da seguinte maneira:

```JSON
{
    "message": "Login Successful",
    "token_type": "Bearer",
    "token": "{token}"
}
```

Após esse processo, o token **{token}** de autenticação será utilizado para testar os demais endpoints

### Categoria

#### Listagem

METHOD: **GET**  
URL: **/api/categorias**  
Auth: **Bearer Token**

Lista todas as categorias.

*Resposta:*

```JSON
{
    {
        "id": {id},
        "name": {name},
        "active": {active},
        "created_by": {created_by},
        "deleted_by": {deleted_by},
        "deleted_at": {deleted_at},
        "created_at": {created_at},
        "updated_at": {updated_at}
    }
}
```

---

#### Criação

METHOD: **POST**  
URL: **/api/categorias**  
Auth: **Bearer Token**  

Cria uma nova categoria.

*Body:*

```JSON
{
    "name": "Categoria",
    "active": true
}
```

*Resposta:*

```JSON
{
    "id": {id},
    "name": {name},
    "active": {active},
    "created_by": {created_by},
    "deleted_by": {deleted_by},
    "deleted_at": {deleted_at},
    "created_at": {created_at},
    "updated_at": {updated_at}
}
```

---

#### Show

METHOD: **GET**  
URL: **/api/categorias/{id}**  
Auth: **Bearer Token**  

Seleciona uma categoria pelo *id*.

*Resposta:*

```JSON
{
    "id": {id},
    "name": {name},
    "active": {active},
    "created_by": {created_by},
    "deleted_by": {deleted_by},
    "deleted_at": {deleted_at},
    "created_at": {created_at},
    "updated_at": {updated_at}
}
```

---

#### Atualizar

METHOD: **PUT**  
URL: **/api/categorias/{id}**  
Auth: **Bearer Token**  

Atualiza uma categoria já existente pelo *id*.

*Body:*

```JSON
{
    "name": "Categoria",
    "active": true
}
```

*Resposta:*

```JSON
{
    "id": {id},
    "name": {name},
    "active": {active},
    "created_by": {created_by},
    "deleted_by": {deleted_by},
    "deleted_at": {deleted_at},
    "created_at": {created_at},
    "updated_at": {updated_at}
}
```

---

#### Remoção

METHOD: **DELETE**  
URL: **/api/categorias/{id}**  
Auth: **Bearer Token**  

Executa um soft delete de um registro através do *id*.

*Resposta:*

```JSON
{
    "message": "Categoria removida com sucesso"
}
```

---

### Produto

#### Listagem

METHOD: **GET**  
URL: **/api/produtos**  
Auth: **Bearer Token**

Lista todas produtos.

*Resposta:*

```JSON
{
    {
        "id": {id},
        "name": {name},
        "description": {description},
        "price": {price},
        "category_id": {category_id},
        "created_by": {created_by},
        "deleted_by": {deleted_by},
        "deleted_at": {deleted_at},
        "created_at": {created_at},
        "updated_at": {updated_at}
    }
}
```

---

#### Criação

METHOD: **POST**  
URL: **/api/produtos**  
Auth: **Bearer Token**  

Cria um novo produto.

*Body:*

```JSON
{
    "name": "Nome do Produto",
    "description": "Descrição do produto",
    "price": 100000,
    "category_id": 4
}
```

*Resposta:*

```JSON
{
    "name": {name},
    "description": {description},
    "price": {price},
    "category_id": {category_id},
    "updated_at": {updated_at},
    "created_at": {created_at},
    "id": {id}
}
```

---

#### Show

METHOD: **GET**  
URL: **/api/produtos/{id}**  
Auth: **Bearer Token**  

Seleciona um produto pelo *id*.

*Resposta:*

```JSON
{
    "id": {id},
    "name": {name},
    "description": {description},
    "price": {price},
    "category_id": {category_id},
    "deleted_by": {deleted_by},
    "deleted_at": {deleted_at},
    "created_at": {created_at},
    "updated_at": {updated_at}
}
```

---

#### Atualizar

METHOD: **PUT**  
URL: **/api/produtos/{id}**  
Auth: **Bearer Token**  

Atualiza produto já existente pelo *id*.

*Body:*

```JSON
{
    "name": "Nome do Produto",
    "description": "Descrição do produto",
    "price": 500000,
    "category_id": 3
}
```

*Resposta:*

```JSON
{
    "id": {id},
    "name": {name},
    "description": {description},
    "price": {price},
    "category_id": {category_id},
    "created_by": {created_by},
    "deleted_by": {deleted_by},
    "deleted_at": {deleted_at},
    "created_at": {created_at},
    "updated_at": {updated_at}
}
```

---

#### Remoção

METHOD: **DELETE**  
URL: **/api/produtos/{id}**  
Auth: **Bearer Token**  

Executa um soft delete de um registro através do *id*.

*Resposta:*

```JSON
{
    "message": "Produto removido com sucesso"
}
```

## Testes automatizados

Para execução dos testes automatizados execute:

```bash
php artisan test
```

Caso queira executar testes especifícos, rodar o comando abaixo:

```bash
php artisan test --filter {nomeDoTeste}
```

*Após os testes serem executados, o banco de dados será limpo.*
