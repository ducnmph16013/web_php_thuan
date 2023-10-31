<?php
include_once "./Models/Db.php";

function getStatisticalWithPC()
{
    $sql = "SELECT PC.id, PC.name , COUNT(PR.product_category_id) AS product_quantity,
    MAX(PR.regular_price) AS max_price, MIN(PR.regular_price) AS min_price,
    AVG(PR.regular_price) AS avg_price
    FROM `product_categories` PC
    LEFT JOIN products PR ON PC.id = PR.product_category_id
    GROUP BY PC.id
    ORDER BY PC.name";

    return pdo_query($sql);
}

function getStatisticalWithOrderQuantity()
{
    $sql = "SELECT MONTH(created_at) AS sold_month, COUNT(*) AS total_orders
    FROM orders
    WHERE YEAR(created_at) = 2023 AND status = 4
    GROUP BY sold_month";

    return pdo_query($sql);
}
