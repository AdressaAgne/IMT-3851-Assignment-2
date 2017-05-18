<?php

class Categories extends Database {
    
    /**
     * fetch all categories
     *
     * @method fetchAll
     *
     * @author [Agne Ødegaard]
     *
     * @return array categories
     */
    public function fetchAll(){
        return $this->query('SELECT c.*, COUNT(pc.id) AS articles FROM categories AS c
                            LEFT JOIN posts_categories AS pc ON pc.category_id = c.id
                            GROUP BY c.id
        ')->fetchAll();
    }
    
    /**
     * Delete a category
     *
     * @method delete
     *
     * @author [Agne Ødegaard]
     *
     * @param  [integer] $id [category id]
     *
     * @return [query]  
     */
    public function delete($id){
        return $this->query('DELETE FROM categories WHERE id = :id', [
            'id' => $id,
        ]);
    }
    
    /**
     * Update a category
     *
     * @method edit
     *
     * @author [Agne Ødegaard]
     *
     * @param  [integer] $id   [category id]
     * @param  [string] $name [new category name]
     *
     * @return [query]  
     */
    public function edit($id, $name){
        return $this->query('UPDATE categories SET name = :name WHERE id = :id', [
            'id' => $id,
            'name' => $name,
        ]);
    }
    
    /**
     * Add a new category
     *
     * @method add
     *
     * @author [Agne Ødegaard]
     *
     * @param  [string] $name [category name]
     */
    public function add($name){
        return $this->query('INSERT INTO categories (name) VALUES(:name)', [
            'name' => $name,
        ]);
    }
    
}