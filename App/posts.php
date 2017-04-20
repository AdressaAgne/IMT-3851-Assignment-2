<?php

class Posts extends Database{
    
    public function fetchAll(){
        return $this->query('SELECT * FROM posts')->fetchAll();
    }
    
    public function fetch($id){
        return $this->query('SELECT * FROM posts WHERE id = :id', [
            'id' => $id,
        ])->fetch();
    }
    
    public function add($title, $content, $image, $style){
        
        return $this->query('INSERT INTO posts (title, content, image_id, time, user_id, style) VALUES (:title, :content, :image_id, :time, :user_id, :style)', [
            'title'     => $title,
            'contnt'    => $content,
            'image_id'  => $image,
            'time'      => time(),
            'user_id'   => $auth->user_id(),
            'style'     => $style,
        ]);
        
    }
    
    public function edit($id, $title, $content, $image, $style){
        
        return $this->query('UPDATE posts SET title = :title, content = :content, image_id = :image_id, style = :style WHERE id = :id', [
            'id'        => $id,
            'title'     => $title,
            'contnt'    => $content,
            'image_id'  => $image,
            'style'     => $style,
        ]);
        
    }
    
    public function delete($id){

        return $this->query('DELETE FROM posts WHERE id = :id', [
            'id' => $id,
        ]);    
    }
}