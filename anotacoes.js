

// Para aux. no git hooks, para que fique salvo no git os commits padroes do projeto, iremos instalar um pacote JS:
// --husky git hooks https://typicode.github.io/husky/


// LARAVEL PINT
// formatador de codigo, mais bonito


//LARASTAN
// https://github.com/larastan/larastan
// foca em encontrar erros no seu código .Ele captura classes inteiras de bugs antes mesmo de você escrever testes para o código


//Pre commit
// git hook pre-commit, toda vez que fizer o commit será rodado o LARASTAN e o PINT formatando e adicionando no commit


//Git Actions
// A cada pull-request que for aberto tera que rodar os testes

//DebugBar
// https://github.com/barryvdh/laravel-debugbar

//Mostrar no navegador varias informaçoes sobre o projeto

//TDD
// Sao divididos entre testes unitarios UNIT e testes de FEATURE que contempla tudo
// Iniciando com os testes em desenvolvimento é interessante apagar a pasta Unit e excluir um codigo do arquivo phpunit.xml
// Os testes serao pelo PEST. php ./vendor/bin/pest --help
// adicionar o banco de dados sqlite dentro do phpunit.xml para os testes serem mais rapidos
//Criar um arquivo dentro de Feature para testes, CreateAQuestionTest.php
// php artisan test --filter=Create

//Criando uma Factorie para adicionar dados falsos no BD para manipulação
// php artisan make:factory QuestionFactory
//php artisan migrate:fresh --seed  //Ele cria as seeds no banco de dados
