<?php
defined('BASEPATH') or exit('No direct script access allowed');

class IndexController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('IndexModel');//load lấy dữ liệu csdl

		$this->load->library("cart");//load library cart
		$this->load->library("pagination");//load library pagination
		$this->load->library('email');//load library

		$this->data['category'] = $this->IndexModel->getCategoryHome();
		$this->data['brand'] = $this->IndexModel->getBrandHome();
	}
	public function index()
	{
		// custom config link
		$config = array();
		$config["base_url"] = base_url() . '/pagination/index';
		$config['total_rows'] = ceil($this->IndexModel->countAllProduct()); //đếm tất cả sản phẩm //8 //hàm ceil làm tròn phân trang
		$config["per_page"] = 3; //từng trang 3 sản phẩn
		$config["uri_segment"] = 3; //lấy số trang hiện tại
		$config['use_page_numbers'] = TRUE; //trang có số
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		//end custom config link
		$this->pagination->initialize($config); //tự động tạo trang
		$this->page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; //current page active
		$this->data["links"] = $this->pagination->create_links(); //tự động tạo links phân trang dựa vào trang hiện tại
		$this->data['allproduct_pagination'] = $this->IndexModel->getIndexPagination($config["per_page"], $this->page);
		// pagination

		// $this->data['allproduct'] = $this->IndexModel->getAllproduct();

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
	public function notfound()
	{
		$this->load->view('pages/template/header', $this->data);
		// $this->load->view('pages/template/slider');
		$this->load->view('pages/404notfound');
		$this->load->view('pages/template/footer');
	}

	public function category($id)
	{
		//custom config link
		$config = array();
		$config["base_url"] = base_url() . '/danh-muc' . '/' . $id;
		$config['total_rows'] = ceil($this->IndexModel->countAllProductByCate($id)); //đếm tất cả sản phẩm //8 //hàm ceil làm tròn phân trang
		$config["per_page"] = 2; //từng trang 3 sản phẩn
		$config["uri_segment"] = 3; //lấy số trang hiện tại
		$config['use_page_numbers'] = TRUE; //trang có số
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		//end custom config link
		$this->pagination->initialize($config); //tự động tạo trang
		$this->page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; //current page active
		$this->data["links"] = $this->pagination->create_links(); //tự động tạo links phân trang dựa vào trang hiện tại
		$this->data['allproductbycate_pagination'] = $this->IndexModel->getCatePagination($id, $config["per_page"], $this->page);
		//pagination

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
			if ($pro->quantity >= $quantity) {
				$cart = array(
					'id' => $pro->id,
					'qty' => $quantity,
					'price' => $pro->price,
					'name' => $pro->title,
					'options' => array('image' => $pro->image, 'in_stock' => $pro->quantity)
				);
			} else {
				$this->session->set_flashdata('error', 'Exceeding the quantity in stock, please reset the order');
				redirect($_SERVER['HTTP_REFERER']);
			}
			;
		}
		$this->cart->insert($cart);
		redirect(base_url() . 'gio-hang', 'refresh');
	}
	public function update_cart_item()
	{
		$rowid = $this->input->post('rowid');
		$quantity = $this->input->post('quantity');

		foreach ($this->cart->contents() as $items) {
			if ($rowid == $items['rowid']) {
				if ($quantity <= $items['options']['in_stock']) {
					$cart = array(
						'rowid' => $rowid,
						'qty' => $quantity,
					);
				} elseif ($quantity > $items['options']['in_stock']) {
					$cart = array(
						'rowid' => $rowid,
						'qty' => $items['options']['in_stock'],
					);
				}
			}
		}
		$this->cart->update($cart);
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
			$token = rand(0000, 9999);
			$date_created = Carbon\Carbon::now('Asia/Ho_Chi_Minh');

			$data = array(
				'email' => $email,
				'password' => $password,
				'name' => $name,
				'address' => $address,
				'phone' => $phone,
				'token' => $token,
				'date_created' => $date_created,
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
				//send mail
				$url_confirm = base_url() . '?token=' . $token . '&email=' . $email;

				$title = "Registration Successful!";
				$message = "Click here to activate your account: " . $url_confirm;
				$to_email = $email;

				$this->send_mail($to_email, $title, $message);

				redirect(base_url('/checkout'));
			} else {
				$this->session->set_flashdata('error', 'login fasle');
				redirect(base_url('/dang-nhap'));
			}
		} else {
			$this->login();
		}
	}
	public function authentication()
	{
		echo 'ss';
	}
	public function checkout()
	{
		if ($this->session->userdata('LoggedInCustomer') && $this->cart->contents()) {
			$this->load->view('pages/template/header', $this->data);
			$this->load->view('pages/checkout');
			$this->load->view('pages/template/footer');
		} else {
			$this->session->set_flashdata('success', 'Please log in to order!!!');
			redirect(base_url() . 'dang-nhap');
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
				//send mail order success
				$to_email = $email;
				$title = "Order success";
				$message = "Will contact you soon";
				$this->send_mail($to_email, $title, $message);
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
		$this->data['title'] = $keyword;
		$this->config->config["pageTitle"] = 'Keyword: ' . $keyword;

		$this->load->view('pages/template/header', $this->data);
		$this->load->view('pages/search', $this->data);
		$this->load->view('pages/template/footer');
	}
	public function send_mail($to_email, $title, $message)
	{
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_user' => 'nguyenhanh030201@gmail.com',
			'smtp_pass' => 'jtfqtezpifusqvjw',
			'smtp_port' => 465,
			'charset' => 'utf-8'
		);
		try {
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");

			$this->email->from('nguyenhanh030201@gmail.com', 'Order success');
			$this->email->to($to_email);

			$this->email->subject($title);
			$this->email->message($message);

			$this->email->send();
			echo 'Email sent successfully!';
		} catch (Exception $e) {
			echo 'Error sending email: ' . $e->getMessage();
		}
	}
	public function contact()
	{
		$this->load->view('pages/template/header', $this->data);
		$this->load->view('pages/template/slider');
		$this->load->view('pages/contact');
		$this->load->view('pages/template/footer');
	}
	public function send_contact()
	{
		$data = [
			'name' => $this->input->post('name'),
			'phone' => $this->input->post('phone'),
			'address' => $this->input->post('address'),
			'note' => $this->input->post('note')
		];
		$this->IndexModel->insertContact($data);
		$this->session->set_flashdata('success', 'Send Success');
		redirect(base_url('contact'));
	}
}
