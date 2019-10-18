<h1>Cidadão de olho</h1>
# Sobre

A aplicação **Cidadão de olho** é uma ferramenta que facilita a transparência no governo do estado de Minas Gerais, utilizando somente dados abertos oferecidos pelo próprio governo, sendo eles:

- [Dados sobre os deputados em exercício](http://dadosabertos.almg.gov.br/ws/deputados/em_exercicio?formato=json).
- [Dados sobre cada deputado individualmente](http://dadosabertos.almg.gov.br/ws/deputados/ajuda#Registro%20de%20Deputado).
- [Dados sobre verbas indenizatórias de cada deputado](http://dadosabertos.almg.gov.br/ws/prestacao_contas/verbas_indenizatorias/ajuda#Lista%20de%20Datas%20de%20Verbas%20Indenizat%C3%B3rias%20de%20um%20Deputado%20na%20legislatura%20atual).

# Instalação e configuração 

## Requisitos

Para instalar a aplicação será necessário:

- PHP 7.2.*
- Composer
- MySQL 5^
- NodeJS 10.16.*
- NPM 6^

## Instalação

Após clonar o projeto você deverá utilizar os seguintes comandos:

Para instalar os pacotes do composer

```
composer install
```

Para instalar os pacotes do npm

```
npm install
```

## Configuração

As configurações necessárias para utilizar a aplicação são as seguintes:

### Banco de dados

- Crie um banco de dados nomeado laravel
- Copie o arquivo ***.env.example*** para ***.env***
```
// no linux
cp .env.example .env
```
- Altere as configurações do banco no arquivo ***.env***
```
DB_USERNAME=<usuario_do_banco>
DB_PASSWORD=<senha_do_banco>
```

### Configurações da aplicação

- Gerar a chave da aplicação
```
php artisan key:generate
```
- Migrar as tabelas
```
php artisan migrate
```
- Popular as tabelas
```
php artisan popular:tabelas
```

## Utilizando a aplicação localmente

Para utilizar a aplicação em localhost basta rodar os seguintes comandos em terminais diferentes e abrir o navegador em [http://localhost:8000/](http://localhost:8000/)

- Iniciar servidor php local
```
php artisan serve
```
- Iniciar servidor node local
```
npm run development
```

## Testes

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

### Laravel

### Npm

## Documentação

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.
