<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

class Repository {
    protected Model $model;

    public function salvar(Model $entidade) : Model {
        $entidade->save();
        return $entidade;
    }

    public function deletar(Model $entidade) : bool {
        return $entidade->delete();
    }

    public function ObterPorGUID(string $guid) : Model {
        return $this->model::where('guid', $guid)->first();
    }
}