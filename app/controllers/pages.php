<?php

namespace Controllers;

use Interop\Container\ContainerInterface;
use \Services;

class Pages {

    protected $view;

    public function __construct(ContainerInterface $ci) {
        $this->view = $ci->view;
    }

    public function getHomepage ($request, $response) {
        $viewData['metaTitle'] = 'My Store';
        $viewData['pageTitle'] = '';
        return $this->view->render($response, 'pages/homepage.twig', array_merge($viewData, Services\Util::getGlobalVariables()));
    }

    public function getDefaultPageHandler ($request, $response, $args) {
        $pageName = strtolower($args['page']);
        $fileName = '/pages/'.$pageName.'.twig';
        if(file_exists(join('/',[getenv('VIEW_DIRECTORY'),$fileName]))){
            $viewData['metaTitle'] = \Services\Util::getMetaTitle($pageName);
            $viewData['pageTitle'] = \Services\Util::getPageTitle($pageName);
            $viewData['activePage'] = $pageName;
            return $this->view->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
        } else {
            throw new \Slim\Exception\NotFoundException($request, $response);
        }
    }

    public function getDefaultSubdirectoryPageHandler ($request, $response, $args) {
        $pageName = strtolower($args['page']);
        $directoryName = strtolower($args['directory']);
        $fileName = $pageName.'.twig';
        $viewTemplate = join('/',[$directoryName,$fileName]);
        if(file_exists(join('/',[getenv('VIEW_DIRECTORY'),$viewTemplate]))){
            $viewData['metaTitle'] = \Services\Util::getMetaTitle($pageName);
            $viewData['pageTitle'] = \Services\Util::getPageTitle($pageName);
            $viewData['activePage'] = $directoryName;
            return $this->view->render($response, $viewTemplate, array_merge($viewData, Services\Util::getGlobalVariables()));
        } else {
            throw new \Slim\Exception\NotFoundException($request, $response);
        }
    }
}