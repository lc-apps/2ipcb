<?php

namespace app\controllers\portal;

use app\controllers\ContainerController;
use app\models\Post;
use app\classes\Pagination;

class PostController extends ContainerController {

	public function index() {

		$pag = new Pagination;

		
		$pag = $pag->pagination(New Post,3);

		$this->view([
			'title' => 'Blog',
			'posts' => $pag['list'],
			'query' => $pag['query'],
			'pagination' => $pag['listpages'],
			'pagestotal' =>$pag['pagestotal'],
		], 'portal.blog');
	}

	/**
	 * @param $request
	 */
	public function show($request) {

		$posts = new Post;
		//$posts = $posts->receiveString()->orderBy($request->next,'DESC')->limit($request->parameter)->__toString();

		$posts = $posts->receiveString()->orderBy($request->next,'DESC');

		$this->view([
			'title' => 'Blog',
			'posts' => $posts,
		], 'portal.blog');

	}

	public function find($id) {

		$posts = new Post;
		$posts = $posts->find('id',$id->parameter);	

		$this->view([
			'title' => $posts->titulo,
			'pagina' => 'Post',
			'post' => $posts,
		], 'portal.blog_single');

	}

	public function page() {

		$pag = new Pagination;

		$pag->pagination(New Post,3);

		$pag = $pag->getSession('Post');

		$this->view([
			'title' => 'Blog',
			'posts' => $posts,
			'pagination' => $pag,
		], 'portal.blog');

		

	}
}