<?php

namespace Tropa\Model;

class Setor
{
    /**
     * @var integer
     */
    public $codigo;

    /**
     * @var string
     */
    public $nome;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        foreach ($data as $attribute => $value) {
            $this->$attribute = $value;
        }
    }
}