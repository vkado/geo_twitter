<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/MY_Controller.php';
class Map extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->library('googlemaps');
        $this->load->model('Map_model');

        /* check cookie if no cookie will be set for user 1 hour*/
        if(!$this->input->cookie('user', true)){
            $value_of_cookie = 'ip:'.$this->input->ip_address().',id:'.get_random_password(4,4);
            set_cookie('user', $value_of_cookie, '86400');
        }

        $this->lang->load("map", "english");
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $lat = $this->input->post('lat') ? $this->input->post('lat') : '13.7278956';
        $long = $this->input->post('long') ? $this->input->post('long') : '100.52412349999997';
        $place = $this->input->post('place') ? $this->input->post('place') : '';
        $marker = ($place != '')? true : false;
        if($marker){
            $data = array(
                'cookie' => $this->input->cookie('user'),
                'lat' =>  $lat,
                'long' =>  $long,
                'place' =>  $place,
            );
            $this->Map_model->addHistory($data);
        }

        $this->data['map'] = $this->mapSearch($lat, $long, $marker);
        $this->data['lat'] = $lat;
        $this->data['long'] = $long;
        $this->data['place'] = $place;

        $this->data['main'] = 'map/map';

        $this->load->vars($this->data);
        $this->render_page('template');
    }

    public function history()
    {
        $this->data['history'] = $this->Map_model->getHistories($this->input->cookie('user'));
        $this->data['main'] = 'map/history';

        $this->load->vars($this->data);
        $this->render_page('template');
    }

    /*
     * generate map
     *
     * @access    private
     * @param    $lat string latitude
     * @param    $long string longtitude
     * @param    $markers bool TRUE for set marker
     * @return map object
     */
    private function mapSearch($lat, $long, $markers){

        $config['center'] = $lat.','.$long;
        $config['zoom'] = '11';
        $config['places'] = TRUE;
        $config['placesAutocompleteInputID'] = 'myPlaceTextBox';
        $config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
        $config['placesAutocompleteOnChange'] = '
        var geocoder = new google.maps.Geocoder();
        var address = document.getElementById("myPlaceTextBox").value;
        geocoder.geocode({ "address": address }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                $("#myPlaceTextBox").parent().removeClass("has-error");
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                var placeText = $("#myPlaceTextBox").val();

                post("'.site_url().'", { lat: latitude, long: longitude, place: placeText });
            } else {
                alert("Request failed.");
                $("#myPlaceTextBox").parent().addClass("has-error");
            }
        });
        ';
        $this->googlemaps->initialize($config);

        if($markers){

            $tweet_area = $this->tweetGeo($lat, $long, '50km');

            foreach($tweet_area as $f){
                $marker = array();
                $marker['position'] = $f->geo->coordinates[0].','.$f->geo->coordinates[1];
                $marker['icon'] = $f->user->profile_image_url;
                $marker['icon_scaledSize'] = "50,50";
                $marker['animation'] = "DROP";
                $marker['infowindow_content'] = 'Tweet : '.json_encode($f->text).'</br> When : '.$f->created_at;
                $marker['title'] = "testing";
                $marker['title'] = "testing";
                $this->googlemaps->add_marker($marker);
            }
        }

        return $this->googlemaps->create_map();
    }

    /*
     * find tweet with geo location
     *
     * @access    private
     * @param    $lat string latitude
     * @param    $long string longtitude
     * @param    $radius number radius of area
     * @return tweet object
     */
    private function tweetGeo($lat, $long, $radius){
        $this->config->load('twitter', TRUE);
        $config_twitter = $this->config->item('twitter');

        $this->load->library('twitterapiexchange', $config_twitter);

        $url = 'https://api.twitter.com/1.1/search/tweets.json';
        $requestMethod = 'GET';

        $getfield = '?q=test&geocode='.$lat.','.$long.','.$radius.'&count=100';

        $response = $this->twitterapiexchange->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest();

        $res = json_decode($response);

        return (!empty($res->statuses))?$res->statuses:array();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */