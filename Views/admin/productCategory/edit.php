<?php
extract($productCategory);
?>
<div class="container">
    <h1 class="mt-5">Cập nhật danh mục sản phẩm: "<?= isset($name) ? $name : "" ?>"</h1>
    <div class="mt-3 notify">
        <?php if (isset($_SESSION['notify']['success'])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['notify']['success'] ?>
                <button type="button" class="btn-close bg-danger" style="padding: 13px 40px;" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['notify']['success']) ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['notify']['error'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['notify']['error'] ?>
                <button type="button" class="btn-close bg-danger" style="padding: 13px 40px;" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['notify']['error']) ?>
        <?php endif; ?>
    </div>
    <form action="index.php?act=admin_product_categories_update" class="form" method="POST">
        <div class="mb-3">
            <label for="exampleName" class="form-label">Tên danh mục<span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" id="exampleName" value="<?= isset($name) ? $name : "" ?>">
        </div>
        <div class="mb-3">
            <input type="hidden" name="idData" class="form-control" value="<?= isset($id) ? $id : "" ?>">
            <input type="submit" onclick="return confirm('Bạn có muốn cập nhật không')" name="update" value="Cập nhật" class="btn btn-primary"></input>
            <input type="reset" class="btn btn-outline-danger" value="Nhập lại"></input>
            <a href="index.php?act=admin_product_categories" class="btn btn-outline-success">Danh sách</a>
        </div>
    </form>
</div>