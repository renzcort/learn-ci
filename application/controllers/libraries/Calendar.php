<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

	public function index()
	{
		 // $this->load->library('calendar');
    // $this->calendar;
    // echo $this->calendar->generate();
    // echo "<br>";

    // // display month
    // echo $this->calendar->generate(2018, 7);
    // echo "<br>";

    // // passing data to calendar
    // $data = array(
    //     3  => 'http://example.com/news/article/2006/06/03/',
    //     7  => 'http://example.com/news/article/2006/06/07/',
    //     13 => 'http://example.com/news/article/2006/06/13/',
    //     26 => 'http://example.com/news/article/2006/06/26/'
    // );
    // echo $this->calendar->generate(2018, 7, $data);
    // echo "<br>";

    // // setting display preferences
    // $prefs = array(
    //     'start_day'    => 'saturday',
    //     'month_type'   => 'short',
    //     'day_type'     => 'short'
    // );
    // $this->load->library('calendar', $prefs);
    // echo $this->calendar->generate();
    // echo "<br>";

    // // showing next/prev month link
    // $prefs = array(
    //     'show_next_prev'  =>  TRUE,
    //     'next_prev_url'   =>  'http://example.com/index.php/calendar/show/'
    // );
    // $this->load->library('calendar', $prefs);
    // echo $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4));
    // echo "<br>";

    // // creating template
    // $prefs['template'] = '

    //     {table_open}<table border="0" cellpadding="0" cellspacing="0">{/table_open}

    //     {heading_row_start}<tr>{/heading_row_start}

    //     {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
    //     {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
    //     {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

    //     {heading_row_end}</tr>{/heading_row_end}

    //     {week_row_start}<tr>{/week_row_start}
    //     {week_day_cell}<td>{week_day}</td>{/week_day_cell}
    //     {week_row_end}</tr>{/week_row_end}

    //     {cal_row_start}<tr>{/cal_row_start}
    //     {cal_cell_start}<td>{/cal_cell_start}
    //     {cal_cell_start_today}<td>{/cal_cell_start_today}
    //     {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

    //     {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
    //     {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

    //     {cal_cell_no_content}{day}{/cal_cell_no_content}
    //     {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

    //     {cal_cell_blank}&nbsp;{/cal_cell_blank}

    //     {cal_cell_other}{day}{/cal_cel_other}

    //     {cal_cell_end}</td>{/cal_cell_end}
    //     {cal_cell_end_today}</td>{/cal_cell_end_today}
    //     {cal_cell_end_other}</td>{/cal_cell_end_other}
    //     {cal_row_end}</tr>{/cal_row_end}

    //     {table_close}</table>{/table_close}
    // ';
    // $this->load->library('calendar', $prefs);
    // echo $this->calendar->generate();

    // $prefs['template'] = array(
    //     'table_open'           => '<table class="calendar">',
    //     'cal_cell_start'       => '<td class="day">',
    //     'cal_cell_start_today' => '<td class="today">'
    // );
    // $this->load->library('calendar', $prefs);
    // echo $this->calendar->generate();

    // initialize
    $this->load->library('calendar');
    //initialize 
    $prefs = array(
        'month_type'  => 'long',
        'start_day'   => 'sunday'
    );
    echo $this->calendar->initialize($prefs);
    
    // month
    echo $this->calendar->get_month_name(2);   
    
    // get_day_names
    echo $this->calendar->get_day_names($day_type = 'long');   
    
    // adjust_date
    print_r($this->calendar->adjust_date(13, 2014));   

    // get_total_days
    echo $this->calendar->get_total_days(2, 2012);

    // default_template
    echo $this->calendar->default_template();
    
    // parse_template
    echo $this->calendar->parse_template();
	}

}

/* End of file Calendar.php */
/* Location: ./application/controllers/libraries/Calendar.php */