<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class ImageController extends Controller
{
    
    /**
     * Image uploadé en ajax
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadImageAction(Request $request)
    {
        $image = new Image();
        $media = $request->files->get('file');

        $image->setFile($media);
        $image->setPath($media->getPathName());
        $image->preUpload();
        $image->upload();

        //infos sur le document envoyé
//        var_dump($request->files->get('file'));die;
        return new JsonResponse(
            array(
                'success' => true,
                'path' => $image->getPath()
            )
        );
    }
}
