<?php
class Comment_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
                $this->load->library(array('ion_auth'));
        }

        public function get_comment($id = FALSE)
				{
				        if ($id === FALSE)
				        {
			                $query = $this->db->get('comment');
			                return $query->result_array();
				        }

				        $query = $this->db->get_where('comment', array('id' => $id));
				        return $query->row_array();
				}

        public function get_comment_by_news_id($id)
				{
				        $query = $this->db->get_where('comment', array('news_id' => $id));
				        return $query->row_array();
				}				

				public function set_comment($id)
				{
				    $data = array(
				        'text' => $this->input->post('text'),
				        'comment_user_id' => $this->ion_auth->user()->row()->id,
				        'news_id' => $id
				    );

				    return $this->db->insert('comment', $data);
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

