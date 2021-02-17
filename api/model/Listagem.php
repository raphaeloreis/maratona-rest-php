<?php
include_once 'conexao/Conexao.php';

class Listagem extends Conexao
{

    public function geral()
    {
        $sql = "SELECT * FROM prova";
        $consulta = Conexao::prepare($sql);
        $consulta->execute();
        $provas = $consulta->fetchAll();
        foreach ($provas as $prova) {

            $sql_resultado_prova = "SELECT resultado.id_prova, prova.tipo, resultado.id_corredor,
                TIMESTAMPDIFF(YEAR, corredor.nascimento, CURDATE()) AS idade, corredor.nome,ROW_NUMBER() OVER() as posicao
                FROM prova, corredor, resultado
                WHERE resultado.id_corredor = corredor.id AND resultado.id_prova = prova.id
                AND prova.id = $prova->id ORDER BY TIMEDIFF(resultado.hora_conclusao, resultado.hora_inicio) ASC";
            $consulta = Conexao::prepare($sql_resultado_prova);
            $consulta->execute();
            $listagem_geral[$prova->tipo] = $consulta->fetchAll();
        }
        return $listagem_geral;
    }

    public function idade()
    {
        $sql = "SELECT * FROM prova";
        $consulta = Conexao::prepare($sql);
        $consulta->execute();
        $provas = $consulta->fetchAll();
        foreach ($provas as $prova) {

            $sql_resultado_prova = "SELECT resultado.id_prova, prova.tipo, resultado.id_corredor,
                TIMESTAMPDIFF(YEAR, corredor.nascimento, CURDATE()) AS idade, corredor.nome
                FROM prova, corredor, resultado
                WHERE resultado.id_corredor = corredor.id AND resultado.id_prova = prova.id
                AND prova.id = $prova->id ORDER BY TIMEDIFF(resultado.hora_conclusao, resultado.hora_inicio) ASC";
            $consulta = Conexao::prepare($sql_resultado_prova);
            $consulta->execute();
            $registros = $consulta->fetchAll();
            $posicao = array();
            foreach ($registros as $registro) {

                if ($registro->idade > 55) {
                    $faixa_etaria = 'Acima de 55 anos';
                } elseif ($registro->idade > 45) {
                    $faixa_etaria = 'Entre 46 e 55 anos';
                } elseif ($registro->idade > 35) {
                    $faixa_etaria = 'Entre 36 e 45 anos';
                } elseif ($registro->idade > 25) {
                    $faixa_etaria = 'Entre 26 e 35 anos';
                } else {
                    $faixa_etaria = 'Entre 18 e 25 anos';
                }

                @$posicao[$prova->tipo][$faixa_etaria] += 1;
                $registro->posicao = @$posicao[$prova->tipo][$faixa_etaria];

                $listagem_idade[$prova->tipo][$faixa_etaria][] = $registro;
            }
        }
        return $listagem_idade;
    }

}
