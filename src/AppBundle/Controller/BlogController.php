<?php


namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;


class BlogController extends Controller
{

    /**
     * @Route("/", name="indexHome")
     * @Template("default/index.html.twig")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $file = fopen("../src/AppBundle/Resources/data/1.txt","r+");

        if(!$file) {
            echo("Error opening file");
        } else {
            $userPost = json_decode(fgets($file));
        }

        fclose($file);

        return ['response' => $userPost];
    }

    /**
     * @Route("/", name="newPost")
     * @Template("default/index.html.twig")
     * @Method("POST")
     */
    public function createPostAction(Request $request){

        $userPost = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'lastName' => $_POST['lastName']
        ];

        $file = fopen("../src/AppBundle/Resources/data/1.txt","w");

        if(!$file) {
            echo("Error opening file");
        } else {
            fwrite($file, json_encode($userPost));
        }
        echo json_encode($userPost);

        fclose($file);

        return $this->redirectToRoute('indexHome');
    }


    /**
     * @Route("/update/{id}", name="update_post")
     * @Template("default/edit.html.twig")
     * METHOD("PUT")
     */
    public function updatePostAction(Request $request, $id){

        $file = fopen("../src/AppBundle/Resources/data/1.txt","r+");

        if(!$file) {
            echo("Error opening file");
        } else {
            $userPost = json_decode(fgets($file));
        }

        fclose($file);

        if($userPost->id == $id){
            return ['response' => $userPost];
        } else {
            echo "failed";
        }
    }

    /**
     * @Route("/edit_post", name="updatePost")
     * @Template("default/edit.html.twig")
     * METHOD("GET")
     */
    public function updatePostHandlerAction(Request $request){

        $userPost = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'lastName' => $_POST['lastName']
        ];

        $file = fopen("../src/AppBundle/Resources/data/1.txt","w");

        if(!$file) {
            echo("Error opening file");
        } else {
            fwrite($file, json_encode($userPost));
        }
        echo json_encode($userPost);

        fclose($file);

        return $this->redirectToRoute('indexHome');
    }

    /**
     * @Route("/delete/{id}", name="delete_post")
     * METHOD("DELETE")
     */
    public function deletePostAction(Request $request,$id){

        $file = fopen("../src/AppBundle/Resources/data/1.txt","w");

        if(!$file) {
            echo("Error opening file");
        }

        fclose($file);

        return $this->redirectToRoute('indexHome');
    }
}