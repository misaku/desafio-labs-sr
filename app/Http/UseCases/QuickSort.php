<?php

namespace App\Http\UseCases;

class QuickSort
{
    protected array $originalList;

    protected array $sortedList;

    public function __construct(array $list)
    {
        $this->originalList = $list;
    }

    public function expose()
    {
        return get_object_vars($this);
    }

    public function execute(): QuickSort
    {
        $this->sortedList = $this->sort($this->originalList);

        return $this;
    }

    protected function sort(array $list)
    {

        $sizeList = count($list);

        // verifico se é uma lista de um elemento ou menor caso for retornael direto pois nao precisa ordenar
        if ($sizeList <= 1) {
            return $list;
        }

        // pego o primeiro item da lista para poder usar de referencia
        $baseItem = $list[0];

        $lessListBase = [];
        $moreListBase = [];

        // separo os items maiores e menoresque referencia
        for ($index = 1; $index < $sizeList; $index++) {
            $currentItem = $list[$index];
            if ($currentItem < $baseItem) {
                $lessListBase[] = $currentItem;
            } else {
                $moreListBase[] = $currentItem;
            }
        }

        // uso a recursividade para repetir dodo processo e ordenar similar umarvore binária
        $lessListBaseSorted = $this->sort($lessListBase);
        $moreListBaseSorted = $this->sort($moreListBase);

        return [...$lessListBaseSorted, $baseItem, ...$moreListBaseSorted];
        // combino as ordenacoes
        //return array_merge(, [], );

    }
}
