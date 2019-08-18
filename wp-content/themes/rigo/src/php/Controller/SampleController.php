<?php
namespace Rigo\Controller;

use Rigo\Types\Course;
use Rigo\Types\Book;

class SampleController{

    public function getHomeData(){
        return [
            'name' => 'Rigoberto'
        ];
    }

   // public function getDraftCourses(){
    //    $query = Course::all([ 'status' => 'draft' ]);
     //   return $query->posts;
   // }
    public function getDraftBooks(){
	// Define Arguments
	$args = array(
		'post_type' => 'book',
	);
	// Run Query Using get_posts
	$posts = get_posts($args);
	// loop posts and expose acf fields
	foreach ($posts as $key => $post) {
			$posts[$key]->acf = get_fields($post->ID);
	}
	return $posts;
}

    public function getDraftCourses(){
	// Define Arguments
	$args = array(
		'post_type' => 'course',
	);
	// Run Query Using get_posts
	$posts = get_posts($args);
	// loop posts and expose acf fields
	foreach ($posts as $key => $post) {
			$posts[$key]->acf = get_fields($post->ID);
	}
	return $posts;
}

     public function createBook($data){
        $post_arr = array(
            "post_title" => $data["post_title"],
            "post_content" => $data["post_content"],
            "post_type" => "book",
            "post_status" => "publish",
            "post_author" => get_current_user_id(),
            "meta_input" => array(
                "title" => $data["title"],
                "author" => $data["author"],
                "category" => $data["category"],
                "year" => $data["year"],
                "description" => $data["description"]
               // "product_price" => $data["product_price"],
                //"product_description" => $data["product_description"],
               // "category" => $data["category"],
              //  "image_01" => $data["image_01"]
                ),

            );

       wp_insert_post($post_arr, $wp_error=true);

        return ["post added successfully"];
    }

}
?>