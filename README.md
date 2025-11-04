# Sistema de Registo e Login de Utilizadores com Smarty

Este é um sistema completo de autenticação de utilizadores construído com PHP, motor de templates Smarty e MySQL.

## Funcionalidades

### Autenticação de Utilizadores
- **Registo de Utilizadores** com validação
- **Login de Utilizadores** com hash seguro de palavras-passe
- **Painel do Utilizador** a mostrar informação do perfil
- **Gestão de Sessões**

### Sistema de Publicações (Apenas Utilizadores Registados)
- **Ver Todas as Publicações** de todos os membros da comunidade
- **Criar Publicações** com título e conteúdo
- **Editar as Suas Publicações** com contador de caracteres em tempo real
- **Eliminar as Suas Publicações** com confirmação
- **Ver Publicação Individual** com detalhes completos e informação do autor
- **Privacidade Protegida** - Apenas utilizadores autenticados podem ver as publicações

### Design
- **Design Responsivo** - Funciona em todos os dispositivos
- **Interface Moderna** com fundos de gradiente
- **Ações Codificadas por Cor** (botões Criar, Editar, Eliminar)
- **Validação em Tempo Real** e contadores de caracteres

## Pré-requisitos

Antes de começar, precisa de instalar o Docker e o Docker Compose no seu sistema.

### Instalar Docker Desktop (Windows)

1. **Transferir Docker Desktop:**
   - Aceda a [https://www.docker.com/products/docker-desktop](https://www.docker.com/products/docker-desktop)
   - Clique em "Download for Windows"

2. **Instalar Docker Desktop:**
   - Execute o instalador (Docker Desktop Installer.exe)
   - Siga o assistente de instalação
   - Ative o WSL 2 se solicitado (recomendado)
   - Reinicie o computador se necessário

3. **Verificar Instalação:**
   ```powershell
   docker --version
   docker-compose --version
   ```
   Deverá ver os números de versão para ambos os comandos.

4. **Iniciar Docker Desktop:**
   - Inicie o Docker Desktop a partir do menu Iniciar
   - Aguarde até estar totalmente iniciado (o ícone do Docker na bandeja do sistema deixará de estar animado)

### Instalar Docker (Linux)

```bash
# Atualizar índice de pacotes
sudo apt-get update

# Instalar Docker
sudo apt-get install -y docker.io

# Instalar Docker Compose
sudo apt-get install -y docker-compose

# Adicionar o seu utilizador ao grupo docker (para executar sem sudo)
sudo usermod -aG docker $USER

# Termine e inicie sessão novamente para as alterações ao grupo fazerem efeito

# Verificar instalação
docker --version
docker-compose --version
```

### Instalar Docker (macOS)

1. **Transferir Docker Desktop:**
   - Aceda a [https://www.docker.com/products/docker-desktop](https://www.docker.com/products/docker-desktop)
   - Clique em "Download for Mac"

2. **Instalar Docker Desktop:**
   - Abra o ficheiro .dmg
   - Arraste o Docker para a pasta Aplicações
   - Inicie o Docker a partir de Aplicações

3. **Verificar Instalação:**
   ```bash
   docker --version
   docker-compose --version
   ```

## Estrutura da Base de Dados

### Tabela Users
A aplicação utiliza uma tabela `users` com as seguintes colunas:
- `id` (INT, AUTO_INCREMENT, PRIMARY KEY)
- `username` (VARCHAR(255), UNIQUE)
- `password` (VARCHAR(255), com hash)
- `email` (VARCHAR(255), UNIQUE)
- `created_at` (TIMESTAMP)

### Tabela Posts
A tabela `posts` armazena todas as publicações dos utilizadores:
- `id` (INT, AUTO_INCREMENT, PRIMARY KEY)
- `user_id` (INT, FOREIGN KEY para users.id)
- `title` (VARCHAR(255))
- `content` (TEXT)
- `created_at` (TIMESTAMP)
- `updated_at` (TIMESTAMP)
- **Relações:** Cada publicação pertence a um utilizador; as publicações são eliminadas se o utilizador for eliminado

## Estrutura de Ficheiros

```
├── config.php              # Configuração da base de dados
├── index.php               # Página inicial (redireciona com base no estado de login)
├── login.php               # Gestor de login
├── register.php            # Gestor de registo
├── logout.php              # Gestor de logout
├── posts.php               # Ver todas as publicações (apenas utilizadores registados)
├── create_post.php         # Criar nova publicação
├── view_post.php           # Ver detalhes de publicação individual
├── edit_post.php           # Editar publicação (apenas proprietário)
├── delete_post.php         # Eliminar publicação (apenas proprietário)
├── db/
│   ├── init.sql           # Script de inicialização da base de dados (users + posts)
│   └── posts.sql          # Esquema da tabela posts (backup)
├── templates/
│   ├── home.tpl           # Template da página inicial
│   ├── login.tpl          # Template do formulário de login
│   ├── register.tpl       # Template do formulário de registo
│   ├── dashboard.tpl      # Template do painel do utilizador
│   ├── posts.tpl          # Template de listagem de todas as publicações
│   ├── create_post.tpl    # Template do formulário de criar publicação
│   ├── view_post.tpl      # Template de visualização de publicação individual
│   └── edit_post.tpl      # Template do formulário de editar publicação
├── templates_c/           # Templates compilados do Smarty (gerados automaticamente)
├── vendor/                # Dependências do Composer (Smarty)
├── README.md              # Este ficheiro
└── POSTS_GUIDE.md         # Documentação detalhada da funcionalidade de publicações
```

## Instruções de Configuração do Projeto

### Passo 1: Clonar ou Transferir o Projeto

Se tiver o projeto num ficheiro ZIP, extraia-o. Se estiver num repositório Git:

```bash
git clone <url-do-repositorio>
cd TB2
```

### Passo 2: Verificar a Estrutura do Projeto

Certifique-se de que tem estes ficheiros no seu diretório do projeto:
```
TB2/
├── docker-compose.yml
├── Dockerfile
├── config.php
├── index.php
├── login.php
├── register.php
├── logout.php
├── composer.json
├── db/
│   └── init.sql
└── templates/
    ├── home.tpl
    ├── login.tpl
    ├── register.tpl
    └── dashboard.tpl
```

### Passo 3: Iniciar Docker Desktop

**Windows/Mac:** Inicie o Docker Desktop e aguarde até estar totalmente em execução (o ícone do Docker na bandeja do sistema ficará estável).

**Linux:** O daemon Docker deverá iniciar automaticamente. Verifique com:
```bash
sudo systemctl status docker
```

### Passo 4: Construir e Iniciar os Contentores

Abra um terminal/PowerShell no diretório do projeto e execute:

**Windows (PowerShell):**
```powershell
docker-compose up --build -d
```

**Linux/Mac:**
```bash
docker-compose up --build -d
```

Este comando irá:
- Construir o contentor PHP personalizado com Apache, Composer e PDO MySQL
- Obter as imagens MySQL e phpMyAdmin
- Iniciar os três contentores em modo destacado

**Resultado esperado:**
```
[+] Building ...
[+] Running 4/4
 ✔ Network tb2_default         Created
 ✔ Container tb2-db-1          Started
 ✔ Container tb2-www-1         Started
 ✔ Container tb2-phpmyadmin-1  Started
```

### Passo 5: Instalar Dependências do Composer

Assim que os contentores estiverem em execução, instale o Smarty via Composer:

**Windows (PowerShell):**
```powershell
docker-compose exec www composer install
```

**Linux/Mac:**
```bash
docker-compose exec www composer install
```

Se ainda não instalou o Smarty:
```powershell
docker-compose exec www composer require smarty/smarty
```

### Passo 6: Aguardar pela Inicialização do MySQL

**Importante:** Aguarde cerca de 30-60 segundos para que o MySQL inicialize completamente e crie a base de dados a partir do `init.sql`.

Pode verificar se o MySQL está pronto:
```powershell
docker-compose logs db
```

Procure por uma linha como: `ready for connections` ou `port: 3306`

### Passo 7: Aceder à Aplicação

Abra o seu navegador web e navegue para:
- **Aplicação Principal:** [http://localhost](http://localhost)
- **phpMyAdmin:** [http://localhost:8001](http://localhost:8001)

### Passo 8: Verificar a Instalação

1. Deverá ver a página de boas-vindas com os botões "Login" e "Register"
2. Tente fazer login com a conta de teste:
   - **Nome de utilizador:** `testuser`
   - **Palavra-passe:** `password123`

## Gerir a Aplicação

### Ver Contentores em Execução
```powershell
docker-compose ps
```

### Ver Registos dos Contentores
```powershell
# Todos os contentores
docker-compose logs

# Contentor específico
docker-compose logs www
docker-compose logs db
docker-compose logs phpmyadmin

# Seguir registos em tempo real
docker-compose logs -f www
```

### Parar a Aplicação
```powershell
docker-compose stop
```

### Iniciar a Aplicação (após parar)
```powershell
docker-compose start
```

### Parar e Remover Contentores
```powershell
docker-compose down
```

### Reconstruir Contentores (após alterar o Dockerfile)
```powershell
docker-compose down
docker-compose up --build -d
```

### Aceder à Shell do Contentor
```powershell
# Aceder ao contentor PHP
docker-compose exec www bash

# Aceder ao contentor MySQL
docker-compose exec db bash

# Executar comandos MySQL
docker-compose exec db mysql -u php_docker -ppassword php_docker
```

### Reiniciar a Base de Dados
Se precisar de reiniciar a base de dados:
```powershell
docker-compose down -v
docker-compose up -d
```
A flag `-v` remove os volumes, o que eliminará os dados da base de dados.

## Utilização

### Registo
1. Clique em "Register" na página inicial
2. Preencha:
   - Nome de utilizador (deve ser único)
   - Email (deve ser único e válido)
   - Palavra-passe (mínimo 6 caracteres)
   - Confirmar Palavra-passe
3. Clique no botão "Register"
4. Será automaticamente autenticado e redirecionado para o painel

### Login
1. Clique em "Login" na página inicial
2. Introduza o seu nome de utilizador e palavra-passe
3. Clique no botão "Login"
4. Será redirecionado para o seu painel

### Painel
- Veja a informação do seu perfil (ID, nome de utilizador, email)
- Clique em "View Posts" para aceder às publicações da comunidade
- Clique em "Logout" para terminar a sua sessão

### Trabalhar com Publicações (Apenas Utilizadores Registados)

#### Visualizar Publicações
1. A partir do painel, clique em "View Posts" ou "Go to Community Posts"
2. Navegue por todas as publicações da comunidade
3. As publicações são ordenadas das mais recentes para as mais antigas
4. Clique em "Read More" para ver os detalhes completos da publicação

#### Criar uma Publicação
1. Clique no botão "Create New Post"
2. Introduza um título (mínimo 3 caracteres)
3. Escreva o seu conteúdo (mínimo 10 caracteres)
4. Clique em "Publish Post"
5. A sua publicação aparecerá no feed da comunidade

#### Editar as Suas Publicações
1. Em qualquer publicação que criou, clique no botão "Edit"
2. Modifique o título ou o conteúdo
3. Clique em "Update Post"
4. O timestamp "updated_at" da publicação será atualizado

#### Eliminar as Suas Publicações
1. Em qualquer publicação que criou, clique no botão "Delete"
2. Confirme a eliminação na caixa de diálogo
3. A publicação será permanentemente removida

**Nota:** Só pode editar ou eliminar publicações que criou. As publicações de outros utilizadores são apenas de visualização.

## Conta de Teste

Um utilizador de teste já está criado na base de dados com publicações de exemplo:
- **Nome de utilizador:** `testuser`
- **Palavra-passe:** `password123`
- **Email:** `test@example.com`

**Publicações de Exemplo Incluídas:**
1. "Welcome to the Community!" - Publicação de introdução
2. "Tips for Getting Started" - Publicação de dicas úteis
3. "What are you working on?" - Publicação de discussão

Pode fazer login com esta conta para ver as publicações existentes e criar as suas próprias!

## Funcionalidades de Segurança

### Autenticação e Autorização
- As palavras-passe são codificadas usando `password_hash()` com bcrypt
- Verificação de palavras-passe usando `password_verify()`
- Autenticação baseada em sessões
- **Rotas Protegidas:** As páginas de publicações requerem login
- **Validação de Propriedade:** Os utilizadores só podem editar/eliminar as suas próprias publicações

### Proteção de Dados
- Prevenção de injeção SQL usando declarações preparadas (PDO)
- Validação e sanitização de entradas (tanto do lado do cliente como do servidor)
- Proteção XSS (o Smarty escapa automaticamente a saída)
- Proteção CSRF (baseada em formulários)

### Segurança da Base de Dados
- Restrições de chaves estrangeiras (publicações ligadas aos utilizadores)
- Eliminação em cascata (publicações eliminadas quando o utilizador é eliminado)
- Restrições de unicidade no nome de utilizador e email

## Regras de Validação

### Registo:
- Todos os campos são obrigatórios
- A palavra-passe deve ter pelo menos 6 caracteres
- As palavras-passe devem coincidir
- O email deve ter um formato válido
- O nome de utilizador e o email devem ser únicos

### Login:
- O nome de utilizador e a palavra-passe são obrigatórios
- As credenciais devem corresponder aos registos da base de dados

### Criar/Editar Publicações:
- O título é obrigatório (3-255 caracteres)
- O conteúdo é obrigatório (mínimo 10 caracteres)
- Apenas utilizadores autenticados podem criar publicações
- Apenas os proprietários das publicações podem editá-las/eliminá-las

## Resolução de Problemas

### Problemas Comuns e Soluções

#### 1. Docker Desktop Não Está em Execução
**Erro:** `Cannot connect to the Docker daemon`

**Solução:**
- Certifique-se de que o Docker Desktop está em execução (Windows/Mac)
- No Linux, inicie o Docker: `sudo systemctl start docker`

#### 2. Porta Já em Uso
**Erro:** `Bind for 0.0.0.0:80 failed: port is already allocated`

**Solução:**
- Outro serviço está a usar a porta 80 (como IIS, Apache ou Skype)
- Opção A: Pare o serviço conflituante
- Opção B: Altere a porta no `docker-compose.yml`:
  ```yaml
  ports:
    - 8080:80  # Use a porta 8080 em vez disso
  ```
  Depois aceda via `http://localhost:8080`

#### 3. Erros de Ligação à Base de Dados
**Erro:** `Connection failed` ou `SQLSTATE[HY000] [2002]`

**Solução:**
- Aguarde 30-60 segundos para o MySQL inicializar completamente
- Verifique se o contentor MySQL está em execução: `docker-compose ps`
- Verifique os registos do MySQL: `docker-compose logs db`
- Verifique se as credenciais da base de dados em `config.php` correspondem ao `docker-compose.yml`

#### 4. Template Smarty Não Encontrado
**Erro:** `Unable to load template file`

**Solução:**
- Verifique se o diretório `templates/` existe
- Verifique as permissões dos ficheiros
- Certifique-se de que o diretório `templates_c/` está criado e é gravável:
  ```powershell
  docker-compose exec www mkdir -p /var/www/html/templates_c
  docker-compose exec www chmod 777 /var/www/html/templates_c
  ```

#### 5. Dependências do Composer em Falta
**Erro:** `Class 'Smarty\Smarty' not found`

**Solução:**
- Instale as dependências do Composer:
  ```powershell
  docker-compose exec www composer install
  ```

#### 6. Página Mostra Código PHP em Vez de o Executar
**Problema:** O navegador mostra o código PHP como texto

**Solução:**
- Certifique-se de que está a aceder via `http://localhost` e não `file://`
- Verifique se o Apache está em execução: `docker-compose ps`
- Reinicie os contentores: `docker-compose restart www`

#### 7. "Access Denied" ao Ligar à Base de Dados
**Solução:**
- Verifique as credenciais em `config.php`:
  ```php
  define('DB_HOST', 'db');  // Deve ser 'db' (nome do contentor)
  define('DB_NAME', 'php_docker');
  define('DB_USER', 'php_docker');
  define('DB_PASS', 'password');
  ```

#### 8. Problemas de Sessão
**Problema:** Não consegue fazer login ou a sessão não persiste

**Solução:**
- Limpe os cookies e cache do navegador
- Verifique se o diretório de sessão é gravável:
  ```powershell
  docker-compose exec www php -r "echo session_save_path();"
  ```

#### 9. Tabela MySQL Não Existe
**Erro:** `Table 'php_docker.users' doesn't exist`

**Solução:**
- Verifique se o `init.sql` foi executado:
  ```powershell
  docker-compose exec db mysql -u php_docker -ppassword php_docker -e "SHOW TABLES;"
  ```
- Se não houver tabelas, importe manualmente:
  ```powershell
  docker-compose exec -T db mysql -u php_docker -ppassword php_docker < db/init.sql
  ```

#### 10. Alterações Não São Refletidas
**Problema:** As alterações ao código não aparecem no navegador

**Solução:**
- Atualização forçada: `Ctrl + F5` (Windows) ou `Cmd + Shift + R` (Mac)
- Limpe a cache do Smarty:
  ```powershell
  docker-compose exec www rm -rf /var/www/html/templates_c/*
  docker-compose exec www rm -rf /var/www/html/cache/*
  ```

### Obter Mais Ajuda

Verifique os registos para mensagens de erro detalhadas:
```powershell
# Erros PHP/Apache
docker-compose logs www

# Erros MySQL
docker-compose logs db

# Todos os erros
docker-compose logs
```

## Tecnologias Utilizadas

- **PHP 8.x** com servidor web Apache
- **MySQL 8.x** base de dados
- **Smarty 4.x** Motor de Templates
- **PDO** para ligações seguras à base de dados
- **Composer** para gestão de dependências
- **Docker & Docker Compose** para contentorização
- **phpMyAdmin** para gestão da base de dados

## Notas de Desenvolvimento

- As sessões são iniciadas em `config.php`
- A ligação à base de dados usa PDO com modo de exceção e declarações preparadas
- Os templates usam extensão `.tpl`
- Os templates compilados são armazenados no diretório `templates_c/` (gerado automaticamente)
- Todas as rotas de publicações estão protegidas com verificações de autenticação
- As relações de chaves estrangeiras garantem a integridade dos dados
- Os timestamps são geridos automaticamente pelo MySQL

## URLs da Aplicação

Assim que os contentores estiverem em execução, aceda a:
- **Aplicação Principal:** [http://localhost](http://localhost)
- **Página de Publicações:** [http://localhost/posts.php](http://localhost/posts.php) (requer login)
- **phpMyAdmin:** [http://localhost:8001](http://localhost:8001)
  - Servidor: `db`
  - Nome de utilizador: `php_docker`
  - Palavra-passe: `password`

## Documentação Adicional

Para informação detalhada sobre a funcionalidade de publicações, consulte [POSTS_GUIDE.md](POSTS_GUIDE.md)

## Guia de Início Rápido

1. **Instalar Docker Desktop** (consulte a secção Pré-requisitos)
2. **Clonar ou transferir** este repositório
3. **Abrir terminal** no diretório do projeto
4. **Executar:** `docker-compose up --build -d`
5. **Aguardar 30-60 segundos** para o MySQL inicializar
6. **Abrir navegador:** [http://localhost](http://localhost)
7. **Fazer login** com a conta de teste (nome de utilizador: `testuser`, palavra-passe: `password123`)
8. **Explorar** o painel e a funcionalidade de publicações!

## Visão Geral da Estrutura do Projeto

Esta é uma aplicação web full-stack com:
- **Frontend:** HTML5, CSS3, JavaScript (vanilla)
- **Motor de Templates:** Smarty para separação limpa MVC
- **Backend:** PHP com práticas orientadas a objetos
- **Base de Dados:** MySQL com design relacional
- **Infraestrutura:** Docker para implementação fácil e consistência
