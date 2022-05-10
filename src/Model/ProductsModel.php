<?php

namespace src\Model;
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
 
class ProductsModel extends Database
{
    public function getProducts($limit)
    {
        return $this->select("SELECT * FROM products ORDER BY id ASC LIMIT ?", ["i", $limit]);
    }

    public function deleteProducts($ids)
    {
        //$params = [];
        $placeholderstype = trim(str_repeat('i', count( explode(",", $ids) )), ',');
        $placeholders = trim(str_repeat('?,', count( explode(",", $ids) )), ',');
        $params = explode(",", $ids);
        
        return $this->delete("DELETE FROM products WHERE id in (".$placeholders.")", [$placeholderstype, $params]);
    }

    public function insertProduct($params = [])
    {
        return $this->insert("INSERT INTO `products`(`sku`, `name`, `price`, `productType`, `productTypeValue`) VALUES (?, ?, ?, ?, ?)", ["ssdss", $params]);
    }
}
?>