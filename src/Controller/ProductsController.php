<?php
namespace src\Controller;
use src\Model\ProductsModel as ProductsModel;
use src\Controller as controller;

class ProductsController extends controller\BaseController
{
    /**
     * "/products/list" Endpoint - Get list of products
     */
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
 
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $productsModel = new ProductsModel();
 
                $intLimit = 100;
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }
 
                $arrProducts = $productsModel->getProducts($intLimit);
                $responseData = json_encode($arrProducts);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
 
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    /**
     * "/products/delete" Endpoint - delete products
     */
    public function deleteAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
 
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $productsModel = new ProductsModel();
 
                $deleteIDS = -1;
                if (isset($arrQueryStringParams['id']) && $arrQueryStringParams['id']) {
                    $deleteIDS = $arrQueryStringParams['id'];
                }
 
                $arrProducts = $productsModel->deleteProducts($deleteIDS);
                $responseData = json_encode($arrProducts);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
 
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function addAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        //print_r($arrQueryStringParams);
 
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $productsModel = new ProductsModel();
 
                $params = [];
                if (isset($arrQueryStringParams['sku']) && $arrQueryStringParams['sku']) {
                    array_push($params, $arrQueryStringParams['sku']);
                }
                if (isset($arrQueryStringParams['name']) && $arrQueryStringParams['name']) {
                    array_push($params, $arrQueryStringParams['name']);
                }
                if (isset($arrQueryStringParams['price']) && $arrQueryStringParams['price']) {
                    array_push($params, $arrQueryStringParams['price']);
                }
                if (isset($arrQueryStringParams['productType']) && $arrQueryStringParams['productType']) {
                    array_push($params, $arrQueryStringParams['productType']);
                }
                if (isset($arrQueryStringParams['productTypeValue']) && $arrQueryStringParams['productTypeValue']) {
                    array_push($params, $arrQueryStringParams['productTypeValue']);
                }
 
                $arrProducts = $productsModel->insertProduct($params);
                $responseData = json_encode($arrProducts);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
 
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}
?>