<?php

class Auth extends Database{
    
    public $user = null;
    
    
    public function __construct(){
        parent::__construct();
        if($this->isLoggedIn()) {
            
            $this->user = $this->query('SELECT name, surname, mail, id, rank FROM users WHERE id = :id', [
                'id' => $_SESSION['id'],
            ]);
            
            if($this->user->rowCount() < 1) $this->logout();
            $this->user = $this->user->fetch();
        }
    }
    
    /**
     * Login a user
     *
     * @method login
     *
     * @author [Agne Ødegaard]
     *
     * @param  [string] $mail [the users mail]
     * @param  [string] $pw   [the users password]
     *
     * @return [string/boolean]       [error msg or true]
     */
    public function login($mail, $pw){
        foreach (get_defined_vars() as $key => $value) {
            if(empty($$key)) return $key . ' can not be empty';
        }
        
        $user = $this->query('SELECT * FROM users WHERE mail = :mail', ['mail' => $mail]);
        
        if($user->rowCount() == 0) return 'Your credentials does not match our database';
        
        $user = $user->fetch();

        if(!password_verify($pw, $user['password'])) return 'Your credentials does not match our database';
        
        unset($user['password']);
        $_SESSION['id'] = $user['id'];
        
    }
    
    /**
     * Edit a users password
     *
     * @method changePassword
     *
     * @author [Agne Ødegaard]
     *
     * @param  [string]         $pw1   [new password 1]
     * @param  [string]         $pw2   [new password 2]
     * @param  [string]         $oldpw [old password]
     *
     * @return [string]        [message]
     */
    public function changePassword($pw1, $pw2, $oldpw){
        if($pw1 != $pw2) return 'Passwords does not match';
        
        $user = $this->query('SELECT password FROM users WHERE id = :id', ['id' => $this->get_id()])->fetch();
        if(!password_verify($oldpw, $user['password'])) return 'Your old password is wrong.';
        
        if($this->query('UPDATE users SET password = :pw WHERE id = :id', [
            'pw' => password_hash($pw1, PASSWORD_BCRYPT),
            'id' => $this->get_id(),
        ])) return 'Your password has been changed';
        return 'Something went wrong, try again later.';
    }
    
    /**
     * Edit a users profile
     *
     * @method editProfile
     *
     * @author [Agne Ødegaard]
     *
     * @param  [string]      $name    [users name]
     * @param  [string]      $surname [users surname]
     * @param  [string]      $mail    [users mail]
     *
     * @return [string]               [message]
     */
    public function editProfile($name, $surname, $mail){    
        if($this->query('UPDATE users SET name = :name, surname = :surname, mail = :mail WHERE id = :id', [
            'name' => $name,
            'surname' => $surname,
            'mail' => $mail,
            'id' => $this->get_id(),
        ])) {
            return 'Your profile has been changed';
        }
        return 'Something went wrong, try again later.';
    }
    
    /**
     * Register a new user
     *
     * @method register
     *
     * @author [Agne Ødegaard]
     *
     * @param  [string]   $name    [the users name]
     * @param  [string]   $surname [the suers surname]
     * @param  [string]   $mail    [the users mail]
     * @param  [string]   $pw1     [password 1]
     * @param  [string]   $pw2     [password 2]
     *
     * @return [string/boolean]            [error msg or true]
     */
    public function register($name, $surname, $mail, $pw1, $pw2){
        
        foreach (get_defined_vars() as $key => $value) {
            if(empty($$key)) return $key . ' can not be empty';
        }
        
        if($pw1 != $pw2) return 'Passwords does not match';
        
        if($this->query('SELECT mail FROM users WHERE mail = :mail', ['mail' => $mail])->rowCount() > 0) return 'This mail does already exist';
        
        //register
        $this->query('INSERT INTO Users (name, surname, mail, password, rank) VALUES(:name, :surname, :mail, :pw, :rank)', [
            'name'     => $name,
            'surname'  => $surname,
            'mail'     => $mail,
            'pw'       => password_hash($pw1, PASSWORD_BCRYPT),
            'rank'     => 1,
        ]);
        
        return true;
    }
    
    /**
     * Fetch all users for adminpage
     *
     * @method fetchAll
     *
     * @author [Agne Ødegaard]
     *
     * @return [array]   [users]
     */
    public function fetchAll(){
        return $this->query('SELECT * FROM users')->fetchAll();
    }
    
    /**
     * Delete a user
     *
     * @method delete
     *
     * @author [Agne Ødegaard]
     *
     * @param  [integer] $id [user id]
     *
     * @return query
     */
    public function delete($id){
        return $this->query('DELETE FROM users WHERE id = :id', [
            'id' => $id,
        ]);
    }
    
    /**
     * Logout a user
     *
     * @method logout
     *
     * @author [Agne Ødegaard]
     *
     * @return void
     */
    public function logout(){
        unset($_SESSION);
        session_destroy();
        session_start();
    }
    
    /**
     * check if the use ris logged in
     *
     * @method isLoggedIn
     *
     * @author [Agne Ødegaard]
     *
     * @return boolean   
     */
    public function isLoggedIn(){
        return isset($_SESSION['id']);
    }
    
    /**
     * Redirect if the user is logged in, used for the login/register page
     *
     * @method redirectIfLoggedIn
     *
     * @author [Agne Ødegaard]
     *
     * @return void
     */
    public function redirectIfLoggedIn(){
        if($this->isLoggedIn()){
            if(isset($_GET['page'])) die(header('location: '.$_GET['page']));
            redirect('index.php');    
        }
    }
    
    /**
     * Calling this on a page will redirect the user to login.php if the user is not logged in
     *
     * @method requireAuth
     *
     * @author [Agne Ødegaard]
     *
     * @return void
     */
    public function requireAuth(){
        if(!$this->isLoggedIn()){
            //selects last file in url
            $page = explode('/', trim($_SERVER['PHP_SELF'], '/'));
            $page = $page[count($page) - 1];
            redirect('login.php?page='.$page);
        }
    }
    
    /**
     * get the logged inn users rank, 0 if not logged in
     *
     * @method rank
     *
     * @author [Agne Ødegaard]
     *
     * @return [integer] [user rank]
     */
    public function rank(){
        if($this->isLoggedIn()) return $this->user['rank'];
        return 0;
    }
    
    /**
     * get the logged inn users id
     *
     * @method get_id
     *
     * @author [Agne Ødegaard]
     *
     * @return [integer] [user id]
     */
    public function get_id(){
        if($this->isLoggedIn()) return $this->user['id'];
        return null;
    }
    
}