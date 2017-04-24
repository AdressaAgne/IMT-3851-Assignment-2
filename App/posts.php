<?php

class Posts extends Database{
    
    public function fetchAll(){        
        if(isset($_POST['search'])){
            
            return $this->query('SELECT p.*, r.rating, AVG(r.rating) AS average, SUM(r.rating = 1) AS up, (SUM(r.rating = 1) * AVG(r.rating)) AS rating 
                FROM posts AS p 
                LEFT JOIN ratings AS r ON r.post_id = p.id
                WHERE p.title LIKE :search OR p.content LIKE :search
                GROUP BY p.id
                ORDER BY rating '.(isset($_COOKIE['order']) ? '' : 'DESC').'
                ', [
                    'search' => '%'.$_POST['search'].'%',
                    ])->fetchAll();
        } else {
            return $this->query('SELECT p.*, r.rating, AVG(r.rating) AS average, SUM(r.rating = 1) AS up, (SUM(r.rating = 1) * AVG(r.rating)) AS rating 
                FROM posts AS p 
                LEFT JOIN ratings AS r ON r.post_id = p.id
                GROUP BY p.id
                ORDER BY rating '.(isset($_COOKIE['order']) ? '' : 'DESC').'
                ')->fetchAll();
        }    
    }
    
    public function fetch($id){
        return $this->query('SELECT p.*, r.rating, AVG(r.rating) AS average, SUM(r.rating = 1) AS up, (SUM(r.rating = 1) * AVG(r.rating)) AS rating 
            FROM posts AS p 
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
        // INSERT row, if it exists update it
        // UPDATE: if current rating = the same as new rating then set rating to 2
        // DELETE all ratings that are set to 2
        $this->query('INSERT INTO ratings (user_id, post_id, rating) 
                        VALUES(:user_id, :post_id, :rating) 
                            ON DUPLICATE KEY
                                UPDATE rating = 
                                    CASE WHEN rating = :rating THEN 
                                        2
                                    ELSE 
                                        :rating
                                    END;

                    DELETE FROM ratings WHERE rating = 2;
            ', [
            'rating' => $vote,
            'post_id' => $id,
            'user_id' => $auth->get_id(),
        ]);
    }
}