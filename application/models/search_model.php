<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Search_model extends CI_Model
{
    /*
     * Get all search on one hour
     *
     * @access    public
     * @param    $place string place on log
     * @return   first array
     */
    public function getSearchOneHour($place) {
        $this->db->where('place',db_clean($place), 255);
        $this->db->where('date_modified >= DATE_SUB(NOW(),INTERVAL 1 HOUR)');
        $this->db->order_by('date_modified', 'desc');
        $Q = $this->db->get('search');

        $data = ($Q->num_rows() > 0) ? $Q->row() : null;

        $Q->free_result();

        return $data;
    }

    /*
     * add search
     *
     * @access    public
     * @param    $data array of information
     *              $data['search']
     *              $data['place']
     *
     * @return bool
     */
    public function addSearch($data)
    {
        /* user was find or not */
        $this->db->where('place',db_clean($data['place'], 255));
        $Q = $this->db->get('search');

        if ($Q->num_rows() == 0) {
            /* insert new information */
            $data = array('search' => $data['search'],
                'place' => db_clean($data['place'], 255),
                'date_added' => date('Y-m-d H:i:s'),
                'date_modified' => date('Y-m-d H:i:s')
            );
            $res = $this->db->insert('search', $data);
        } else {
            /* update time search */
            $this->db->where('place',db_clean($data['place'], 255));
            $this->db->set('date_modified', 'NOW()', FALSE);
            $this->db->set('search', $data['search']);
            $res = $this->db->update('search');
        }

        $Q->free_result();
        return $res;
    }

}
?>
