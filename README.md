nome do banco de dados:"quality_systems"
versão do php: 8.0.7
versão do mysql: 10.4.19-MariaDB
versão do composer: 2.1.3

1- Para executar o projeto basta instalar as dependências e rodar o seguinte comando: "php artisan serve"

2- O arquivo de criação do banco com os dados está em anexo, no entanto basta criar um banco com o nome: "quality_systems" e rodar o comando: "php artisan migrate", caso dê erro: "php artisan migrate:fresh" (apaga do banco e sobe denovo, caso haja) para subir as migrations
