<?php

//homepage
$app->get('/', function ($request, $response) {
    $viewData['metaTitle'] = 'Zero Trouble';
    $viewData['pageTitle'] = '';
    return $this->renderer->render($response, 'homepage.phtml', array_merge($viewData, Services\Util::getGlobalVariables()));
});

//default page handler
$app->get('/{page}', function ($request, $response, $args) use ($app) {
    $pageName = strtolower($args['page']);
    $fileName = $pageName.'.phtml';
    if(file_exists(join('/',[VIEW_DIRECTORY,$fileName]))){
        $viewData['metaTitle'] = META_TITLE_PREFIX.ucwords(str_replace('-',' ',$pageName));
        $viewData['pageTitle'] = ucwords(str_replace('-',' ',$pageName));
        $viewData['activePage'] = $pageName;
        if(stripos($pageName,'barkbook')!== false){
            $viewData['barkbookData'] = Models\Barkbook::getBarkbookData();
        }
        return $this->renderer->render($response, $fileName, array_merge($viewData, Services\Util::getGlobalVariables()));
    } else {
        throw new \Slim\Exception\NotFoundException($request, $response);
    }
});

//subdirectory pages
$app->get('/{directory}/{page}', function ($request, $response, $args) use ($app) {
    $pageName = strtolower($args['page']);
    $directoryName = strtolower($args['directory']);
    $fileName = $pageName.'.phtml';
    $viewTemplate = join('/',[$directoryName,$fileName]);
    if(file_exists(join('/',[VIEW_DIRECTORY,$viewTemplate]))){
        $viewData['metaTitle'] = META_TITLE_PREFIX.ucwords(str_replace('-',' ',$pageName));
        $viewData['pageTitle'] = ucwords(str_replace('-',' ',$pageName));
        $viewData['activePage'] = $directoryName;
        if(stripos($directoryName,'barkbook')!== false){
            $viewData['barkbookData'] = Models\Barkbook::getBarkbookFriendByName($pageName);
        }
        return $this->renderer->render($response, $viewTemplate, array_merge($viewData, Services\Util::getGlobalVariables()));
    } else {
        throw new \Slim\Exception\NotFoundException($request, $response);
    }
});