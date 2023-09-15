# DESAFIO LABS
### ATENÇÃO
* Este desafio é destinado à vaga senior em PHP, estou-me aplicando a vaga, tenho uma experiência de 7 anos de php, porém faz 5 anos que não tenho contato com o mesmo, e não tenho experiência o framework laravel, porém vou utilizar o mesmo, por se tratar do que vou enfrentar, caso passe na vaga =)
* Vou tentar responder tudo através da API

### DEPENDÊNCIAS
 - git
 - [docker/docker-componser](https://docs.docker.com/engine/install/)

### START 
Eu segui o start e padrão do laravel com composer, e vou usar ele para poder criar os endpoints e responder os desafios, o código abaixo serve para iniciar o projeto
```bash
# comando funciona em bash 
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```
```bash
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```
- vamos definir um alias para facilitar o nossos comandos
```bash
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```
- inicia servidor
```bash
# modo visual
sail up

# modo background
sail up -d
```
Obs: como definimos o alias quando digitamos `sail up` é o mesmo que  `./vendor/bin/sail up`
- parar servidor
```bash
sail stop
```
# migrations e seeds
```bash
sail artisan migrate:fresh --seed
```
# testes
```bash 
# normal
sail artisan  test

# com cobertura
sail artisan  test --coverage

# com cobertura gerando html
sail artisan  test --coverage-html build/coverage
```
***obs1:*** se houver algum erro ao fazer os testes tente limpar o cache, caso dao der certo tenta da permissao napsta `storage` e tente limpar novamente o cache

```bash
# limpa cache
sail artisan cache:clear
```
***obs2:*** caminho da pasta de log `./storage/logs/`

***obs3:*** tentei configurar o elasticsearh com kibana mas estava dando erro na implementacao, como ia demandar mais tempo, infelizmente optei para deixar sem para entrega

## Acesso
`POST //localhost/api/auth`
```json
{
	"email":"admin@luizalabs.com",
	"password": "#luizaLabs123",
	"device_name": "device-123"
}
```
```bash
curl --request POST --url http://localhost/api/auth --header 'Content-Type: application/json' --data '{ "email":"admin@luizalabs.com", "password": "#luizaLabs123", "device_name": "device-123" }
```


## Endpoints:
| CONTEXTO | METHOD | ENDPONT              | AUTHENTICATED | CURL                                                                                                                                                                                                                                                                                                                                                                                                                                                  |
|----------|--------|----------------------|---------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| WEB      | GET    | `/api/documentation` | NÃO           | `curl --request GET --url 'http://localhost/api/documentation'`                                                                                                                                                                                                                                                                                                                                                                                       |
| WEB      | GET    | `/health`            | NÃO           | `curl --request GET --url 'http://localhost/api/health'`                                                                                                                                                                                                                                                                                                                                                                                              |
| API      | GET    | `/api/health`        | NÃO           | `curl --request GET --url 'http://localhost/api/health'`                                                                                                                                                                                                                                                                                                                                                                                              |
| API      | POST   | `/api/auth`          | NÃO           | `curl --request POST --url http://localhost/api/auth --header 'Content-Type: application/json' --data '{ "email":"admin@luizalabs.com", "password": "#luizaLabs123", "device_name": "device-123" }'`                                                                                                                                                                                                                                                  |
| API      | GET    | `/api/auth/user`     | SIM           | `curl --request GET --url 'http://localhost/api/auth/user' --header 'Authorization: Bearer ---TOKEN---'`                                                                                                                                                                                                                                                                                                                                              |
| API      | DELETE | `/api/auth/logout`   | SIM           | `curl --request DELETE --url 'http://localhost/api/auth/logout' --header 'Authorization: Bearer ---TOKEN---'`                                                                                                                                                                                                                                                                                                                                         |
| API      | GET    | `/api/question`      | SIM           | `curl --request GET --url 'http://localhost/api/question' --header 'Authorization: Bearer ---TOKEN---`                                                                                                                                                                                                                                                                                                                                                |
| API      | POST   | `/api/primo`         | SIM           | `curl --request POST --url http://localhost/api/primo  --header 'Authorization: Bearer ---TOKEN---' --data '{"number": 11}'` ou `curl --request POST --url http://localhost/api/primo  --header 'Authorization: Bearer ---TOKEN---' --data '{"number": [11]}'`                                                                                                                                                                                        |
| API      | POST   | `/api/sort`          | SIM           | `curl --request POST --url http://localhost/api/sort  --header 'Authorization: Bearer ---TOKEN---' --data '{"list": [11,2,5,30,50,7]}'`                                                                                                                                                                                                                                                                                                               |
| API      | POST   | `/api/places`        | SIM           | `curl --request POST --url http://localhost/api/places  --header 'Authorization: Bearer ---TOKEN---' --data '{"name":"teste 1","x": 9,"y": 1}'` ou `curl --request POST --url http://localhost/api/places  --header 'Authorization: Bearer ---TOKEN---' --data '{"name":"teste 2","x": 9,"y": 1,"closed": "22:00","opened": "18:00"}'`                                                                                                                |
| API      | GET    | `/api/places`        | SIM           | `curl --request GET --url 'http://localhost/api/places' --header 'Authorization: ---TOKEN---'` ou `curl --request GET --url 'http://localhost/api/places?hr=19%3A00' --header 'Authorization: ---TOKEN---'` ou `curl --request GET --url 'http://localhost/api/places?x=20&y=10' --header 'Authorization: ---TOKEN---'` ou `curl --request GET --url 'http://localhost/api/places?hr=19%3A00&x=20&y=10&mts=10' --header 'Authorization: ---TOKEN---'` |

## Evidencias
 - Server Rodando
    ![Imagem mostrando um console com o servidor startado](https://github.com/misaku/desafio-labs-sr/blob/main/assets/start-app.png)

 - Testes OK
   ![Imagem mostrando um console com 100% de cobertura de testes](https://github.com/misaku/desafio-labs-sr/blob/main/assets/coverage-console.png)
   ![Imagem mostrando uma pagina com 100% de cobertura de testes](https://github.com/misaku/desafio-labs-sr/blob/main/assets/coverage-web.png)

 - Logger
   ![imagem mostrando o log no console](https://github.com/misaku/desafio-labs-sr/blob/main/assets/logger.png)

 - healthcheck
   ![imagem mostrando o halthcheck na web](https://github.com/misaku/desafio-labs-sr/blob/main/assets/health-web.png)
   ![imagem mostrando o halthcheck no console](https://github.com/misaku/desafio-labs-sr/blob/main/assets/health-console.png)

 - CI [github-actions](https://github.com/misaku/desafio-labs-sr/actions/runs/6202179219/job/16840393044)

## Instruções:
Responda a todas as perguntas com base em seu conhecimento e experiência. Você pode usar qualquer linguagem de programação de sua escolha.
Se você não souber a resposta para uma pergunta, indique isso claramente. Se você precisar fazer suposições, explique-as claramente.
Seja sincero.

###  Seção 1: Fundamentos de Programação
- [X] Escreva um programa que verifique se um número inteiro é um número primo. 
  - `/api/primo`
- [X] Explique a diferença entre herança e composição em programação orientada a objetos. 
  - *Herança é uma ligação forte, composição basicamente é uma instância de uma classe dentro de outra Ex: mamífero é uma classe, vaca tem como herança a classe mamífero já no caso da composição, temos uma classe de motor que é instanciado dentro da classe carro.*

### Seção 2: Estruturas de Dados e Algoritmos
- [X] Implemente o algoritmo de ordenação rápida (quicksort) em sua linguagem de programação escolhida.
  - `/api/sort`
- [X] Descreva as vantagens e desvantagens das árvores binárias de busca em comparação com tabelas de hash.
  - *Árvores binárias podem ser balanceadas ou não balanceadas. Para árvores balanceadas a vantagem é que se torna fácil encontrar um elemento. No entanto, podem exigir um alto consumo de memória dado que conforme vai aumentando o níveis aumenta-se a complexidade e mais recursos são exigidos. Além disso, árvores  balanceadas sempre são ordenadas.  Sobre tabela hash nas minhas pesquisas, é rápida, é  melhor que uma árvore binária, e é ótima em busca de chave valor, porém pode acontecer de ter conflito entre chaves, não é ordenada e perde desempenho sobre iteração, mas consome menos memoria*

### Seção 3: Arquitetura de Software
- [X] Descreva o padrão de arquitetura de software MVC (Model-View-Controller). Como ele ajuda a manter o código limpo e organizado?
  - *Model: geralmente fica a parte de entidades e banco de dados, mas pode ficar regra de negócio também.*
  - *View: tudo q for de front fica nessa parte.*
  - *Controller: camada de intermédio de view e model, em alguns casos fica regra negocio em outros pode ficar transformer da resposta da aplicação ou validação da requisição também.
    o fato de dividir e agrupar os códigos de acordo da sua reponsabilidade, facilita o entendimento e a manutenção do código.*
  - *ex: em um código que tudo está misturado se eu tiver que mudar uma validação e alterar uma query eu tenho que ficar procurando no código, se é um projeto que adota o mvc, por exemplo. eu sei que a query vai estar no model e a validação no controller, acaba facilitando a manutenção sem contar que por se tratar de uma arquitetura conhecida e mais fácil de entendimento para novos integrantes da equipe*

- [X] Quais são os principais princípios do desenvolvimento orientado a testes (TDD - Test-Driven Development)? Como você aplicaria esses princípios em um projeto de software?
    - *O TDD ao mesmo tempo, que é simples é difícil de implementar, nada mais é do que criar os testes antes do código, e ir rodando e fazer o teste passar conforme o que for desenvolvendo, a maior vantagem dele e um código mais preciso e satisfaz os acordos pré-estabelecidos, agora ele é difícil de implementar porque ele exige que o desenvolvedor entenda de fato toda regra de negócio e tudo que precisa fazer, mas na maioria das vezes a gente entende de fato o que precisa fazer e como funciona, desenvolvendo a solução, pois aparece duvidas e visões diferentes, por esse motivo fazer o teste depois parece ser mais fácil, mas na realidade se o desenvolvedor tiver certeza de toda regra e de como vai codar, o tdd ajuda muito evitar erros. Sobre a forma de aplicar seria simples, entender as regras de negócio, definir entradas e saídas, transcrever esses testes validando o que espera, e depois ir codando e confirmando se bate com os testes pre estabelecidos.*

### Seção 4: Experiência Profissional
- [X] Liste os três projetos de software mais complexos em que você trabalhou e descreva seu papel e contribuições específicas em cada um.
  - *inventario: ajudei encontrar problemas na implantação, implantar, redesenhar o fluxo de trabalho e traçar planos para melhoria do processo e repassar o conhecimento para os integrantes do time, coloquei todos detalhes desse projeto em outra questão =), mas em resumo evitamos uma multa para o magazine, e agilizamos um processo que levava dias para apenas um dia aproximadamente*
  - *Rodney: reescrevi o código dele para uma linguagem que o time tem mais domínio, mudei a experiência de usuário do aplicativo trazendo muita felicidade para os usuários do app, houve muitos elogios depois da mudança, e nesse mesmo ano o Frederico Trajano comentou no workplace que o cds elogiou muito o trabalho do nosso time, e deu parabéns para nós =).*
  - *Implantação da Arquitetura de microfrontends: são vários projetos que utilizamos ela, projetos que trouxe bastante impacto para area de negócio, mas vou focar no ganho técnico de se utilizar ela. Essa arquitetura em si foi preciso de muitos estudo, no início falhamos, mas depois escolhemos outra abordagem, com ela da autonomia de qualquer time trabalhar sem depender de outro para o frontend, e sem atrapalhar em codigo de outra squad, podendo subir codigo legado com novo, e com framworks diferentes, aumentado a escalabilidade do projeto.
a minha participação foi ajudar a desenvolver um padrão para podermos usar no labs, tem sido muito apoiada, e aparentemente tem grande potencial de que o labs inteiro venha usar o nosso padrão.*

### Seção 5: Resolução de Problemas
- [X] Você foi designado para otimizar o desempenho de um aplicativo da web que está enfrentando problemas de carregamento lento. Descreva o processo que você seguiria para identificar e resolver esses problemas.
  Como você lidaria com um bug crítico em produção que está afetando os clientes? Descreva seu processo de investigação e resolução.
    - *se for o front, tentaria ver se é algo relacionado com imagens ou se tem relação com ordem de carregamento da tela exemplo java script e css ou se tem algum tipo de evento travando a aplicacao ou carregamento desnecessários, uma vez identificado fica mais fácil resolver, para imagens seria só tratar elas para deixar mais leves, para ordem de carregamento os css estaria primeiro e os scripts após tudo q for estrutura html, para evento seria deixar somente ativo listeners que estão sendo utilizados e deligar quando não estiver, e para carregamento desnecessário poderia colocar um lazy que meio que so carrega o código quando for preciso de fato usar ele. E por último cachear algumas coisas.*
    - *para apis e bffs, tentaria entender se é algo de recurso, se é questão de melhoria de banco, ou se é interferência de outra aplicação. Se for recurso bastaria escalonar, a respeito de banco tentaria melhorar query e adicionar índices melhores ao banco, a parte de interferência de outra aplicação começa complicar, provavelmente poderia adotar uma fila, e processar o q puder processar depois, em outro momento.*
    - *tanto front, api, bff, poderíamos ver também se tentarmos cachear algumas coisas ajudaria*
    - *sobre bug em produção, prioridade máxima, mas primeiro analisaria o impacto e como poderíamos resolver pelo menos de uma forma mais superficial inicialmente para na hora de alertar no canal de produção não colocar nenhum pânico ou preocupação desnecessária. Acredito q alertar de uma forma rápida que estamos atuando em um problema, porém com informações mais precisa, dá mais segurança do que alertar sem nenhuma informação ou plano de atuação, mas a casos e casos. Porem eu tentaria fazer uma pre analise rápida antes.*


### Seção 6: Comunicação e Colaboração
- [X] Descreva uma situação em que você teve que colaborar efetivamente com outros membros da equipe para resolver um desafio técnico. Como você lidou com essa situação? 
  - *A gente precisava entregar o inventário pois o magazine tinha prazo para fazer o mesmo podendo ser multado caso não cumprisse, nessa época o sênior do time saiu do magazine, e meu squadleader Ricardo Cardoso, perguntou se podia contar comigo para ajudar nessa entrega, como gosto de um bom desafio, topei direto!  E foi um belo desafio, era 6 projetos,  um back em node, um bff em node, dois consumir em java, um front  em react e um app em react native, alguns desse projetos eu não estava familiarizado, e essa iniciativa em si eu não estava participando, então precisei  ler todo código para entender o que estava feito e como estava funcionando ao mesmo tempo que tinha q fazer reuniões com a área de negócio, e com alguns tecleads para entender o que era possível também, nessa época o Danilo França, a Thais Rigante e o Cairo do CD me ajudou muito com as dúvidas, tive que tomar decisões difíceis algumas por exemplo optei por corrigir sozinho ao invés de delegar pelo fato de o tempo de explicar o q precisava fazer e onde era o mesmo que eu tinha para corrigir o problema, no onboarding do projeto iniciamos por um cd menor com aproximadamente 10mil produtos, houve muitos problemas operacionais, e muitos problemas de performance de alguns projetos nossos antigos, houve momento que precisei rodar local batendo em produção para melhor entendimento , foi preciso algumas reuniões com TLs e DBA, além de algumas analises, fizemos as alterações necessárias cabíveis no momento, reunimos melhorias, identifiquei um possível problema caso houvesse o mesmo problema operacional que tivemos nesse cd menor, no nosso cd maior seria inviável a correção pois demoraria pelo menos 2 dias comparando com o a correção no cd menor, tracei um plano e reorganizei a estrutura do processo, para poder evitar esse problema, e dividi em pequenos desafios até chegar no cd maior no caso cd300, repassei tudo para o time, fiz fluxogramas e certifiquei que o pessoal não tinha nenhuma duvida pois eu iria entrar de férias! Ouve repetição dos problemas previsto, e como a equipe foi seguindo o plano, quando chegaram no cd final, ouve de fato o problema que me preocupava, nessa época eu já estava em outra squad, e me solicitaram para entender o que estava acontecendo, como era o que já tinha previsto, eu meio q confirmei se tinha conseguido implantar todo plano para esse processo final, graças a Deus tinha conseguido sim então foi fácil a resolução ao invés de 2 dias foi feito em menos 5 minutos aproximadamente.
    No mesmo tempo que eu estava ajudando e entendendo o inventário, o pessoal do magazine  estava implantando uma impressora térmica nova em um cd ne novos coletores estavam vindo, precisei fazer uma reunião com um cd pra ver como poderia corrigir a parte da impressão, juntamente com outros times, e teve várias empresas de  coletores me ligando pedindo para eu ajudar validar os coletores para o magazine, foi me enviado coletores para eu encontrar problema e acabei conseguindo resolver no app nosso, e conciliar isso com o processo do inventario.*
### Seção 7: Perguntas Gerais
- [X] Quais são suas linguagens de programação e tecnologias favoritas? Por quê?
  - *Não sou preso a linguagem, porém, atualmente gosto muito JavaScript/TypeScript, react, react native, electron, e nodejs, gosto também de c, php e java. php para mim é o pai da web, foi onde comecei é uma linguagem da pra trabalhar de diversas formas estruturadas a orientado a objeto, e existe muitos frameworks para ajudar a comunidade, com o JS/TS eu consigo trabalhar com qualquer plataforma e serviços, desde backend a frontend, mobile a desktop, react/react native com um framework e basicamente um código consigo fazer o front, mobile e desktop usando electron e por último não menos importante, assim como o php e o js o java tem um bom domínio do mercado, e pode desenvolver para diversas plataformas*
- [X] O que você faz para se manter atualizado com as tendências e avanços em tecnologia e desenvolvimento de software?
  - *Acompanho canais, faço cursos, leio documentações, atualmente estou fazendo um curso pelo single-spa para ter maio domínio dele, estou-me atualizando pela rocketseat na parte de front mobile, pela fullcycle na parte de beckend e devops e iniciei uma faculdade de ciências de dados*

### Desafio Final

A DigitalMaps é uma empresa especializada na produção de receptores GPS. A organização está empenhada em lançar um dispositivo que promete auxiliar pessoas
na “localização de pontos de interesse”, e você será o responsável pela criação da
solução!
Você deve desenvolver os serviços que fornecerão toda a inteligência para
atender ao dispositivo.

#### Bora codar?

Você deverá criar um serviço que permita a inserção de novas localizações de ponto
de interesse. Exemplo:
Posto de combustível, restaurante, parque ecológico, praça etc.
O serviço deve, além disso, permitir a inserção das coordenadas geográficas
referentes a este ponto de interesse (X e Y) e horário de funcionamento (abertura e
fechamento).
* Obs1: coordenadas devem ser números inteiros positivos.
* Obs2: estas informações devem ser armazenadas em uma base dados
qualquer.
* Obs3: para pontos como a praça, não deve haver horário de funcionamento.
O serviço deve permitir a listagem de todos os pontos de interesse cadastrados.
O serviço deve permitir a listagem de todos os pontos de interesse por proximidade,
ou seja, fornecendo as coordenadas X e Y, a distância em metros e hora atual.
#### Exemplo:

##### Dados:
Restaurante (x=27, y=12, opened=12:00, closed=18:00)
Posto de combustível (x=31, y=18, opened=08:00, closed=18:00)
Praça (x=15, y=12)

##### Entrada:
x=20, y=10, mts=10, hr=19:00

##### Saída:
Restaurante, fechado
Praça, aberto
Algumas considerações:

1. Use PHP no teste
2. As APIs deverão seguir o modelo RESTFul com formato JSON
3. Faça testes unitários, suite de testes bem organizados. (Dica. Dê uma
   a atenção especial a esse item!)
4. Use git/bitbucket e tente fazer commits pequenos e bem descritos.
5. Faça pelo menos um README explicando como fazer o setup do seu projeto, uma
   explicação da solução proposta, o mínimo de documentação para que outro
   desenvolvedor entenda seu código.
6. Siga o que considera boas práticas de programação, coisas que um bom
   desenvolvedor olhe no seu código e não ache "feio" ou "ruim". Procure manter a
   simplicidade do código.
7. Após concluir o teste, suba em um repositório privado e mande-nos o link.
   Qualquer dúvida estamos à disposição! :D
   Boa Sorte!
