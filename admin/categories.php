<?php require_once 'classloader.php'; ?>
<?php 
if (!$userObj->isLoggedIn() || !$userObj->isAdmin()) {
  header("Location: ../login.php");
} 

$categories = $categoryObj->getCategories();
?>
<!doctype html>
  <html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <style>
      body {
        font-family: "Arial";
      }
    </style>
  </head>
  <body>
    <?php include 'includes/navbar.php'; ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h2>Add Category</h2>
            </div>
            <div class="card-body">
              <form action="core/handleForms.php" method="POST">
                <div class="form-group">
                  <label for="category_name">Category Name</label>
                  <input type="text" class="form-control" name="category_name" required>
                </div>
                <button type="submit" class="btn btn-primary" name="addCategoryBtn">Add Category</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h2>Add Subcategory</h2>
            </div>
            <div class="card-body">
              <form action="core/handleForms.php" method="POST">
                <div class="form-group">
                  <label for="category_id">Category</label>
                  <select class="form-control" name="category_id" required>
                    <option value="">Select a category</option>
                    <?php foreach ($categories as $category) { ?>
                      <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="subcategory_name">Subcategory Name</label>
                  <input type="text" class="form-control" name="subcategory_name" required>
                </div>
                <button type="submit" class="btn btn-primary" name="addSubcategoryBtn">Add Subcategory</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-md-12">
          <h2>Categories and Subcategories</h2>
          <ul class="list-group">
            <?php 
            $categoriesWithSubcategories = $subcategoryObj->getCategoriesWithSubcategories();
            foreach ($categoriesWithSubcategories as $category) { ?>
              <li class="list-group-item">
                <h5><?php echo $category['category_name']; ?></h5>
                <ul class="list-group">
                  <?php foreach ($category['subcategories'] as $subcategory) { ?>
                    <li class="list-group-item">
                      <?php echo $subcategory['subcategory_name']; ?>
                    </li>
                  <?php } ?>
                </ul>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </body>
</html>