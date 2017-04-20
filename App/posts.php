<?php

class Posts extends Database{
    
    public function fetchAll(){
        return $this->query('SELECT p.*, r.rating FROM posts AS p 
            LEFT JOIN ratings AS r ON r.post_id = p.id')->fetchAll();
    }
    
    public function fetch($id){
        return $this->query('SELECT p.*, r.rating FROM posts AS p 
            LEFT JOIN ratings AS r ON r.post_id = p.id 
            WHERE p.id = :id', [
            'id' => $id,
        ])->fetch();
    }
    
    public function add($title, $content, $image, $style){
        $auth = new Auth();
        return $this->query('INSERT INTO posts (title, content, image_id, time, user_id, style) VALUES (:title, :content, :image_id, :time, :user_id, :style)', [
            'title'     => $title,
            'content'   => $content,
            'image_id'  => $image,
            'time'      => date('Y-m-d', time()),
            'user_id'   => $auth->get_id(),
            'style'     => $style,
        ]);
    }
    
    public function edit($id, $title, $content, $image, $style){
        
        return $this->query('UPDATE posts SET title = :title, content = :content, image_id = :image_id, style = :style WHERE id = :id', [
            'id'        => $id,
            'title'     => $title,
            'content'   => $content,
            'image_id'  => $image,
            'style'     => $style,
        ]);
        
    }
    
    public function delete($id){

        return $this->query('DELETE FROM posts WHERE id = :id', [
            'id' => $id,
        ]);    
    }
    
    public function vote($id, $vote){
        $auth = new Auth();
        if(!$auth->isLoggedIn()) return;
        
        $rating = $this->query('SELECT * FROM ratings WHERE post_id = :post_id AND user_id = :user_id',[
            'post_id' => $id,
            'user_id' => $auth->get_id(),
        ]);
        if($rating->rowCount() > 0){
            $rating = $rating->fetch();
            if($vote == $rating['rating']){
                $this->query('DELETE FROM ratings WHERE id = :id', [
                    'id' => $rating['id'],
                ]);
            } else {
                $this->query('UPDATE ratings SET rating = :vote WHERE id = :id', [
                    'vote' => !$rating['rating'],
                    'id' => $rating['id'],
                ]);
            }
        } else {
            $this->query('INSERT INTO ratings (user_id, post_id, rating) VALUES(:user_id, :post_id, :rating)', [
                'rating' => $vote,
                'post_id' => $id,
                'user_id' => $auth->get_id(),
            ]);
        }
    }
}