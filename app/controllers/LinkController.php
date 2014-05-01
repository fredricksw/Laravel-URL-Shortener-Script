<?php

class LinkController extends BaseController {
	public function make() {

		$validator = Validator::make(Input::all(), array(
				'url' => 'required|url|max:255'
			));

		if($validator->fails()) {
			return Redirect::action('home')->withInput()->withErrors($validator);
		} else {

			$url = Input::get('url');
			$code = null;

			$exists = Link::where('url', '=', $url);

			if($exists->count() === 1) {
				$code = $exists->first()->code;
			} else {
				
				$created = Link::create(array(
					'url' => $url
				));

				if($created) {
					$code = base_convert(rand(1000,99999), 10, 36);
					
					Link::where('id', '=', $created->id)->update(array(
						'code' => $code
					));
				}	
			}
				if($code) {
					return Redirect::action('home')->with('global', 'Here you go! <a href="' . URL::action('get', $code). '">' . URL::action('get', $code). '</a>');
				}
		}

		return Redirect::action('home')->with('global','Something Went Wrong, try again!');
	}

	public function get($code) {

		$link = Link::where('code', '=', $code);

		if($link->count() === 1) {
			return Redirect::to($link->first()->url);
		}

		return Redirect::action('home');
	}
}