<?php
defined('BASEPATH') or exit('No direct script access allowed');

class IndexController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('IndexModel');//load lấy dữ liệu csdl

		$this->load->library("cart");//load library cart

		$this->data['category'] = $this->IndexModel->getCategoryHome();
		$this->data['brand'] = $this->IndexModel->getBrandHome();
	}
	public function index()
	{
		$this->data['allproduct'] = $this->IndexModel->getAllproduct();
		$this->load->view('pages/template/header', $this->data);//load giao diện
		$this->load->view('pages/template/slider');//load giao diện
		$this->load->view('pages/home', $this->data);//load giao diện
		$this->load->view('pages/template/footer');//load giao diện
	}
	public function login()
	{
		$this->load->view('pages/template/header', $this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/login');
		$this->load->view('pages/template/footer');
	}
	public function category($id)
	{
		$this->data['category_product'] = $this->IndexModel->getCategoryProduct($id);
		$this->data['title'] = $this->IndexModel->getCategoryTitle($id);
		$this->config->config['pageTitle'] = $this->data['title'];
		$this->load->view('pages/template/header', $this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/category', $this->data);
		$this->load->view('pages/template/footer');
	}
	public function brand($id)
	{
		$this->data['brand_product'] = $this->IndexModel->getBrandProduct($id);
		// $this->data['title'] = $this->IndexModel->getBrandTitle($id);
		// $this->config->config['pageTitle'] = $this->data['title'];
		$this->load->view('pages/template/header', $this->data);
		$this->load->view('pages/brand', $this->data);
		$this->load->view('pages/template/footer');
	}
	public function product($id)
	{
		$this->data['product_details'] = $this->IndexModel->getProductDetails($id);
		$this->data['title'] = $this->IndexModel->getProductTitle($id);
		$this->config->config['pageTitle'] = $this->data['title'];
		$this->load->view('pages/template/header', $this->data);
		$this->load->view('pages/product_details', $this->data);
		$this->load->view('pages/template/footer');
	}
	public function cart()
	{
		$this->load->view('pages/template/header', $this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/cart');
		$this->load->view('pages/template/footer');
	}
	public function add_to_cart()
	{
		$product_id = $this->input->post('product_id');
		$quantity = $this->input->post('quantity');
		$this->data['product_details'] = $this->IndexModel->getProductDetails($product_id);
		//dat hang
		foreach ($this->data['product_details'] as $key => $pro) {
			$cart = array(
				'id' => $pro->id,
				'qty' => $quantity,
				'price' => $pro->price,
				'name' => $pro->title,
				'options' => array('image' => $pro->image)
			);
		}
		$this->cart->insert($cart);
		redirect(base_url() . 'gio-hang', 'refresh');
	}
	public function update_cart_item()
	{
		$rowid = $this->input->post('rowid');
		echo $quantity = $this->input->post('quantity');
		foreach ($this->cart->contents() as $items) {
			if ($rowid == $items['rowid']) {
				$cart = array(
					'rowid' => $rowid,
					'qty' => $quantity,
				);
			}
		}
		$this->cart->update($cart);
		// redirect(base_url() . 'gio-hang', 'refresh');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function delete_all_cart()
	{
		$this->cart->destroy();
		redirect(base_url() . 'gio-hang', 'refresh');
	}
	public function delete_item_cart($rowid)
	{
		$this->cart->remove($rowid);
		redirect(base_url() . 'gio-hang', 'refresh');
	}
	public function login_customer()
	{
		$this->form_validation->set_rules('email', 'Email', 'required', ['required' => 'You must provide a %s.']);
		$this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'You must provide a %s.']);

		if ($this->form_validation->run() == TRUE) {
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$this->load->model('LoginModel');
			$result = $this->LoginModel->checkCustomer($email, $password);
			if (count($result) > 0) {
				$session_array = array(
					'id' => $result[0]->id,
					'username' => $result[0]->name,
					'email' => $result[0]->email,
				);
				$this->session->set_userdata('LoggedInCustomer', $session_array);
				$this->session->set_flashdata('success', 'login successfuly');
				redirect(base_url('/checkout'));
			} else {
				$this->session->set_flashdata('error', 'login fasle');
				redirect(base_url('/dang-nhap'));
			}
		} else {
			$this->login();
		}
	}
	public function logout_customer()
	{
		$this->session->unset_userdata('LoggedInCustomer');
		$this->session->set_flashdata('success', 'logout successfuly');
		redirect(base_url('/dang-nhap'));
	}
	public function signup_customer()
	{
		$this->form_validation->set_rules('email', 'Email', 'required', ['required' => 'You must provide a %s.']);
		$this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'You must provide a %s.']);
		$this->form_validation->set_rules('phone', 'Phone', 'required', ['required' => 'You must provide a %s.']);
		$this->form_validation->set_rules('name', 'Name', 'required', ['required' => 'You must provide a %s.']);
		$this->form_validation->set_rules('address', 'Address', 'required', ['required' => 'You must provide a %s.']);

		if ($this->form_validation->run() == TRUE) {
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$name = $this->input->post('name');
			$address = $this->input->post('address');
			$phone = $this->input->post('phone');

			$data = array(
				'email' => $email,
				'password' => $password,
				'name' => $name,
				'address' => $address,
				'phone' => $phone,
			);

			$this->load->model('LoginModel');
			$result = $this->LoginModel->NewCustomer($data);
			if ($result) {
				$session_array = array(
					'username' => $name,
					'email' => $email,
				);
				$this->session->set_userdata('LoggedInCustomer', $session_array);
				$this->session->set_flashdata('success', 'login successfuly');
				redirect(base_url('/checkout'));
			} else {
				$this->session->set_flashdata('error', 'login fasle');
				redirect(base_url('/dang-nhap'));
			}
		} else {
			$this->login();
		}
	}
	public function checkout()
	{
		if ($this->session->userdata('LoggedInCustomer') && $this->cart->contents()) {
			$this->load->view('pages/template/header', $this->data);
			// $this->load->view('pages/template/slider');
			$this->load->view('pages/checkout');
			$this->load->view('pages/template/footer');
		} else {
			redirect(base_url() . 'gio-hang');
		}
	}
	public function confirm_checkout()
	{
		$this->form_validation->set_rules('email', 'Email', 'required', ['required' => 'You must provide a %s.']);
		$this->form_validation->set_rules('phone', 'Phone', 'required', ['required' => 'You must provide a %s.']);
		$this->form_validation->set_rules('name', 'Name', 'required', ['required' => 'You must provide a %s.']);
		$this->form_validation->set_rules('address', 'Address', 'required', ['required' => 'You must provide a %s.']);

		if ($this->form_validation->run() == TRUE) {
			$email = $this->input->post('email');
			$shipping_method = $this->input->post('shipping_method');
			$name = $this->input->post('name');
			$address = $this->input->post('address');
			$phone = $this->input->post('phone');

			$data = array(
				'email' => $email,
				'method' => $shipping_method,
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
				redirect(base_url('/thanks'));
			} else {
				$this->session->set_flashdata('error', 'Order fasle');
				redirect(base_url('/dang-nhap'));
			}
		} else {
			$this->checkout();
		}
	}
	public function thanks()
	{
		$this->load->view('pages/template/header', $this->data);
		$this->load->view('pages/thanks');
		$this->load->view('pages/template/footer');
	}
	public function search_product()
	{
		if (isset($_GET['keyword']) && $_GET['keyword'] != '') {
			$keyword = $_GET['keyword'];
		}
		$this->data['product'] = $this->IndexModel->getProductByKeyword($keyword);
		$this->data['title'] = 'Keyword: ' . $keyword;
		$this->config->config['pageTitle'] = $keyword;

		$this->load->view('pages/template/header', $this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/search', $this->data);
		$this->load->view('pages/template/footer');
	}
}
