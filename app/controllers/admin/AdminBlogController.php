<?php

namespace app\controllers\admin;

use app\controllers\ContainerController;
use app\models\Post;
use app\models\Categoria;
use app\validate\blog\Blog;
use app\classes\Upload;

class AdminBlogController extends ContainerController {
	public function __construct() {

		guestAdmin();

	}

	public function index() {

		$posts = new Post;
		$posts = $posts->all();

		$this->view([
			'title' => 'Postagem no Blog - Lista',
			'pagina' => 'Blog',
			'evento' => "Lista",
			'posts' => $posts,
		], 'admin.blog.list');

	}

	public function create() {

		$categorias = new Categoria;
		$categorias = $categorias->all();

		$this->view([
			'title' => 'Postagem no Blog - Nova',
			'pagina' => 'Inserir Postagem',
			'categorias' => $categorias,
			'evento' => "Adicionar",
		], 'admin.blog.add');

	}

	public function edit($id) {

		$posts = new Post;
		$posts = $posts->find('id',$id->parameter);	

		$categorias = new Categoria;
		$categorias = $categorias->all();

		$this->view([
			'title' => 'Postagem no Blog - Editar',
			'pagina' => 'Editar uma Postagem',
			'posts' => $posts,
			'categorias' => $categorias,
			'evento' => "Editar",
		], 'admin.blog.edit');

	}

	public function store() {

		$blog = validate(Blog::class);

		if ($blog->hasErrors()) {

			flash($blog->getErrors());

			return back();
		}

	
		// chama a classe upload
		$upload = new Upload();

		$upload->upload('blog', 'file');

		$post = new Post;

		$post->insert(request('imagem')->get());

		redirect('/adminBlog/index');


	}

	

	public function update() {		
			
		$blog = validate(Blog::class);


		if ($blog->hasErrors()) {

		flash($blog->getErrors());

		return back();	
		}		
		
		$post = new Post;

		$post->update(request('imagem')->get(), ['id' => request()->get()->id]);

		redirect('/adminBlog/index');


	}

	public function upload(){

		$blog = validateImage(Blog::class);


		if ($blog->hasErrors()) {

		flash($blog->getErrors());

		return back();	
		}		
		
		//chama a classe upload
		$upload = new Upload();

		$upload->upload('blog', 'file');        

		$post = new Post;

		$post->update(request('imagem')->get(), ['id' => request()->get()->id]);

		redirect('/adminBlog/index');


	}

	public function delete($id) {

		$posts = new Post;

		$posts->delete('id',$id->parameter);

		redirect('/adminBlog/index');

	}
}

?>