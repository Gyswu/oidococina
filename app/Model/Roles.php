<?php

namespace App\Model;

use Nette\Security\IAuthorizator;

class Roles implements IAuthorizator {
    
    //Secciones
    const SECCION_ADMIN = 'administracion';
    const SECCION_MESAS = 'mesas';
    const SECCION_COCINA = 'cocina';
    const SECCION_TPV = 'tpv';
    const SECCION_LOGIN = 'login';
    
    //Roles
    const ROL_ADMIN = 'admin';
    const ROL_GERENTE = 'gerente';
    const ROL_TPV = 'tpv';
    const ROL_COCINA = 'cocina';
    const ROL_CAMARERO = 'camarero';
    
    //Permisos
    const PERMISO_VER = 'ver';
    const PERMISO_EDITAR = 'editar';
    const PERMISO_BORRAR = 'borrar';
    const PERMISO_PEDIDO_CREAR = 'hacerPedido';
    const PERMISO_PEDIDO_LISTO = 'pedidoListo';
    const PERMISO_PEDIDO_COBRAR = 'cobrar';
    
    private static $permissions;
    
    public function getRoles() {
        $roles = [];
        foreach( self::getPermisos() as $permiso => $x ) {
            $roles[] = $permiso;
        }
        
        return $roles;
    }
    
    private static function getPermisos() {
        
        if( !self::$permissions ) {
            
            $acl = [
                'superadmin' => [], //este puede hacer todo solo por ser el
                'admin'      => [
                    self::SECCION_ADMIN  => [], //array de permisos vacío = todos los permisos
                    self::SECCION_MESAS  => [],
                    self::SECCION_TPV    => [],
                    self::SECCION_COCINA => [],
                ],
                'gerente'    => [
                    self::SECCION_MESAS  => [],
                    self::SECCION_TPV    => [],
                    self::SECCION_COCINA => [],
                ],
                'tpv'        => [
                    self::SECCION_TPV => [],
                ],
                'cocinero'   => [
                    self::SECCION_COCINA => [],
                ],
                'camarero'   => [
                    self::SECCION_MESAS => [],
                ],
                'guest'      => [
                    self::SECCION_LOGIN => [],
                ],
            ];
            self::$permissions = $acl; //set the permissions once
        }
        
        return self::$permissions;
    }
    
    public function isAllowed( $role, $resource, $privilege ): bool {
        if( $role === 'superadmin' ) {
            return true;
        }
        //
        $acl = self::getPermisos();
        if( !$privilege && isset($acl[ $role ][ $resource ]) ) {
            return true;
        }
        
        return isset($acl[ $role ][ $resource ]) && in_array($privilege, $acl[ $role ][ $resource ]);
    }
    
}
