<?php
function totalSales()
{
    $sales_path = "../json/productSales.json";
    $sales_data = json_decode(file_get_contents($sales_path), true);
    $total_sales = 0;
    foreach ($sales_data as $product_id => $sale_summary) {
        $total_sales += $sale_summary["amount"];
    }
    echo json_encode($total_sales);
}
?>