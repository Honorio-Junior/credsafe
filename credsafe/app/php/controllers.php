<?php

require 'models.php';

class ControllerClientes
{

    public function validaCliente($cliente){

        $ModelCliente = new ModelClientes();
        $clienteEncontrado = $ModelCliente->getByEmail($cliente['email']);

        if(!empty($clienteEncontrado)){

            if(password_verify($cliente['password'], $clienteEncontrado[0]['senha'])){
                return 'Login realizado com sucesso!!!';
            }else{
                return 'Email ou senha incorreto!';
            }
        }
        else{
            return 'Email ou senha incorreto!';
        }
    }
}
