<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class  MY_Controller  extends  CI_Controller  {

    function MY_Controller ()  {
        parent::__construct();

    }

    /**
     * Override view for set all header tag.
     *
     * render_page() will render page.
     *
     * @access    public
     * @param    $view need to render
     *
     * @return    page
     */
    function render_page($view) {

        $this->data['meta_description'] = $this->lang->line('meta_description');
        $this->data['title'] = $this->lang->line('title');

        $this->load->vars($this->data);
        $this->load->view($view);
    }
}
