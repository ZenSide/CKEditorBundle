<?php
namespace ZenSide\CKEditorBundle\Controller;

use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FileUploadController
 */
class FileUploadController extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{
    /**
     * @Route("/ckeditor/upload", name="file_upload_ckeditor")
     */
    public function uploadCKeditorAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $upload_folder = $this->getParameter('ckeditor.upload_dir');

        if (isset($_FILES['upload'])) {
            $filen = $_FILES['upload']['tmp_name'];
            $filename = $_FILES['upload']['name'];
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $serverName = uniqid('img_').'.'.$extension;

            $con_images = $this->get('kernel')->getRootDir() . "/../web".$upload_folder . $serverName;
            move_uploaded_file($filen, $con_images);

            $url = $this->container->get('templating.helper.assets')->getUrl($upload_folder.$serverName);

            $funcNum = $_GET['CKEditorFuncNum'];
            // Optional: instance name (might be used to load a specific configuration file or anything else).
            $CKEditor = $_GET['CKEditor'];
            // Optional: might be used to provide localized messages.
            $langCode = $_GET['langCode'];

            // Usually you will only assign something here if the file could not be uploaded.
            $message = '';
            return new Response("<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>");
        }

        throw new InvalidArgumentException("No file to upload from ckeditor");
    }
}