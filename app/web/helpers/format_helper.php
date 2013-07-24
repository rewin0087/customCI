<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function formatKeywordUrl($url)
{
    $prefix     = '?';
    $keyword    = '';
    if(strpos($url, '?') !== false) $prefix = '&';
    if(isset($_GET['keyword'])) $keyword = $prefix.'keyword='.htmlspecialchars($_GET['keyword'], ENT_QUOTES);
    return $url.$keyword;
}

function formatSortUrl($val)
{
	$url 		= $_SERVER['REQUEST_URI'];
    $removeHttp = str_replace('http://', '', $url);
    $splitUrl 	= explode('?', $removeHttp);
    $page 		= explode('/', $splitUrl[0]);
    $pageName 	= $page[1];

    $qSplitUrl   = isset($splitUrl[1]) ? $splitUrl[1] : NULL;
    $splitQueries = explode('&', $qSplitUrl);
    for($i = 0; $i < count($splitQueries); $i++) {
        $finalSplit = explode('=', $splitQueries[$i]);
        $newUrl['url'][$finalSplit[0]] = isset($finalSplit[1]) ? $finalSplit[1] : NULL;
    }

    unset($newUrl['url']['sort']);
    $uri = $splitUrl[0];

    $query = '';
    foreach($newUrl['url'] as $k => $q) {
    	$query .= '&'.$k.'='.$q;
    }

    if(empty($_GET)) {
        return $uri.'?keyword&sort='.$val;
    }

    $flag = isset($uri['url']['keyword']) ? NULL : '&keyword';

	return $uri.'?'.substr($query, 1).'&sort='.$val;
}

function highlightKeyword($keyword, $content)
{
    return preg_replace('/'.$keyword.'/i', '<em>'.ucwords($keyword).'</em>', $content);
}

function output($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

function generate_tree($folders) {
    $out = '<ul>';
    $depth = 0;
    foreach($folders as $key => $folder)
    {
        $out .= '<li>';
        $out .= $folder['library_name'];
        if($folder['depth'] == $depth) {
            $out = '<li>';
        } else if ($folder['depth'] >$depth) {

        }
    }

}

function custom_list($list, $listType = 'ul')
{
    $openTag = '<'.$listType.'>';
    $closeTag = '</'.$listType.'>';

    $out = $openTag;
    foreach($list as $value)
    {
        $out .= '<li data-id="'.$value['data']['library_id'].'">';
        $out .= '<i class="icon-folder-open"></i>
                <a href="#">'.$value['data']['library_name'].'</a>';
        // sub folders
        if(!empty($value['sub_folders']))
        {
            $out .= custom_list($value['sub_folders']);
        }

        $out .= '</li>';

    }

    $out .= $closeTag;

    return $out;
}

function getPagination($object, $total, $url, $range)
{
    $object->load->library('pagination');
    $pagi['base_url']               = $url;
    $pagi['full_tag_open']          = '<div class="pagination"><ul>';
    $pagi['full_tag_close']         = '</ul></div>';
    $pagi['cur_tag_open']           = '<li class="active"><a href="">';
    $pagi['cur_tag_close']          = '</a></li>';
    $pagi['num_tag_open']           = '<li>';
    $pagi['num_tag_close']          = '</li>';
    $pagi['last_tag_open']          = '<li>';
    $pagi['last_tag_close']         = '</li>';
    $pagi['first_tag_open']         = '<li>';
    $pagi['first_tag_close']        = '</li>';
    $pagi['next_tag_open']          = '<li>';
    $pagi['next_tag_close']         = '</li>';
    $pagi['prev_tag_open']          = '<li>';
    $pagi['prev_tag_close']         = '</li>';
    $pagi['total_rows']             = $total;
    $pagi['per_page']               = $range;
    $pagi['query_string_segment']   = 'page';
    $pagi['use_page_numbers']       = TRUE;
    $pagi['page_query_string']      = TRUE;

    $object->pagination->initialize($pagi);
    return $object->pagination->create_links();
}

function imageExist($path, $file)
{
    $CI =& get_instance();
    $CI->load->library('eden');

    $exists     = eden('file', $path.'/'.$file)->isFile();
    if($exists) {
        return true;
    }

    return false;
}