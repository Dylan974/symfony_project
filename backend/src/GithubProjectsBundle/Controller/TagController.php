<?php

namespace GithubProjectsBundle\Controller;

use GithubProjectsBundle\Entity\Tag;
use GithubProjectsBundle\Form\TagType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use GithubProjectsBundle\Entity\Project;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TagController extends FOSRestController {

    /**
    * Get all the Tags
    * @return array
    *
    * @View()
    * @Get("/tags")
    */
    public function getTagsAction(){

        $tags = $this->getDoctrine()->getRepository("GithubProjectsBundle:Tag")->findAll();
        return array('tags' => $tags);
    }

    /**
     * Get a Tag by ID
     * @param Tag $tag
     * @return array
     *
     * @View()
     * @ParamConverter("tag", class="GithubProjectsBundle:Tag")
     * @Get("/tag/{id}",)
     */
    public function getTagAction(Tag $tag){

        return array('tag' => $tag);

    }

    /**
     * Get the ProjectsTag by ID
     * @param Tag $tag
     * @return array
     *
     * @View()
     * @ParamConverter("tag", class="GithubProjectsBundle:Tag")
     * @Get("/p_tag/{id}",)
     */
    public function getProjectsTagAction(Tag $tag){

        return array('tag' => $tag);

    }

    /**
     * Create a new Tag
     * @var Request $request
     * @return View|array
     *
     * @View()
     * @Post("/tag")
     */
    public function postTagAction(Request $request)
    {
        // var_dump($request);
        // exit();
        $tag = new Tag();
        $form = $this->createForm(new TagType(), $tag);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            return array("tag" => $tag);

        }

        return array(
            'form' => $form,
        );
    }

    /**
     * Edit a Tag
     * Put action
     * @var Request $request
     * @var Tag $tag
     * @return array
     *
     * @View()
     * @ParamConverter("tag", class="GithubProjectsBundle:Tag")
     * @Put("/tag/{id}")
     */
    public function putTagAction(Request $request, Tag $tag)
    {
        $form = $this->createForm(new TagType(), $tag);
        $form->submit($request);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($tag);
            $em->flush();

            return array("tag" => $tag);
        }

        return array(
            'form' => $form,
        );
    }

    /**
     * Delete a Tag
     * Delete action
     * @var Tag $tag
     * @return array
     *
     * @View()
     * @ParamConverter("tag", class="GithubProjectsBundle:Tag")
     * @Delete("/tag/{id}")
     */
    public function deleteTagAction(Tag $tag)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($tag);
        $em->flush();

        return array("status" => "Deleted");
    }
} 