<?php

class Posts extends Database{
    
    private $base_sql = 
        'SELECT p.*, 
                AVG(r.rating) AS average, 
                SUM(r.rating = 1) AS up, 
                (SUM(r.rating = 1) * AVG(r.rating)) AS rating,
                GROUP_CONCAT(c.name SEPARATOR ", ") AS categories
            
            FROM posts AS p 
            
            LEFT JOIN posts_categories AS pc ON pc.post_id = p.id
            LEFT JOIN categories AS c ON pc.category_id = c.id
            LEFT JOIN ratings AS r ON r.post_id = p.id';
    
    
    /**
     * Fetch all posts
     *
     * @method fetchAll
     *
     * @author [Agne Ødegaard]
     *
     * @return Array of posts
     */
    public function fetchAll(){   
        $vars = null; 
        $sql = $this->base_sql;
        if(isset($_POST['search'])){
            $sql .= ' WHERE p.title LIKE :search OR p.content LIKE :search';    
            $vars['search'] = '%'.$_POST['search'].'%';
        }   
        $sql .= ' GROUP BY p.id';
        // This is actually safe, since i'm not adding the value directly, but adding a static value. So this is SQL-injection safe.
        $sql .= ' ORDER BY rating '.(isset($_COOKIE['order']) ? '' : 'DESC');
        
        $result = $this->query($sql, $vars)->fetchAll();
        
        foreach ($result as &$value) {
            $this->extractCategories($value);
        }
        
        return $result;
    }
    
    /**
     * extract the categories in a post, from string to array
     *
     * @method extractCategories
     *
     * @author [Agne Ødegaard]
     *
     * @param  [array]     &$post [a post]
     *
     * @return void
     */
    public function extractCategories(&$post){
        if(isset($post['categories'])) {
            $post['categories'] = explode(',', $post['categories']);
        } else {
            $post['categories'] = [];
        }
    }
    
    /**
     * fetch 1 post by id
     *
     * @method fetch
     *
     * @author [Agne Ødegaard]
     *
     * @param  [integer] $id [post id]
     *
     * @return [array]     [the post data]
     */
    public function fetch($id){
        $sql = $this->base_sql;
        $sql .= ' WHERE p.id = :id';
        $result = $this->query($sql, ['id' => $id])->fetch();
        $this->extractCategories($result);
        
        return $result;
    }
    
    /**
     * add a new category to a post
     *
     * @method add_category
     *
     * @author [Agne Ødegaard]
     *
     * @param  [integer]       $category_id [category id]
     * @param  [integer]       $post_id     [post id]
     */
    public function add_category($category_id, $post_id){
        return $this->query('INSERT INTO posts_categories (post_id, category_id) VALUES (:p_id, :c_id)', [
            'p_id'   => $post_id,
            'c_id'   => $category_id,
        ]);
    }
    
    
    /**
     * Add a new post
     *
     * @method add
     *
     * @author [Agne Ødegaard]
     *
     * @param  [string] $title   [post title]
     * @param  [string] $content [post content]
     * @param  [integer] $image   [image id]
     * @param  [string] $style   [post stryle]
     */
    public function add($title, $content, $image, $style, array $categories){
        $auth = new Auth();
        $id = $this->query('INSERT INTO posts (title, content, image_id, time, user_id, style) VALUES (:title, :content, :image_id, :time, :user_id, :style)', [
            'title'     => $title,
            'content'   => $content,
            'image_id'  => $image,
            'time'      => date('Y-m-d', time()),
            'user_id'   => $auth->get_id(),
            'style'     => $style,
        ]);
        
        foreach ($categories as $key => $value) {
            $this->add_category($value, $id);
        }
    }
    
    /**
     * Edit a post
     *
     * @method edit
     *
     * @author [Agne Ødegaard]
     *
     * @param  [intger] $id      [post id]
     * @param  [string] $title   [new post title]
     * @param  [string] $content [new post content]
     * @param  [integer] $image   [new image id]
     * @param  [string] $style   [new post style]
     *
     * @return query
     */
    public function edit($id, $title, $content, $image, $style, array $categories){
        $this->query('DELETE FROM posts_categories WHERE post_id = :id', ['id' => $id]);
        
        $this->query('UPDATE posts SET title = :title, content = :content, image_id = :image_id, style = :style WHERE id = :id', [
            'id'        => $id,
            'title'     => $title,
            'content'   => $content,
            'image_id'  => $image,
            'style'     => $style,
        ]);
        
        foreach ($categories as $key => $value) {
            $this->add_category($value, $id);
        }
        
    }
    
    /**
     * delete a post
     *
     * @method delete
     *
     * @author [Agne Ødegaard]
     *
     * @param  [integer] $id [post id]
     *
     * @return query
     */
    public function delete($id){
        return $this->query('DELETE FROM posts WHERE id = :id', [
            'id' => $id,
        ]);    
    }
    
    /**
     * Vote a post up, down or remove the vote
     *
     * @method vote
     *
     * @author [Agne Ødegaard]
     *
     * @param  [integer] $id   [Post id]
     * @param  [boolean] $vote [0 = Down, 1 = up]
     *
     * @return void
     */
    public function vote($id, $vote){
        $auth = new Auth();
        if(!$auth->isLoggedIn()) return;
        
        $this->query('INSERT INTO ratings (user_id, post_id, rating) 
                        VALUES(:user_id, :post_id, :rating) 
                            ON DUPLICATE KEY
                                UPDATE rating = 
                                    CASE WHEN rating = :rating THEN 
                                        2
                                    ELSE 
                                        :rating
                                    END;

                    DELETE FROM ratings WHERE rating = 2;', [
            'rating' => $vote,
            'post_id' => $id,
            'user_id' => $auth->get_id(),
        ]);
    }
}