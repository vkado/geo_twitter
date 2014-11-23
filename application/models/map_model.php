<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Map_model extends CI_Model
{
    /*
     * Get all history from cookie
     *
     * @access    public
     * @param    $cookie need to get history
     * @return array
     */
    public function getHistories($cookie) {
        $this->db->where('cookie',db_clean($cookie), 26);
        $this->db->order_by('date_modified', 'desc');
        $Q = $this->db->get('history');

        $data = ($Q->num_rows() > 0) ? $Q->result_array() : array();

        $Q->free_result();

        return $data;
    }

    /*
     * add history
     *
     * @access    public
     * @param    $data array of information
     *              $data['cookie']
     *              $data['place']
     *              $data['lat']
     *              $data['long']
     *
     * @return bool
     */
    public function addHistory($data)
    {
        /* user was find or not */
        $this->db->where('cookie',db_clean($data['cookie'], 26));
        $this->db->where('place',db_clean($data['place'], 255));
        $this->db->where('lat',db_clean($data['lat'], 100));
        $this->db->where('long',db_clean($data['long'], 100));
        $Q = $this->db->get('history');

        if ($Q->num_rows() == 0) {
            /* insert new information */
            $data = array('cookie' => db_clean($data['cookie'], 26),
                'place' => db_clean($data['place'], 255),
                'lat' => db_clean($data['lat'], 100),
                'long' => db_clean($data['long'], 100),
                'date_added' => date('Y-m-d H:i:s'),
                'date_modified' => date('Y-m-d H:i:s')
            );
            $res = $this->db->insert('history', $data);
        } else {
            /* update time search */
            $this->db->where('cookie',db_clean($data['cookie'], 26));
            $this->db->where('place',db_clean($data['place'], 255));
            $this->db->where('lat',db_clean($data['lat'], 100));
            $this->db->where('long',db_clean($data['long'], 100));
            $this->db->set('date_modified', 'NOW()', FALSE);
            $res = $this->db->update('history');
        }

        $Q->free_result();
        return $res;
    }

}
?>
