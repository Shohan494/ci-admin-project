<?php
class News2 extends CI_Controller 
{

        public function __construct()
        {
                parent::__construct();
                $this->load->library(array('ion_auth'));
                $this->load->model('news_model');
                $this->load->model('comment_model');
                $this->load->helper('url_helper');
                if (!$this->ion_auth->logged_in())
                {
                    redirect('auth/login');
                }
        }

        public function index()
        {
                $data['news'] = $this->news_model->get_news();
                $data['comments'] = $this->comment_model->get_comment();
                $data['title'] = 'News List';

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
                $data['news_title'] = $data['news_item']['title'];
                $data['news_writer'] = $data['news_item']['title'];
                $data['title'] = 'Single News Page';
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
                $this->load->view('news/message');
            }
        }
    public function edit()
    {
        $id = $this->uri->segment(3);
        $data['title'] = 'Edit a news item';        
        $data['news_item'] = $this->news_model->get_news($id);
        $data['id'] = $id;
        
        if (empty($id) || empty($data['news_item']) || $data['news_item']['news_user_id'] !== $this->ion_auth->user()->row()->id)
        {
            show_404();
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');
 
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('news/edit', $data);
            $this->load->view('templates/footer');
 
        }
        else
        {
            $this->news_model->edit($id);
            redirect( base_url() . 'index.php/news2');
        }
    }
    
    public function delete()
    {
        $id = $this->uri->segment(3);
        $data['news_item'] = $this->news_model->get_news($id);
        
        if (empty($id) || empty($data['news_item']) || $data['news_item']['news_user_id'] !== $this->ion_auth->user()->row()->id)
        {
            show_404();
        }

        $this->news_model->delete_news($id);
        $this->load->view('news/message');      
        redirect( base_url() . 'index.php/news2');        
    }

}