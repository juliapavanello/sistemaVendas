# 🛍️ Sistema de Vendas - Laravel

Este é um sistema de vendas desenvolvido com Laravel.  
Ele utiliza **PostgreSQL** como banco de dados e está pronto para ser executado localmente por qualquer pessoa com os requisitos mínimos instalados.

---

## ✅ Pré-requisitos

Antes de rodar o projeto, certifique-se de ter os seguintes itens instalados:

### 🐘 PHP (8.1 ou superior)
- Baixe em: https://windows.php.net/download
- Ou use o [XAMPP](https://www.apachefriends.org/index.html) que já vem com PHP

> ⚠️ Certifique-se de ativar a extensão `pdo_pgsql` no `php.ini`.

### 📦 Composer
- Baixe em: https://getcomposer.org/download/

### 🐘 PostgreSQL
- Baixe em: https://www.postgresql.org/download/
- Opcional: instale o **pgAdmin** como interface gráfica
- Crie um banco de dados com o nome: `bancoSistemaVendas`

### 🧬 Git
- Baixe em: https://git-scm.com/downloads

---

## 🚀 Rodando o projeto

Abra o terminal (CMD, PowerShell ou Git Bash) e siga os passos:

```bash
# 1. Clonar o projeto
git clone https://github.com/seu-usuario/sistemaVendas.git

# 2. Entrar na pasta
cd sistemaVendas

# 3. Instalar as dependências PHP
composer install

# 4. Criar o arquivo de ambiente
cp .env.example .env

# 5. Gerar a chave da aplicação
php artisan key:generate

# 6. Abra o arquivo .env com um editor de texto e configure as credenciais do seu banco PostgreSQL:
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=bancosistemavendas
DB_USERNAME=postgres
DB_PASSWORD=sua_senha
# Lembre-se: o banco bancosistemavendas precisa existir no seu PostgreSQL antes de rodar os comandos abaixo.


#rodar migrations
php artisan migrate


# executar
php artisan serve
