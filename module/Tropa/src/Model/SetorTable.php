<?php

namespace Tropa\Model;

use Laminas\Db\TableGateway\TableGatewayInterface;
use Laminas\Db\Adapter\Driver\ResultInterface;

class SetorTable
{
    /**
     *
     * @var TableGatewayInterface
     */
    private $tableGateway;

    /**
     *
     * @var string
     */
    private $keyName = 'codigo';

    /**
     *
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     *
     * @return ResultInterface
     */
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        
        return $resultSet;
    }

    /**
     *
     * @param string $keyValue
     * @return Setor
     */
    public function getModel($keyValue)
    {
        $rowset = $this->tableGateway->select([$this->keyName => $keyValue]);

        if ($rowset->count() > 0) {
            $row = $rowset->current();
        } else {
            $row = new Setor();
        }

        return $row;
    }

    /**
     *
     * @param Setor $setor
     * @return void
     */
    public function saveModel(Setor $setor)
    {
        $data = [
            'nome' => $setor->nome
        ];
        $codigo = $setor->codigo;

        if (empty($this->getModel($codigo)->codigo)) {
            $data['codigo'] = $codigo;
            $this->tableGateway->insert($data);
        } else {
            $this->tableGateway->update($data, [
                'codigo' => $codigo
            ]);
        }
    }

    /**
     *
     * @param mixed $keyValue
     * @return void
     */
    public function deleteModel($keyValue)
    {
        $this->tableGateway->delete([
            $this->keyName => $keyValue
        ]);
    }
}
