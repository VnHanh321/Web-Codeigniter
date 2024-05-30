<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PayController extends CI_Controller
{
  function execPostRequest($url, $data)
  {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
      $ch,
      CURLOPT_HTTPHEADER,
      array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data)
      )
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
  }
  public function online_checkout()
  {
    $this->load->library("cart");//load library cart
    $this->load->library('email');//load library
    $subtotal = 0;
    $total = 0;
    foreach ($this->cart->contents() as $items) {
      $subtotal = $items['qty'] * $items['price'];
      $total += $subtotal;
    }
    if (isset($_POST['cod_payments'])) {
      $this->form_validation->set_rules('email', 'Email', 'required', ['required' => 'You must provide a %s.']);
      $this->form_validation->set_rules('phone', 'Phone', 'required', ['required' => 'You must provide a %s.']);
      $this->form_validation->set_rules('name', 'Name', 'required', ['required' => 'You must provide a %s.']);
      $this->form_validation->set_rules('address', 'Address', 'required', ['required' => 'You must provide a %s.']);

      if ($this->form_validation->run() == TRUE) {
        $email = $this->input->post('email');
        // $shipping_method = $this->input->post('shipping_method');
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');

        $data = array(
          'email' => $email,
          'method' => 'cod',
          'name' => $name,
          'address' => $address,
          'phone' => $phone,
        );

        $this->load->model('LoginModel');
        $result = $this->LoginModel->NewShipping($data);
        if ($result) {
          //order
          $order_code = rand(00, 9999);

          $data_order = array(
            'order_code' => $order_code,
            'ship_id' => $result,
            'status' => 1,
          );
          $insert_order = $this->LoginModel->insert_order($data_order);
          //order details
          foreach ($this->cart->contents() as $items) {
            $data_order_details = array(
              'order_code' => $order_code,
              'product_id' => $items['id'],
              'quantity' => $items['qty'],
            );
            $insert_order_details = $this->LoginModel->insert_order_details($data_order_details);
          }

          $this->session->set_flashdata('success', 'Order successfuly');
          $this->cart->destroy();
          //send mail order success
          // $to_email = $email;
          // $title = "Order success";
          // $message = "Will contact you soon";
          // $this->send_mail($to_email, $title, $message);
          redirect(base_url('/thanks'));
        } else {
          $this->session->set_flashdata('error', 'Order fasle');
          redirect(base_url('/dang-nhap'));
        }
      } else {
        redirect(base_url('/checkout'));
      }

    } elseif (isset($_POST['payUrl'])) {
      $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


      $partnerCode = 'MOMOBKUN20180529';
      $accessKey = 'klm05TvNBzhg7h7j';
      $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
      $orderInfo = "Thanh toán qua MoMo";
      $amount = $total;
      $orderId = time() . "";
      $redirectUrl = "http://localhost:8000/thanks";
      $ipnUrl = "http://localhost:8000/thanks";
      $extraData = "";

      $partnerCode = $partnerCode;
      $accessKey = $accessKey;
      $serectkey = $secretKey;
      $orderId = $orderId; // Mã đơn hàng
      $orderInfo = $orderInfo;
      $amount = $amount;
      $ipnUrl = $ipnUrl;
      $redirectUrl = $redirectUrl;
      $extraData = $extraData;

      $requestId = time() . "";
      $requestType = "payWithATM";
      // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
      //before sign HMAC SHA256 signature
      $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
      $signature = hash_hmac("sha256", $rawHash, $serectkey);
      $data = array(
        'partnerCode' => $partnerCode,
        'partnerName' => "Test",
        "storeId" => "MomoTestStore",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature
      );
      $result = $this->execPostRequest($endpoint, json_encode($data));
      $jsonResult = json_decode($result, true);  // decode json

      //Just a example, please check more in there

      header('Location: ' . $jsonResult['payUrl']);

    } else {
      // Handle invalid payment method or missing data
      $this->invalid_payment_method();
    }
  }
}
