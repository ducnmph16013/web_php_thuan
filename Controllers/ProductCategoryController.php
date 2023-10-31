<?php
include_once "./Models/ProductCategory.php";

// định nghĩa hàm cha để tự động nạp header, footer tương ứng với vai trò
// tạo sau khi làm tính năng đăng nhập sau
// cần tách sang file maincontroller để đặt hàm call chung ko sẽ lỗi, và include các file control vào đó.
// xong thì include file maincontroller vào index.php

// function View($hamCall)
// {
//     include "./Views/admin/layouts/header.php";

//     $hamCall;
//     // bên ngoài sẽ chạy View cùng callback;
//     // bên dưới xóa các include ko cần thiết

//     include "./Views/admin/layouts/footer.php";
// }

function productCategoriesControl()
{
    include "./Views/admin/layouts/header.php";

    $productCategories = getProductCategories();

    include "./Views/admin/productCategory/index.php";
    include "./Views/admin/layouts/footer.php";
}

function createProductCategoryControl()
{
    include "./Views/admin/layouts/header.php";

    if (isset($_POST['add-new']) && $_POST['add-new']) {
        // xét tồn tại các post, xét điều kiện validate, nghiên cứu làm 1 file validate riêng
        $name = $_POST['name'];
        if (getProductCategoryWhereName($name)) {
            $_SESSION['notify']['error'] = "Danh mục này đã tồn tại, vui lòng nhập tên khác!";
            header("location: " . URL_P_C);
        } else {
            postProductCategory($name);
            $_SESSION['notify']['success'] = "Thêm mới thành công danh mục: $name";
            header("location: " . URL_P_C);
        }
        // exit("Test Exit");
    }

    include "./Views/admin/productCategory/create.php";
    include "./Views/admin/layouts/footer.php";
}

function deleteProductCategoryControl()
{
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $check = getProductCategory($id);
        if ($check) {
            $checkPr = getProductsWherePrCr($id);
            if ($checkPr) {
                $_SESSION['notify']['error'] = "Danh mục đã tồn tại sản phẩm, không được xóa!";
                header("location: " . URL_P_C);
            } else {
                deleteProductCategory($id);
                $_SESSION['notify']['success'] = 'Xóa thành công danh mục: ' . $check['name'];
                header("location: " . URL_P_C);
            }
        } else {
            $_SESSION['notify']['error'] = "Danh mục không tồn tại";
            header("location: " . URL_P_C);
        }
    } else {
        $_SESSION['notify']['error'] = "Danh mục không tồn tại";
        header("location: " . URL_P_C);
    }
}

function editProductCategoryControl()
{
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $productCategory = getProductCategory($id);
        if ($productCategory) {
            include "./Views/admin/layouts/header.php";
            include "./Views/admin/productCategory/edit.php";
            include "./Views/admin/layouts/footer.php";
        } else {
            $_SESSION['notify']['error'] = "Danh mục không tồn tại";
            header("location: " . URL_P_C);
        }
    } else {
        $_SESSION['notify']['error'] = "Danh mục không tồn tại";
        header("location: " . URL_P_C);
    }
}

function updateProductCategoryControl()
{
    if (isset($_POST['update']) && $_POST['update']) {
        $id = $_POST['idData'];
        $name = $_POST['name'];
        if (checkPut($name, $id)) {
            $_SESSION['notify']['error'] = "Danh mục này đã tồn tại, vui lòng nhập tên khác!";
            header("location: index.php?act=admin_product_categories_edit&id=$id");
        } else {
            putProductCategory($name, $id);
            $_SESSION['notify']['success'] = 'Cập nhật thành công danh mục: ' . $name;
            header("location: " . URL_P_C);
        }
    }
}
