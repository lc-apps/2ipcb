<?php

namespace app\controllers\admin;

use app\classes\Upload;
use app\controllers\ContainerController;
use app\models\Slider;
use app\validate\slider\Slider as SliderValidate;

class AdminSliderController extends ContainerController {

	public function __construct() {

		guestAdmin();

	}

	public function index() {

		$slider = new Slider;
		$slider = $slider->all();

		$this->view([
			'title' => 'Lista de Slider',
			'pagina' => 'Sliders',
			'sliders' => $slider,
			'evento' => "Lista",
		], 'admin.slider.list');

	}

	public function create() {

	}

	/**
	 * @param $id
	 */
	public function destroy($id) {

	}

	/**
	 * @param $id
	 */
	public function edit($id) {

		$slider = new Slider;
		$slider = $slider->find('id',$id->parameter);	


		$this->view([
			'title' => 'Postagem no Blog - Editar',
			'pagina' => 'Editar uma Postagem',
			'slider' => $slider,
			'evento' => "Editar",
		], 'admin.slider.edit');

	}

	

	public function show() {

	}

	public function store() {

	}

	public function upload() {

		$sliderValidate = validateImage(SliderValidate::class);

		if ($sliderValidate->hasErrors()) {

			flash($sliderValidate->getErrors());

			return back();
		}
		
		//chama a classe upload
		$upload = new Upload();

		$upload->upload('slider', 'file');        

		$slider = new Slider;

		$slider->update(request('imagem')->get(), ['id' => request()->get()->id]);

		redirect('/adminSlider/index');

	}

	public function update() {

		
		$slider = new Slider;

		$slider->update(request()->get(), ['id' => request()->get()->id]);

		redirect('/adminSlider/index');

	}

	public function delete($id) {

		$slider = new Slider;

		$slider->delete('id',$id->parameter);

		redirect('/adminSlider/index');

	}
}