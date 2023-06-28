<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Tarefa as ModelsTarefa;

use function PHPUnit\Framework\isJson;

class Tarefa extends BaseController
{
    public function getAll()
    {
        $model = new ModelsTarefa();
        $tarefas = $model->findAll();

        return $this->response->setJSON($tarefas)->setStatusCode(200, 'success');
    }

    public function save()
    {
        $dados = $this->request->getJSON();
        $model = new ModelsTarefa();
        $model->insert($dados);
        $dadoSalvo = $model->getInsertID();
        return $this->response->setJSON($dadoSalvo)->setStatusCode(200, 'success');
    }

    public function edit($id)
    {
        $dados = $this->request->getJSON();
        $model = new ModelsTarefa();
        $model->update($id, $dados);
        return $this->response->setJSON('Dados editados')->setStatusCode(201, 'updated');
    }

    public function deleteAll()
    {
        $model = new ModelsTarefa();
        $model->truncate();
        return $this->response->setJSON('Dados apagados')->setStatusCode(200);
    }

    public function deleteId($id)
    {
        $model = new ModelsTarefa();
        $model->delete($id);
        return $this->response->setJSON('Dado apagado')->setStatusCode(200);
    }
}
