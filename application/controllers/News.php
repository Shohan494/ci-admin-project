<?php
class News extends CI_Controller 
{

        public function __construct()
        {
                parent::__construct();
                $this->load->library(array('ion_auth'));
                $this->load->model('news_model');
                $this->load->helper('url_helper');
                if (!$this->ion_auth->logged_in())
                {
                    redirect('auth/login');
                }
        }

        public function index()
        {
                $data['news'] = $this->news_model->get_news();
                $data['title'] = 'News archive';

                $this->load->view('templates/header', $data);
                $this->load->view('news/index', $data);
                $this->load->view('templates/footer');
        }

        public function view($slug = NULL)
        {
                $data['news_item'] = $this->news_model->get_news($slug);

                if (empty($data['news_item']))
                {
                        show_404();
                }

                $data['title'] = $data['news_item']['title'];

                $this->load->view('templates/header', $data);
                $this->load->view('news/view', $data);
                $this->load->view('templates/footer');
        }
        public function create()
        {
            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['title'] = 'Create a news item';

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('text', 'Text', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header', $data);
                $this->load->view('news/create');
                $this->load->view('templates/footer');

            }
            else
            {
                $this->news_model->set_news();
                $this->load->view('news/success');
            }
        }
        public function update($post_id)
        {
            $this->load->helper('form');

            $data['updated_data'] = $this->news_model->to_be_updated($post_id);

            // all the line below should be inside this if block, later .....
            if (empty($data['updated_data']))
            {
                echo "ERROR IN QUERY - NO DATA EXISTS";
            }
            else
            {
                $data['title'] = 'Update a news item';
                $this->load->view('templates/header', $data);
                $this->load->view('news/update', $data);
                $this->load->view('templates/footer');
            }
        }

        public function updatedata()
        {
            $post_id = $this->input->post('id');
            $data['updated_data'] = $this->news_model->to_be_updated($post_id);

            $this->load->library('form_validation');

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('text', 'Text', 'required');

            if ($this->form_validation->run() === FALSE)
            {
                $data['title'] = 'Update a news item';
                $this->load->view('templates/header', $data);
                $this->load->view('news/update/' + $post_id , $data);
                $this->load->view('templates/footer');
            }
            else
            {
                $this->news_model->update_news($post_id);
                //$this->load->view('news/success');
            }
        }

}