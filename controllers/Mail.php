<?php

class Mail
{
    //static method to send emails using a template or without a template
    public static function send($to, $subject, $msg, $domain = "no-reply", $template = '', $data = [])
    {
        $template_file = $template;
        //makes shure lines dont get to long
        //set content type so mail clients know what char type is used
        $headers = 'Content-Type: text/html; charset=utf-8' . "\r\n";
        //set the mime type
        $headers .= 'Mine-Version: 1.0' . "\r\n";
        //set the sender
        $headers .= "From: " . $domain . "@flevosap.nl";


        if (file_exists($template_file)) {
            $msg = file_get_contents($template_file);
        }

        //search the data and replace all values if it exists
        if (!empty($data)) {
            foreach (array_keys($data) as $key) {
                if (strlen($key) > 2 && trim($key) != "") {
                    $msg = str_replace($key, $data[$key], $msg);
                }
            }
        }

        try {
            $mail_status = @mail($to, $subject, $msg, $headers);
            if ($mail_status) {
                return true;
            }
            else{
                return false;
            }

        } catch (Exception $e) {
            return false;
        }
    }

    //static method to send the order mail (with a foreach loop to add all the products to the email)
    public static function sendOrderMail($to, $subject, $msg, $order, $price, $btw, $total, $domain = "no-reply", $template = '', $data = [])
    {
        //set the template (optional)
        $template_file = $template;

        //makes shure lines dont get to long
        //set content type so mail clients know what char type is used
        $headers = 'Content-Type: text/html; charset=utf-8' . "\r\n";
        //set the mime type
        $headers .= 'Mine-Version: 1.0' . "\r\n";
        //set the sender
        $headers .= "From: " . $domain . "@flevosap.nl";



        //check if the template exists
        if (file_exists($template_file)) {
            $msg = file_get_contents($template_file);
        }

        //search the data and replace all values
        if (!empty($data)) {
            foreach (array_keys($data) as $key) {
                if (strlen($key) > 2 && trim($key) != "") {
                    $msg = str_replace($key, $data[$key], $msg);
                }
            }
        }

        //add the order details
        foreach ($order as $item) {

            $msg .= '<hr>';
            $msg .= '<p>Naam product: ' . $item['name'] . '</p>';
            $msg .= '<p>Product omschrijving: ' . $item['desc'] . '</p>';
            $msg .= '<p>Product aantal: ' . $item['amount'] . '</p>';
            $msg .= '<p>Product Prijs: &euro;' . number_format((float)$item['price'], 2, ',', '') . '</p>';
        }

        //add the price from the cart
        $msg .= '<hr>';
        $msg .= ' <p>Subtotaalprijs: &euro;' . number_format((float)$price, 2, ',', '') . '</p>';
        $msg .= ' <p>Btw: ' . $btw . '</p>';
        $msg .= ' <p>Totaalprijs: &euro;' . number_format((float)$total, 2, ',', '') . '</p>';

        try {
            //send the mail with data
            $mail_status = @mail($to, $subject, $msg, $headers);
            if ($mail_status) {
                return true;
            }
            else{
                return false;
            }

        } catch (Exception $e) {
            return false;
        }
    }
}