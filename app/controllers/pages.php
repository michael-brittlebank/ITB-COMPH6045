<?php

//homepage
$app->get('/', function ($request, $response) {
    $viewData['metaTitle'] = 'Zero Trouble';
    $viewData['pageTitle'] = '';
    return $this->view->render($response, 'pages/homepage.twig', array_merge($viewData, Services\Util::getGlobalVariables()));
});

//default page handler
$app->get('/{page}', function ($request, $response, $args) use ($app) {
    $pageName = strtolower($args['page']);
    $fileName = '/pages/'.$pageName.'.twig';
    if(file_exists(join('/',[VIEW_DIRECTORY,$fileName]))){
        $viewData['metaTitle'] = META_TITLE_PREFIX.ucwords(str_replace('-',' ',$pageName));
        $viewData['pageTitle'] = ucwords(str_replace('-',' ',$pageName));
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
    if(file_exists(join('/',[VIEW_DIRECTORY,$viewTemplate]))){
        $viewData['metaTitle'] = META_TITLE_PREFIX.ucwords(str_replace('-',' ',$pageName));
        $viewData['pageTitle'] = ucwords(str_replace('-',' ',$pageName));
        $viewData['activePage'] = $directoryName;
        return $this->view->render($response, $viewTemplate, array_merge($viewData, Services\Util::getGlobalVariables()));
    } else {
        throw new \Slim\Exception\NotFoundException($request, $response);
    }
});