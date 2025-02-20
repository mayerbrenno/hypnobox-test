# hypnobox-test

Uma aplicação API Laravel utilizando Sanctum com autenticação para o teste técnico da Hypnobox
A dockerized Laravel API with authentication for the technical test

Esse projeto está disponível na URL: https://github.com/mayerbrenno/hypnobox-test

Bibliotecas e instalações necessárias
Docker
PHP => 8.3+

### Instruções de instalação

Vá para qualquer pasta no seu sistema ou para sua home
cd ~

Now it's time to clone the project
git clone https://github.com/mayerbrenno/hypnobox-test

### Para executar a aplicação com o Docker

Criar o .env a partir do arquivo de exemplo
cp .env-docker.example .env

Criar e subir os containers
docker compose up -d

Acessar o container da aplicação
docker exec -it hypno-app bash
![Alt text](demo/images/image.png?raw=true "Title")

Dentro do container executar esses comandos:

Instalar dependencias
composer install

Gerar chave da aplicação
php artisan key:generate

Executar migrações para criar as tabelas
php artisan migrate

Para popular a base de dados
php artisan db:seed

Para acessa a aplicação, colocar o endereço no navegador:
localhost:8989
