<?php

//homepage
$app->get('/', function ($request, $response) {
    $viewData['metaTitle'] = 'My Store';
    $viewData['pageTitle'] = '';
    $viewData['users'] = \Services\Database::getConnection()->get_results("SELECT * FROM user");
    return $this->view->render($response, 'pages/homepage.twig', array_merge($viewData, Services\Util::getGlobalVariables()));
});

//default page handler
$app->get('/{page}', function ($request, $response, $args) use ($app) {
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
});

//subdirectory pages
$app->get('/{directory}/{page}', function ($request, $response, $args) use ($app) {
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
});