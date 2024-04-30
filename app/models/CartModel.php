<?php

class CartModel
{
    //ajoute un produit dans le panier

    public function addToCart($product)
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
            $_SESSION['cart']['name'] = array();
            $_SESSION['cart']['idProduct'] = array();
            $_SESSION['cart']['quantity'] = array();
            $_SESSION['cart']['price'] = array();
        }

        $_SESSION['cart']['name'][] = $product->nameProduct;
        $_SESSION['cart']['idProduct'][] = $product->idProduct;
        $_SESSION['cart']['quantity'][] = 1;
        $_SESSION['cart']['price'][] = $product->priceProduct;
    }

    //supprime le panier 
    public function deleteCart()
    {
        unset($_SESSION['cart']);
    }

    // cree une table html pour le panier
     
    public function makeHTMLCart($cart)
    {
        $html = "";
        if (is_array($cart) && isset($cart['idProduct'])) {
            $num_items = count($cart['idProduct']);
            for ($i = 0; $i < $num_items ; $i++) {
                $html .= '<tr>
                            <th scope="row">1</th>
                            <td>' . $cart['name'][$i] . '</td>
                            <td>' . $cart['quantity'][$i] . '</td>
                            <td>' . $cart['price'][$i] . '</td>
                            </th>';
            }
        }
        return $html;
    }
}
