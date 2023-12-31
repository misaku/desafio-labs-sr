<?php

namespace App\Models;

class QuestionItem
{
    private string $question;

    private string $response;

    public function __construct(string $question, string $response)
    {
        $this->question = $question;
        $this->response = $response;
    }

    public function expose()
    {
        return get_object_vars($this);
    }
}

class Question
{
    private array $data;

    public function __construct()
    {
        $this->data = [
            new QuestionItem('Explique a diferença entre herança e composição em programação orientada a objetos', 'Herança é uma ligação forte, composição basicamente é uma instancia de uma classe dentro de outra Ex: mamífero é uma classe, vaca tem como herança a classe mamífero já no caso da composição, temo uma classe de motor que é instanciado dentro da classe carro.'),
            new QuestionItem('Descreva as vantagens e desvantagens das árvores binárias de busca em comparação com tabelas de hash.', 'Arvores binarias pode ser balanceada ou não balanceada, vantagem q é fácil de encontrar um elemento desde que seja balanceada, mas pode exigir um consumo de memoria dado q conforme vai aumentando o nível dela e a complexidade mais recursos vai exigir, e ela sendo balanceada ela esta sempre ordenada.  Sobre tabela hash não manjo muito mas dei uma pesquisada, parece que e muito rápida, aparentemente parece ser melhor q uma arvore binária, e é ótima em busca de chave valor, porem pode acontecer de ter conflito entre chaves, não é ordenada e perde desempenho sobre iteração mas consome menos memoria'),
            new QuestionItem('Descreva o padrão de arquitetura de software MVC (Model-View-Controller). Como ele ajuda a manter o código limpo e organizado?', 'Model: geralmente fica a parte de entidades e banco de dados, mas pode ficar regra de negocio também.
View: tudo q for de front fica nessa parte.
Controller: camada de intermédio de view e model, em alguns casos fica regra negocio em outros pode ficar transformer da respostas da aplicação ou validação da requisição também.
o fato de dividir e agrupar os códigos de  acordo do sua reponsabilidade, facilita o entendimento e a manutenção do código,  ex: em um código que tudo está misturado se eu tiver q mudar uma validação e alterar uma query eu tenho q ficar procurando no código, se é um projeto que adota o mvc por exemplo.. eu sei q a query vai estar no model e a validação no controller, acaba facilitando a manutenção sem contar que por se tratar de uma arquitetura conhecida e mais fácil de entendimento para novos integrantes da equipe
'),
            new QuestionItem('Quais são os principais princípios do desenvolvimento orientado a testes (TDD - Test-Driven Development)? Como você aplicaria esses princípios em um projeto de software?', 'O TDD ao mesmo tempo q é simples é difícil de implementar, nada mais é do que  criar os testes antes do código,  e ir rodando e fazer o teste passar de acordo com o que for desenvolvendo, a maior vantagem dele e um código mais preciso e que satisfaz os acordos pré estabelecidos, agora ele é difícil de implementar porque ele exige que o desenvolvedor entenda de fato toda regra de negocio e tudo que precisa fazer, mas na maioria das vezes a gente entende de fato o que precisa fazer e como funciona, desenvolvendo a solução, pois aparece duvidas e visões diferentes, por esse motivo fazer o teste depois parece ser mais fácil, mas na realidade se o desenvolvedor tiver plena certeza de toda regra e de como vai codar, o tdd ajuda muito evitar erros. Sobre a forma de aplicar seria simples, entender as regras de negócio,  definir entradas e saídas, transcrever esses testes validando o que espera, e depois ir codando e confirmando se bate com os testes pre estabelecidos.'),
            new QuestionItem('Liste os três projetos de software mais complexos em que você trabalhou e descreva seu papel e contribuições específicas em cada um.', 'inventario: ajudei encontrar problemas na implantação, implantar, redesenhar o fluxo de trabalho e traçar planos para melhoria do processo e repassar o conhecimento para os integrantes do time, coloquei todos detalhes desse projeto em uma outra questão =)
Rodney: reescrevi o código dele para uma linguagem que o time tem mais domínio, mudei a experiencia de usuário do aplicativo trazendo muita felicidade para os usuários do app, houve muitos elogios depois da mudança, e nesse mesmo ano o Frederico Trajano comentou no workplace que o cds elogiou muito o trabalho do nosso time, e deu parabéns para nós =).

Implantação da Arquitetura de micro-frontends: são vários projetos que utilizamos ela, mas essa arquitetura em si foi preciso de muitos estudo, o inicio falhamos, mas depois escolhemos outra abordagem, com ela da autonomia de qualquer time trabalhar sem depender de outro para o frontend, e sem atrapalhar em codigo de outra squad, podendo subir codigo legado junto com novo, e com framworks diferentes, aumentado a escalabilidade do projeto.
minha participação foi ajudar a desenvolver um padrão para podermos usar no labs, tem sido muito apoiada, e aparentemente tem grande potencial de que o labs inteiro venha usar nosso padrão.
'),
            new QuestionItem('Você foi designado para otimizar o desempenho de um aplicativo da web que está enfrentando problemas de carregamento lento. Descreva o processo que você seguiria para identificar e resolver esses problemas. Descreva seu processo de investigação e resolução.', 'se for o front, tentaria ver se é algo relacionado com imagens ou se tem relação com ordem de carregamento da tela exemplo java script e css ou se tem algum tipo de evento travando a aplicacao ou carregamento desnecessários, uma vez identificado fica mais fácil resolver, para imagens seria só tratar elas para deixar mais leves, para ordem de carregamento os css estaria primeiro e os scripts após tudo q for estrutura html, para evento seria deixar somente ativo listeners que estão sendo utilizados e deligar quando não estiver, e para carregamento desnecessário poderia colocar um lazy que meio q so carrega o código quando for preciso de fato usar ele. E por último cachear algumas coisas.

para apis e bffs, tentaria entender se é algo de recurso, se é questão de melhoria de banco, ou se é interferência de outra aplicação. Se for recurso bastaria escalonar, a respeito de banco tentaria melhorar query e adicionar índices melhores ao banco, a parte de interferência de outra aplicação começa complicar, provavelmente poderia adotar uma fila, e processar o q puder processar depois, em outro momento.

tanto front, api, bff, poderíamos ver também se tentarmos cachear algumas coisas ajudaria

sobre bug em produção, prioridade máxima, mas primeiro analisaria o impacto e como poderíamos resolver pelo menos de uma forma mais superficial inicialmente para na hora de alertar no canal de produção não colocar nenhum pânico ou preocupação desnecessária. Acredito q alertar de uma forma rápida que estamos atuando em um problema, porém com informações mais precisa, dá mais segurança do que alertar sem nenhuma informação ou plano de atuação, mas a casos e casos. Porem eu tentaria fazer uma pre analise rápida antes.
'),
            new QuestionItem('Descreva uma situação em que você teve que colaborar efetivamente com outros membros da equipe para resolver um desafio técnico. Como você lidou com essa situação?', 'A gente precisava entregar o inventário pois o magazine tinha prazo para fazer o mesmo podendo ser multado caso não cumprisse, nessa época o sênior do time saiu do magazine, e meu squadleader Ricardo Cardoso, perguntou se podia contar comigo para ajudar nessa entrega, como gosto de um bom desafio, topei direto!  E foi um belo desafio, era 6 projetos,  um back em node, um bff em node, dois consumir em java, um front  em react e um app em react native, alguns desse projetos eu não estava familiarizado, e essa iniciativa em si eu não estava participando, então precisei  ler todo código para entender o que estava feito e como estava funcionando ao mesmo tempo que tinha q fazer reuniões com a área de negócio, e com alguns tecleads para entender o que era possível também, nessa época o Danilo França, a Thais Rigante e o Cairo do CD me ajudou muito com as dúvidas, tive que tomar decisões difíceis algumas por exemplo optei por corrigir sozinho ao invés de delegar pelo fato de o tempo de explicar o q precisava fazer e onde era o mesmo que eu tinha para corrigir o problema, no onboarding do projeto iniciamos por um cd menor com aproximadamente 10mil produtos, houve muitos problemas operacionais, e muitos problemas de performance de alguns projetos nossos antigos, houve momento que precisei rodar local batendo em produção para melhor entendimento , foi preciso algumas reuniões com TLs e DBA, além de algumas analises, fizemos as alterações necessárias cabíveis no momento, reunimos melhorias, identifiquei um possível problema caso houvesse o mesmo problema operacional que tivemos nesse cd menor, no nosso cd maior seria inviável a correção pois demoraria pelo menos 2 dias comparando com o a correção no cd menor, tracei um plano e reorganizei a estrutura do processo, para poder evitar esse problema, e dividi em pequenos desafios até chegar no cd maior no caso cd300, repassei tudo para o time, fiz fluxogramas e certifiquei que o pessoal não tinha nenhuma duvida pois eu iria entrar de férias! Ouve repetição dos problemas previsto, e como a equipe foi seguindo o plano, quando chegaram no cd final, ouve de fato o problema que me preocupava, nessa época eu já estava em outra squad, e me solicitaram para entender o que estava acontecendo, como era o que já tinha previsto, eu meio q confirmei se tinha conseguido implantar todo plano para esse processo final, graças a Deus tinha conseguido sim então foi fácil a resolução ao invés de 2 dias foi feito em menos 5 minutos aproximadamente.
No mesmo tempo que eu estava ajudando e entendendo o inventário, o pessoal do magazine  estava implantando uma impressora térmica nova em um cd ne novos coletores estavam vindo, precisei fazer uma reunião com um cd pra ver como poderia corrigir a parte da impressão, juntamente com outros times, e teve várias empresas de  coletores me ligando pedindo para eu ajudar validar os coletores para o magazine, foi me enviado coletores para eu encontrar problema e acabei conseguindo resolver no app nosso, e conciliar isso com o processo do inventario.
'),
            new QuestionItem('Quais são suas linguagens de programação e tecnologias favoritas? Por quê?',
                'Não sou preso a linguagem, porém, atualmente gosto muito JavaScript/TypeScript, react, react native, electron, e nodejs, gosto também de c, php e java.  php pra mim é o pai da web, foi onde comecei é uma linguagem da pra trabalhar de diversas formas estruturadas a orientado a objeto, e existe muitos framework pra ajudar a comunidade, com o JS/TS eu consigo trabalhar com qualquer plataforma e serviços, desde backend a frontend, mobile a desktop, react/react native com um framework e basicamente um código consigo fazer o front, mobile e desktop usando electron e por último não menos importante, assim como o php e o js o java tem um bom domínio do mercado, e pode desenvolver pra diversas plataformas'),
            new QuestionItem('O que você faz para se manter atualizado com as tendências e avanços em tecnologia e desenvolvimento de software?', 'Acompanho canais, faço cursos, leio documentações, atualmente estou fazendo um curso pelo single-spa para ter maio domínio dele, estou me atualizando pela rocketseat na parte de front mobile, pela fullcycle na parte de beckend e devops e iniciei uma faculdade de ciências de dados'),
        ];
    }

    public function index()
    {
        $response = [];
        foreach ($this->data as $valor) {
            $response[] = $valor->expose();
        }

        return $response;
    }
}
