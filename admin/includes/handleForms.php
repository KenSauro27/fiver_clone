<?php
require_once '../classloader.php';

if (isset($_POST['addCategoryBtn'])) {
    $category_name = htmlspecialchars(trim($_POST['category_name']));
    if (!empty($category_name)) {
        if ($categoryObj->createCategory($category_name)) {
            header("Location: ../categories.php");
        } else {
            // Handle error
        }
    }
}

if (isset($_POST['addSubcategoryBtn'])) {
    $subcategory_name = htmlspecialchars(trim($_POST['subcategory_name']));
    $category_id = $_POST['category_id'];
    if (!empty($subcategory_name) && !empty($category_id)) {
        if ($subcategoryObj->createSubcategory($subcategory_name, $category_id)) {
            header("Location: ../categories.php");
        } else {
            // Handle error
        }
    }
}
?>