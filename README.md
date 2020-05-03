## API REST Konektron

### Permissões

```
$ chown <usuario_apache>:<grupo_usuario> application/logs -hR
```

### Instalação

#### Composer

Instalação através do Composer (recomendado).

```
# Baixar o arquivo composer.phar
$ curl -sS https://getcomposer.org/installer | php
# Instalação das dependencias
$ php composer.phar install
```

### Estrutura da Aplicação

```
Konektron-api-code/
 |__ application/
 |  |__ cache - 
 |  |__ config - Arquivos de configuração da API
 |  |__ controlllers - Diretório de controllers
 |  |__ core - Classes MY_ para manupulação do Core
 |  |__ helpers - Bibliotecas com helpers
 |  |__ hooks - Eventos antes e depois do controller
 |  |__ language - Tradução da API
 |  |__ libraries - Bibliotecas customizadas para a API
 |  |__ logs - Logs da API
 |  |__ migrations - Alteração no banco de dados
 |  |__ models - Models para persistência no banco
 |  |__ schemas - jso-schemas para validação de entrada
 |  |__ third_party - Pacotes de CI
 |  |__ views - Views utilizadas na API
 |__ assets/ - Arquivos de assests do sistema
 |__ system/ - Core do sistema
 |__ user_guide/ - Manual do framework
 |__ index.php - Arquivo principal da aplicação
 ```
