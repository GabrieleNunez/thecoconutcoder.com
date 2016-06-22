<?php namespace App\Models; 

use Library\Model;
class User extends Model {
	
	public $table = 'users';
	public static function AccountExist($email) {
		$total = User::count()->where('email',$email)->get();
		return $total ? true : false;
	}
}
?>