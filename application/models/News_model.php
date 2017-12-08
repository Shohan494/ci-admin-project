<?php
class News_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
                $this->load->library(array('ion_auth'));
        }

        public function get_news($id = FALSE)
				{
				        if ($id === FALSE)
				        {
				                $query = $this->db->get('news');
				                return $query->result_array();
				        }

				        $query = $this->db->get_where('news', array('id' => $id));
				        return $query->row_array();
				}

				public function set_news()
				{
				    $this->load->helper('url');

				    $slug = url_title($this->input->post('title'), 'dash', TRUE);

				    $data = array(
				        'title' => $this->input->post('title'),
				        'slug' => $slug,
				        'text' => $this->input->post('text'),
				        'news_user_id' => $this->ion_auth->user()->row()->id
				    );

				    return $this->db->insert('news', $data);
				}

				/*
				public function to_be_updated($query_id)
				{
				        if ($query_id === FALSE)
				        {
				        		echo "ERROR";
				        }

				        $query = $this->db->get_where('news', array('id' => $query_id));
				        return $query->row_array();
				}

				public function update_news($query_id)
				{
						echo "query id: " + $query_id;
				    $this->load->helper('url');

				    $slug = url_title($this->input->post('title'), 'dash', TRUE);

				    $data = array(
				        'title' => $this->input->post('title'),
				        'slug' => $slug,
				        'text' => $this->input->post('text'),
				        'news_user_id' => $this->ion_auth->user()->row()->id
				    );

						return $this->db->update('news', $data, array('id' => $query_id));
				}
				*/

				public function edit($id)
				{
				    $this->load->helper('url');
				    $slug = url_title($this->input->post('title'), 'dash', TRUE);
				    $data = array(
				        'title' => $this->input->post('title'),
				        'slug' => $slug,
				        'text' => $this->input->post('text'),
				        'news_user_id' => $this->ion_auth->user()->row()->id
				    );

						return $this->db->update('news', $data, array('id' => $id));
				}				
		    
		    public function delete_news($id)
		    {
		        $this->db->where('id', $id);
		        return $this->db->delete('news');
		    }
}

