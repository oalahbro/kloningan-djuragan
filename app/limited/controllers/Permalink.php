<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permalink extends CI_Controller {

	public function jon()
	{
		$json = 'https://www.google.com/trends/fetchComponent?q=jaket&cid=TOP_QUERIES_0_0&export=3x';

		var_dump($json);
		var_dump(json_decode($json, true));	
	}
	

	public function index() {

        $this->load->helper('array');

        $quotes = array(
			"jaket bomber ",
			"jaket kulit ",
			"jaket wanita ",
			"jaket terbaru ",
			"model jaket ",
			"jaket parka ",
			"jaket pria ",
			"jaket jeans ",
			"gambar jaket ",
			"jaket jokowi ",
			"jaket keren ",
			"jaket parasut ",
			"jaket levis ",
			"jaket cewek ",
			"jaket cowok ",
			"jaket distro ",
			"model jaket terbaru ",
			"jaket couple ",
			"jaket adidas ",
			"jaket hoodie ",
			"jaket gunung ",
			"jaket terbaru 2016 ",
			"model jaket wanita ",
			"jaket army ",
			"jaket alan walker ",
			"jaket bomber jokowi ",
			"model jaket kulit ",
			"jaket denim ",
			"jaket korea ",
			"jaket touring ",
			"harga jaket bomber ",
			"jaket kulit wanita ",
			"jaket kulit pria ",
			"jaket parasit ",
			"jaket musim dingin ",
			"jaket parka wanita ",
			"jaket vans ",
			"jaket kulit garut ",
			"jaket bomber wanita ",
			"jaket naruto ",
			"jaket doraemon ",
			"jaket jas ",
			"gambar jaket terbaru ",
			"harga jaket parka ",
			"jaket boomber ",
			"jaket anak perempuan ",
			"bomber jacket ",
			"jaket musim dingin ",
			"model jaket kulit ",
			"jaket doraemon ",
			"jaket kulit wanita ",
			"jaket alan walker ",
			"model jaket wanita ",
			"jaket jeans ",
			"jaket parasit ",
			"jaket touring ",
			"model jaket terbaru ",
			"blazer wanita ",
			"model blazer ",
			"baju blazer ",
			"opel blazer ",
			"blazer pria ",
			"model blazer terbaru ",
			"blazer korea ",
			"jas hujan ",
			"jas pria ",
			"model jas ",
			"jas pengantin ",
			"jas hujan axio ",
			"model jas wanita ",
			"jas hujan eiger ",
			"jas nikah pria ",
			"model rambut 2017 ",
			"trend rambut 2017 ",
			"warna rambut pria ",
			"parfum pria terbaik ",
			"baju kemeja pria ",
			"minyak wangi pria ",
			"sepatu santai pria ",
			"majalah pria dewasa ",
			"tas kulit pria ",
			"hem pria "
            );
        

        

        $this->form_validation->set_rules('texting', 'texting', 'required');
        
        if($this->form_validation->run() === FALSE) {
            echo form_open('');
            echo form_input('texting');
            echo form_button(array('type' => 'submit', 'content' => 'submit'));
            echo form_close();
        }
        else {
            $inp = $this->input->post('texting');
            $r = date('d/m/y/h/i/s');

            echo form_open('');
            echo form_input('texting', $inp);
            echo form_button(array('type' => 'submit', 'content' => 'submit'));
            echo form_close();


            $links = random_element($quotes) . strtolower($inp) . ' ' . $r;
            $links = str_replace(' ', ', ', $links);
            $links = reduce_multiples($links, ', ', TRUE);
            $links = explode(', ', $links);
            $links = array_unique($links);
            $links = implode (" ", $links);

            echo url_title($links, 'dash',TRUE);
        }
    }


    public function trends() {
    	$uri = 'https://www.google.com/trends/hottrends/atom/feed?pn=p19';
    	$url = 'http://www.google.com/trends/trendsReport?hl=en-US&q=jaket&geo=ID&date=today%2030-d&cmpt=q&content=1&export=1';
    	$urls = 'https://www.google.com/trends/fetchComponent?hl=en-US&q=jogja,wisata&geo=ID&cid=RISING_QUERIES_1_0&export=3';

    	$companies = $this->parseGV(file_get_contents($url));

    	print_r($companies);
    }

    function parseGV($gv) {
// Return array
    	$data = array();
// Buh-Bye extra BS.
    	$gv = preg_replace('/google.visualization.Query.setResponse\(/', '', $gv);
    	$gv = preg_replace('/\)\;/', '', $gv);

    	/*
// Get table Headings
    	preg_match('/"cols":\[{(.*)}\],"rows"/', $gv, $tables);
    	$columns = array();
    	$cols = explode('},{', $tables[1]);
    	foreach ($cols as $col) {
    		$items = explode(",", $col);
    		foreach ($items as $item) {
    			$item = preg_replace('/\"/', '', $item);
    			$arr = explode(':', $item);
    			if ($arr[0] == 'id') {
    				array_push($columns, $arr[1]);
    			}
    		}   
    	}
// Get the rows
    	preg_match('/"rows":\[{"c":(.*)\]/', $gv, $r);
    	if (count($r)) {
    		preg_match_all('/\[{(.*?)}\]}/', $r[1], $rows);
    		for ($i = 0; $i < count($rows[1]); $i++) {
    			$pairs = explode('},{', $rows[1][$i]);
    			for ($p = 0; $p < count($pairs); $p++) {
    				$pair = preg_replace('/\"/', '', $pairs[$p]);
    				$s = preg_replace('/v:/', '', $pair);
    				$data[$i][$columns[$p]] = $s;
    			}
    		}
    	}
    	*/
    	return $data;
    }
    
}

