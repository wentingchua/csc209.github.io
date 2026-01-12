<?php
$sales_path = "../../json/productSales.json";
$sales_data = json_decode(file_get_contents($sales_path), true);
uasort($sales_data, function($a, $b) {
    return $a["amount"] <=> $b["amount"] ;
});
$sale_labels = [];
$sale_count = [];
foreach ($sales_data as $product_id => $sale_summary) {
    array_push($sale_labels, $sale_summary["title"]);
    array_push($sale_count, $sale_summary["amount"]);
}
$data = [
    "labels" => $sale_labels,
    "data" => $sale_count
];
echo json_encode($data);
?>