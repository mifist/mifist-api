<?php
namespace includes\common;


class MifistRequestApi {
	const MIFISTAPI_GIT_CONTENT = 'https://api.github.com/repos/kenwheeler/slick/contents/README.markdown';
	const MIFISTAPI_GIT_BLOBS_CONTENT = 'https://api.github.com/repos/kenwheeler/slick/git/blobs/761bebfd2731ade11ede557b5b37b2f959b61ac9';

	private static $instance = null;
	private function __construct(){
		
	}
	public static function getInstance(){
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	public function getGitContent(){
		
		$response = wp_remote_get(self::MIFISTAPI_GIT_CONTENT, array(
				'headers' => array(
					'Content-type' => 'application/json'
				)
			)
		);
		
		$body = wp_remote_retrieve_body($response);
		$json = json_decode($body);
		return $json->content;
	}
	
	
	
}