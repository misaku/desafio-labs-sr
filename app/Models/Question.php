<?php

namespace App\Models;

use App\Http\UseCases\Primo as PrimoUseCase;

class QuestionItem
{
    private string $question;
    private string $response;

    /**
     * @param string $question
     * @param string $response
     */
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

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = [
            new QuestionItem('Explique a diferença entre herança e composição em programação orientada a objetos', ''),
            new QuestionItem('Descreva as vantagens e desvantagens das árvores binárias de busca em comparação com tabelas de hash.', ''),
            new QuestionItem('Descreva o padrão de arquitetura de software MVC (Model-View-Controller). Como ele ajuda a manter o código limpo e organizado?', ''),
            new QuestionItem('Quais são os principais princípios do desenvolvimento orientado a testes (TDD - Test-Driven Development)? Como você aplicaria esses princípios em um projeto de software?', ''),
            new QuestionItem('Você foi designado para otimizar o desempenho de um aplicativo da web que está enfrentando problemas de carregamento lento. Descreva o processo que você seguiria para identificar e resolver esses problemas. Descreva seu processo de investigação e resolução.', ''),
            new QuestionItem('Descreva uma situação em que você teve que colaborar efetivamente com outros membros da equipe para resolver um desafio técnico. Como você lidou com essa situação?', ''),
            new QuestionItem('Quais são suas linguagens de programação e tecnologias favoritas? Por quê?',
                'Não sou preso a linguagem, porém, atualmente gosto muito JavaScript/TypeScript, react, react native, electron, e nodejs, gosto também de c, php e java.  php pra mim é o pai da web, foi onde comecei é uma linguagem da pra trabalhar de diversas formas estruturadas a orientado a objeto, e existe muitos framework pra ajudar a comunidade, com o JS/TS eu consigo trabalhar com qualquer plataforma e serviços, desde backend a frontend, mobile a desktop, react/react native com um framework e basicamente um código consigo fazer o front, mobile e desktop usando electron e por último não menos importante, assim como o php e o js o java tem um bom domínio do mercado, e pode desenvolver pra diversas plataformas'),
            new QuestionItem('O que você faz para se manter atualizado com as tendências e avanços em tecnologia e desenvolvimento de software?', 'Acompanho canais, faço cursos, leio documentações, atualmente estou fazendo um curso pelo single-spa para ter maio domínio dele, estou me atualizando pela rocketseat na parte de front mobile, pela fullcycle na parte de beckend e devops e iniciei uma faculdade de ciências de dados'),
        ];
    }


    public function isPrime(int|array $number)
    {
        $response = array();
        if (is_array($number)) {
            foreach ($number as $value) {
                $response[] = $this->buildResponse($value)->expose();
            }
        } else {
            $response[] = $this->buildResponse($number)->expose();
        }

        return $response;
    }

}
