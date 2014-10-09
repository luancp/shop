<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usuario_usuario';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password','remember_token');
	
    protected $fillable = array('usuario','nombre', 'email', 'estado', 'es_admin', 'token');
    
    public function getPassword(){
        return '******';
    }
    
    public function getRememberToken(){
        return $this->remember_token;
    }

    public function setRememberToken($value){
        $this->remember_token = $value;
    }

    public function getRememberTokenName(){
        return 'remember_token';
    }
    
    public function getEstadoDisplay() {
        if($this->estado == 'A'){
            return 'Activo';
        }
        if($this->estado == 'I'){
            return 'Inactivo';
        }
        if($this->estado == 'S'){
            return 'Suspendido';
        }
    }

}
