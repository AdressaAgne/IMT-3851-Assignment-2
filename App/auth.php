<?php

class Auth extends Database{
    
    public function login($mail, $pw){
        foreach (get_defined_vars() as $key => $value) {
            if(empty($$key)) return $key . ' can not be empty';
        }
        
        $user = $this->query('SELECT * FROM users WHERE mail = :mail', ['mail' => $mail]);
        
        if($user->rowCount() == 0) return 'Your credentials does not match our database';
        
        $user = $user->fetch();

        if(!password_verify($pw, $user['password'])) return 'Your credentials does not match our database';
        
        unset($user['password']);
        $_SESSION['user'] = $user;
        
    }
    
    public function register($name, $surname, $mail, $pw1, $pw2){
        
        // if(empty($name))     return 'Name can not be empty';
        // if(empty($surname))  return 'Surname can not be empty';
        // if(empty($mail))     return 'Mail can not be empty';
        // if(empty($pw1))      return 'Password can not be empty';
        // if(empty($pw2))      return 'Password Again can not be empty';
        
        foreach (get_defined_vars() as $key => $value) {
            if(empty($$key)) return $key . ' can not be empty';
        }
        
        if($pw1 != $pw2) return 'Passwords does not match';
        
        if($this->query('SELECT mail FROM users WHERE mail = :mail', ['mail' => $mail])->rowCount() > 0) return 'This mail does already exist';
        
        //register
        $this->query('INSERT INTO Users (name, surname, mail, password) VALUES(:name, :surname, :mail, :pw)', [
            'name'     => $name,
            'surname'  => $surname,
            'mail'     => $mail,
            'pw'       => password_hash($pw1, PASSWORD_BCRYPT),
        ]);
    }
    
    public function logout(){
        unset($_SESSION);
        session_destroy();
        session_start();
    }
    
    public function isLoggedIn(){
        return isset($_SESSION['user']);
    }
    
    public function redirectIfLoggedIn(){
        if($this->isLoggedIn()){
            if(isset($_GET['page'])) die(header('location: '.$_GET['page']));
            header('location: index.php');    
        }
    }
    
    public function requireAuth(){
        if(!$this->isLoggedIn()){
            header('location: login.php?page='.trim($_SERVER['PHP_SELF'], '/'));
        }
    }
    
    public function get_id(){
        if($this->isLoggedIn()) return $_SESSION['user']['id'];
        return null;
    }
    
}