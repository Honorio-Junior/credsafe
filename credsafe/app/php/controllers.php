<?php

require 'models.php';

class ControllerClientes
{

    public function validaCliente($cliente){

        $ModelClientes = new ModelClientes();
        $clienteEncontrado = $ModelClientes->getByEmail($cliente['email']);

        if(!empty($clienteEncontrado)){

            if(password_verify($cliente['password'], $clienteEncontrado[0]['senha'])){
                return $clienteEncontrado;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}

class ControllerPerfis
{

    public function getFuncoes($idCliente)
    {

        $ModelPerfis = new ModelPerfis();

        $funcoes = $ModelPerfis->getFuncoes($idCliente);

        return $funcoes;

    }

    public function getAll($idCliente)
    {
        $ModelPerfis = new ModelPerfis();

        $perfis = $ModelPerfis->getAll($idCliente);

        return $perfis;
    }

}
