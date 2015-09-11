<?php

namespace lib\KCFinderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProxyController extends Controller
{

	public function browseAction()
	{
		return $this->proxyForward('browse.php');
	}

	public function cssAction()
	{
		return $this->proxyForward('css/index.php');
	}

	public function js_localizeAction()
	{
		return $this->proxyForward('js_localize.php');
	}

	public function uploadAction()
	{
		return $this->proxyForward('upload.php');
	}
	
	public function js_browser_joinerAction()
	{
		return $this->proxyForward('js/index.php');
	}
	
	public function themesAction($theme, $file)
	{
		return $this->proxyForward('themes/'.$theme.'/'.$file.'.php');
	}
	
	public function imgAction($theme, $file)
	{
            $file = __DIR__."/../kcfinder/themes/".$theme."/img/".$file;
            $response = new Response();
            if(file_exists($file))
            {
                echo file_get_contents($file);
                $parts = explode(".", $file);
                $mimetype = "image/".$parts[count($parts)-1];
                $response->headers->set("Content-Type", $mimetype);
            }else{
                $response = new Response('Page not found.', Response::HTTP_NOT_FOUND);
            }
            return $response;
	}
	
	private function proxyForward($file)
	{
		$previousCwd = getcwd();
		chdir(__DIR__ . '/../kcfinder/');
		
		require $file;
		
		chdir($previousCwd);
		
		ob_end_flush();
		
		return new Response();
	}

}
