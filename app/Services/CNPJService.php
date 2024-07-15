<?php

namespace App\Services;

class CNPJService {
    public static function ObterDadosEmpresa(string $cnpj) {
        $dados = APIClienteService::get("https://comercial.cnpj.ws/cnpj/$cnpj?token=" . env('CNPJ_API_KEY'));

        $telefone = "";

        if(isset($dados["estabelecimento"]["ddd1"]) && isset($dados["estabelecimento"]["telefone1"])) $telefone = $dados["estabelecimento"]["ddd1"] . $dados["estabelecimento"]["telefone1"];

        $empresa = [
            "razaoSocial" => $dados["razao_social"],
            "email" => $dados["estabelecimento"]["email"],
            "telefone" => $telefone,
            "cep" => $dados["estabelecimento"]["cep"],
            "logradouro" =>  $dados["estabelecimento"]["tipo_logradouro"] . " " . 
                            $dados["estabelecimento"]["logradouro"],
            "numero" => $dados["estabelecimento"]["numero"],
            "bairro" => $dados["estabelecimento"]["bairro"],
            "cidade" => $dados["estabelecimento"]["cidade"]["nome"],
            "uf" => $dados["estabelecimento"]["estado"]["sigla"],
        ];

        return $empresa;
    }
}