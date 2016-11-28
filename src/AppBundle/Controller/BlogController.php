<?php


namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class BlogController extends Controller
{

    /**
     * @Route("/new", name="newPost")
     * @Template("default/index.html.twig")
     * @Method("POST")
     */
    public function newPostAction(Request $request){
        $blog_post = [
            'id' => $_POST['id'],
            'title' => $_POST['title'],
            'post' => $_POST['post']
        ];
        $file = fopen("../src/AppBundle/Data/1.txt","w");
        if(!$file)
        {
            echo("Ошибка открытия файла");
        }
        else
        {
            fwrite($file, json_encode($blog_post));
        }
        echo json_encode($blog_post);
        fclose($file);
        return $this->redirectToRoute('homepage');
    }
    /**
     * @Route("/", name="homepage")
     * @Template("default/index.html.twig")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $file = fopen("../src/AppBundle/Data/1.txt","r+");
        if(!$file)
        {
            echo("Ошибка открытия файла");
        }
        else
        {
            $blog_post = json_decode(fgets($file));
        }
        fclose($file);
        return [
            'response' => $blog_post
        ];
    }

    /**
     * @Route("/edit/{id}", name="edit_post")
     * @Template("default/edit.html.twig")
     * METHOD("GET")
     */
    public function editPostAction(Request $request, $id){
        $file = fopen("../src/AppBundle/Data/1.txt","r+");
        if(!$file)
        {
            echo("Ошибка открытия файла");
        }
        else
        {
            $blog_post = json_decode(fgets($file));
        }
        fclose($file);
        if($blog_post->id == $id){
            return [
                'response' => $blog_post
            ];
        } else {
            echo "failed";
        }
    }
    /**
     * @Route("/patch", name="patch_post")
     * @Template("default/edit.html.twig")
     * METHOD("PATCH")
     */
    public function patchPostAction(Request $request){
        $blog_post = [
            'id' => $_POST['id'],
            'title' => $_POST['title'],
            'post' => $_POST['post']
        ];
        $file = fopen("../src/AppBundle/Data/1.txt","r+");
        if(!$file)
        {
            echo("Ошибка открытия файла");
        }
        else
        {
            fwrite($file, json_encode($blog_post));
        }
        fclose($file);
        return $this->redirectToRoute('homepage');
    }
    /**
     * @Route("/edit_handler", name="edit_post_handler")
     * @Template("default/edit.html.twig")
     * METHOD("PUT")
     */
    public function editPostHandlerAction(Request $request){
        $blog_post = [
            'id' => $_POST['id'],
            'title' => $_POST['title'],
            'post' => $_POST['post']
        ];
        $file = fopen("../src/AppBundle/Data/1.txt","w");
        if(!$file)
        {
            echo("Ошибка открытия файла");
        }
        else
        {
            fwrite($file, json_encode($blog_post));
        }
        echo json_encode($blog_post);
        fclose($file);
        return $this->redirectToRoute('homepage');
    }
    /**
     * @Route("/delete/{id}", name="delete_post")
     * METHOD("DELETE")
     */
    public function deletePostAction(Request $request,$id){
        $file = fopen("../src/AppBundle/Data/1.txt","w");
        if(!$file)
        {
            echo("Ошибка открытия файла");
        }
        fclose($file);
        return $this->redirectToRoute('homepage');
    }
}