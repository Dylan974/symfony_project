<?php

namespace GithubProjectsBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use GithubProjectsBundle\Entity\Project;
use GithubProjectsBundle\Form\ProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class ProjectController extends FOSRestController {

    /**
    * Get all the Projects
    * @return array
    *
    * @View()
    * @Get("/projects")
    */
    public function getProjectsAction(){

        $projects = $this->getDoctrine()->getRepository("GithubProjectsBundle:Project")->findAll();
        return array('projects' => $projects);
    }

    /**
     * Get a Project by ID
     * @param Project $project
     * @return array
     *
     * @View()
     * @ParamConverter("project", class="GithubProjectsBundle:Project")
     * @Get("/project/{id}",)
     */
    public function getProjectAction(Project $project){

        return array('project' => $project);

    }

    /**
     * Create a new Project
     * @var Request $request
     * @return View|array
     *
     * @View()
     * @Post("/project")
     */
    public function postProjectAction(Request $request)
    {
        // var_dump($request);
        $project = new Project();
        $form = $this->createForm(new ProjectType(), $project);
        $form->handleRequest($request);

        // var_dump($form);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return array("project" => $project);

        }

        return array(
            'form' => $form,
        );
    }

    /**
     * Edit a Project
     * Put action
     * @var Request $request
     * @var Project $project
     * @return array
     *
     * @View()
     * @ParamConverter("project", class="GithubProjectsBundle:Project")
     * @Put("/project/{id}")
     */
    public function putProjectAction(Request $request, Project $project)
    {
        $form = $this->createForm(new ProjectType(), $project);
        $form->submit($request);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($project);
            $em->flush();

            return array("project" => $project);
        }

        return array(
            'form' => $form,
        );
    }

    /**
     * Delete a Project
     * Delete action
     * @var Project $project
     * @return array
     *
     * @View()
     * @ParamConverter("project", class="GithubProjectsBundle:Project")
     * @Delete("/project/{id}")
     */
    public function deleteProjectAction(Project $project)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($project);
        $em->flush();

        return array("status" => "Deleted");
    }
} 