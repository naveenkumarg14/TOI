<!-- start: Content -->
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Products</h3>
                <p class="animated fadeInDown">
                     <a href="home">Home</a> <span class="fa-angle-right fa"></span> Products
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <a href="addproducts" class="btn btn-sm btn-success right">Add Products</a>
            <br><br>
            <div class="panel">
                <div class="panel-body">

                    <div class="responsive-table">
                        <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Menu Code</th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Spicy</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($get_products as $item): ?>
                                    <tr> 
                                        <td><?php echo $item['MenuItemCode']; ?> </td>
                                        <td><?php echo $item['Name']; ?> </td>
                                        <td><?php echo $item['MenuCourseCategory']; ?></td>
                                        <td><?php echo $item['FoodCategoryName']; ?></td>
                                        <td><?php echo $item['FoodType']; ?></td>
                                        <td><?php echo $item['TasteType']; ?></td>
                                        <td><?php echo PRICE . $item['Price']; ?></td>
                                        <td><?php echo $item['Status']; ?></td>
                                        <td><a href="products/editproduct/<?php echo $item['MenuId']; ?>" class="btn btn-sm btn-warning">Edit</a></td>
                                    </tr>
                                <?php endforeach; ?>                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
<!-- end: content -->