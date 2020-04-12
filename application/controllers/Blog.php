<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller; // using namaspace
require_once APPPATH . '/libraries/REST_Controller.php'; //including libraray
require_once APPPATH . '/libraries/Format.php'; // response code format

class Blog extends REST_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Blog_Model', 'blog_model');
  }

  /**
  * Handling get Requests
  *
  */
  public function blog_get()
  {
    $id = $this->get('id'); //getting query param

    $blogs = $this->blog_model->getBlogs($id);

    if ( ! $blogs) {

      $this->response([
        'status' => false,
        'message' => 'Data not found',  // you can use lnguage file data here.
      ], 404); // you can use http methods for your purposes

      /**
      * for more info on http code visite https://httpstatuses.com
      */

    }
    else {

      $this->response([
        'status' => true,
        'message' => 'Blogs get successfully',  // you can use lnguage file data here.
        'blogs' => $blogs
      ], 200);

    }
  }

  /**
  * handling post requests
  */
  public function blog_post()
  {
    //you can validate your data here.

    $data['title'] = $this->post('title');
    $data['description'] = $this->post('description');

    $response = $this->blog_model->createBlog($data);

    if ( ! $response) {

      $this->response([
        'status' => false,
        'message' => 'Unable to create blog',
      ], 500);

    }
    else {

      $this->response([
        'status' => true,
        'message' => 'Blog created successfully',
        'blog' => $data
      ], 200);

    }
  }

  /**
  * handling put request for update
  */
  public function blog_put()
  {
      $id = $this->put('id');

      // data to update
      $data['title'] = $this->put('title');
      $data['description'] = $this->put('description');

      $response = $this->blog_model->updateBlog($id, $data);

      if ( ! $response) {

        $this->response([
          'status' => false,
          'message' => 'Unable to update blog',
        ], 404);

      }
      else {

        $this->response([
          'status' => true,
          'message' => 'Blog updated successfully',
          'blog' => $data
        ], 200);
    }
  }

  /**
  *handling delete requests
  */
  public function blog_delete($id=NULL)
  {
      $response = $this->blog_model->deleteBlog($id);

      if ( ! $response) {

        $this->response([
          'status' => false,
          'message' => 'Unable to delete blog',
        ], 404);

      }
      else {

        $this->response([
          'status' => true,
          'message' => 'Blog deleted successfully',
        ], 200);
    }
  }
}
