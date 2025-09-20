<?php
require_once 'Database.php';

class Subcategory extends Database {

    public function createSubcategory($subcategory_name, $category_id) {
        $sql = "INSERT INTO subcategories (subcategory_name, category_id) VALUES (?, ?)";
        return $this->executeNonQuery($sql, [$subcategory_name, $category_id]);
    }

    public function getSubcategories($category_id) {
        $sql = "SELECT * FROM subcategories WHERE category_id = ? ORDER BY subcategory_name ASC";
        return $this->executeQuery($sql, [$category_id]);
    }

    public function getSubcategory($subcategory_id) {
        $sql = "SELECT * FROM subcategories WHERE subcategory_id = ?";
        return $this->executeQuerySingle($sql, [$subcategory_id]);
    }

    public function updateSubcategory($subcategory_id, $subcategory_name) {
        $sql = "UPDATE subcategories SET subcategory_name = ? WHERE subcategory_id = ?";
        return $this->executeNonQuery($sql, [$subcategory_name, $subcategory_id]);
    }

    public function deleteSubcategory($subcategory_id) {
        $sql = "DELETE FROM subcategories WHERE subcategory_id = ?";
        return $this->executeNonQuery($sql, [$subcategory_id]);
    }
    
    public function getCategoriesWithSubcategories() {
        $sql = "SELECT c.category_id, c.category_name, s.subcategory_id, s.subcategory_name 
                FROM categories c 
                LEFT JOIN subcategories s ON c.category_id = s.category_id 
                ORDER BY c.category_name, s.subcategory_name";
        $results = $this->executeQuery($sql);
        
        $categories = [];
        foreach ($results as $row) {
            if (!isset($categories[$row['category_id']])) {
                $categories[$row['category_id']] = [
                    'category_id' => $row['category_id'],
                    'category_name' => $row['category_name'],
                    'subcategories' => []
                ];
            }
            if ($row['subcategory_id']) {
                $categories[$row['category_id']]['subcategories'][] = [
                    'subcategory_id' => $row['subcategory_id'],
                    'subcategory_name' => $row['subcategory_name']
                ];
            }
        }
        return $categories;
    }
}
?>