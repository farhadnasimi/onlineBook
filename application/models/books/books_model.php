<?php
class Books_model extends CI_Model
{
    function __construct() {
        parent::__construct();
    }
    
    function getBooks($params=array())
    {
        if(array_search('lang', $params)){
            $lang = $params['lang'];
        }else{
            $lang = 'en';
        }
        $records = $this->db
                ->select('
                    book.id,
                    isbn,
                    book.name bookname,
                    publisher.name_'.$lang.' AS publisher,
                    publish_place,
                    publish_date,
                    page_number,
                    size,
                    year,
                    language.name AS language,
                    category.name_'.$lang.' AS category,
                    price,
                    content,
                    bookstore.name AS bookstore,
                    image,
                    insert_date,
                    stock 
                    ')
                ->from('book')
                ->join('language','language.id=book.language','LEFT')
                ->join('category','category.id=book.category','LEFT')
                ->join('publisher','publisher.id=book.publisher','LEFT')
                ->join('bookstore','bookstore.id=book.bookstore','LEFT')
                ->get();
        if($records->num_rows() > 0){
            return $records->result();
        }
    }
}
