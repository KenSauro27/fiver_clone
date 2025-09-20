<?php
require_once '../classloader.php';

if (isset($_POST['category_id']) && !empty($_POST['category_id'])) {
    $category_id = $_POST['category_id'];
    $subcategories = $subcategoryObj->getSubcategories($category_id);
    if ($subcategories) {
        echo '<option value="">Select a subcategory</option>';
        foreach ($subcategories as $subcategory) {
            echo '<option value="' . $subcategory['subcategory_id'] . '">' . $subcategory['subcategory_name'] . '</option>';
        }
    } else {
        echo '<option value="">No subcategories found</option>';
    }
}
?>