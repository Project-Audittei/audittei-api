<p align="center"><a href="https://laravel.com" target="_blank"><img src="http://auditteifront.ofernandoavila.com/assets/images/logo.svg" width="300" alt="Laravel Logo"></a></p>

<p align="center">
<img src="https://img.shields.io/badge/Ubuntu-E95420?style=for-the-badge&logo=ubuntu&logoColor=white" alt="Ubuntu">
<img src="https://img.shields.io/badge/JWT-black?style=for-the-badge&logo=JSON%20web%20tokens" alt="JWT">
<img src="https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
<img src="https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
</p>

# Configurações iniciais

### Produção e Homologação
- PHP 8.2 ou acima
- Composer
- MySQL 8
- Apache 2

### Local
- PHP 8.2 ou acima
- Composer
- MySQL 8

# Testes

## Configuração de ambiente

### 01 - Criação do Banco de Dados
O primeiro passo para definir o ambiente de testes, é começar criando um banco de dados para realizar todas as operações de testes. Por conveção, dê o nome de ```audittei_tests``` para sinalizar que se trata de um banco de dados de testes.

### 02 - Variáveis de ambiente
Em seguida, clone o arquivo ```.env``` e coloque o nome ```.env.testing```.

Troque o valor da variável ```DB_NAME``` para o nome do banco de testes ```audittei_tests``` 

### 03 - Migrar banco
Rode o comando para migrar o banco para as configurações de testes
```
php artisan migrate --env=testing
```
### 04 - Instalar seeds no banco
Após rodar o comando em seu terminal, certifique-se de que todas as seeds rodaram e os dados iniciais já se encontram no banco:

```
php artisan db:seed --env=testing
```

Após seguir todos os passos, seu ambiente já está configurado para trabalhar com testes desta aplicação.


## Escrevendo testes

### 01 - Gerar arquivo de testes
Para gerar um arquivo de testes, basta rodar o seguinte comando em seu terminal.

**IMPORTANTE**
- Por convenção, **TODOS** os testes devem terminar com o sufixo ```Test```.
- Os tipos de testes disponíveis são ```Unit``` e ```Feature```.

```
php artisan make:test NomeDoTesteTest [ --unit] | [ --feature]
```

### 02 - Criando um teste
Para começar, o nome do teste deve ser definido através de uma anotação do tipo ```Testdox``` onde deve ser claro e indicar a ação de teste, seguindo o exemplo abaixo:
```php
#[TestDox('Checar se é verdadeiro')]
public function test_foo(): void {
    $bar = true;

    $this->assertTrue($bar);
}
```

### 03 - Definir o teste
Para definir um teste, a função a ser testada deve iniciar por convenção com o prefixo ```test_[nome_do_teste]``` e retornar ```void```, seguindo o exemplo abaixo:

```php
#[TestDox('Checar se é verdadeiro')]
public function test_checar_se_eh_verdadeiro(): void {
    $bar = true;

    $this->assertTrue($bar);
}
```

### 04 - Rodar o teste
Para rodar o teste, basta digitar no terminal o comando:
```
php artisan test [--unit] | [--feature]
```

**Notas:** Para um resultado mais detalhado dos testes, certifique-se de usar a flag ```--testdox``` para exibir os testes com os nomes.