<?php

namespace App\Services;

class CNPJService {
    public static function ObterDadosEmpresa(string $cnpj) {
        $dados = APIClienteService::get("https://comercial.cnpj.ws/cnpj/$cnpj?token=" . env('CNPJ_API_KEY'));

        $empresa = [
            "razaoSocial" => $dados["razao_social"],
            "cep" => $dados["estabelecimento"]["cep"],
            "logadouro" =>  $dados["estabelecimento"]["tipo_logradouro"] . " " . 
                            $dados["estabelecimento"]["logradouro"],
            "numero" => $dados["estabelecimento"]["numero"],
            "bairro" => $dados["estabelecimento"]["bairro"],
            "cidade" => $dados["estabelecimento"]["cidade"]["nome"],
            "estado" => $dados["estabelecimento"]["estado"]["sigla"],
        ];

        return $empresa;
    }
}