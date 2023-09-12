# DESAFIO LABS
### ATENÇÃO
* Este desafio é destinado a vaga senior em PHP, estou me aplicando a vaga, tenho uma experiencia de 7 ano de php porem faz 5 anos que nao tenho contato com o mesmo, e nao tenho experiencia o framwork laravel, porem vou utilizar o mesmo po se tratar do quevou enfrentar caso passar na vag =)
* Vou tentar responder tudo através da API
### START 
Eu segui o starte padrão do laravel com composer, e vou usarele para poder criar os endpoints e responder os desafios, o código abaixo serve para iniciar o projeto
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

## Instruções:
Responda a todas as perguntas com base em seu conhecimento e experiência. Você pode usar qualquer linguagem de programação de sua escolha.
Se você não souber a resposta para uma pergunta, indique isso claramente. Se você precisar fazer suposições, explique-as claramente.
Seja sincero.

###  Seção 1: Fundamentos de Programação
-[X] Escreva um programa que verifique se um número inteiro é um número primo. 
-[ ] Explique a diferença entre herança e composição em programação orientada a objetos. 

### Seção 2: Estruturas de Dados e Algoritmos
-[ ] Implemente o algoritmo de ordenação rápida (quicksort) em sua linguagem de programação escolhida.
-[ ] Descreva as vantagens e desvantagens das árvores binárias de busca em comparação com tabelas de hash.

### Seção 3: Arquitetura de Software
-[ ] Descreva o padrão de arquitetura de software MVC (Model-View-Controller). Como ele ajuda a manter o código limpo e organizado?
-[ ] Quais são os principais princípios do desenvolvimento orientado a testes (TDD - Test-Driven Development)? Como você aplicaria esses princípios em um projeto de software?

### Seção 4: Experiência Profissional
Liste os três projetos de software mais complexos em que você trabalhou e descreva seu papel e contribuições específicas em cada um.

### Seção 5: Resolução de Problemas
-[ ] Você foi designado para otimizar o desempenho de um aplicativo da web que está enfrentando problemas de carregamento lento. 
  -[ ] Descreva o processo que você seguiria para identificar e resolver esses problemas.
  Como você lidaria com um bug crítico em produção que está afetando os clientes? 
  -[ ] Descreva seu processo de investigação e resolução.

### Seção 6: Comunicação e Colaboração
-[ ] Descreva uma situação em que você teve que colaborar efetivamente com outros membros da equipe para resolver um desafio técnico. Como você lidou com essa situação? 

### Seção 7: Perguntas Gerais
-[X] Quais são suas linguagens de programação e tecnologias favoritas? Por quê?
-[X] O que você faz para se manter atualizado com as tendências e avanços em tecnologia e desenvolvimento de software?

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
O serviço deve além disso, permitir a inserção das coordenadas geográficas
referentes à este ponto de interesse (X e Y) e horário de funcionamento (abertura e
fechamento).
* Obs1: Coordenadas devem ser números inteiros positivos.
* Obs2: Estas informações devem ser armazenadas em uma base dados
qualquer.
* Obs3: Para pontos como a praça, não deve haver horário de funcionamento.
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
