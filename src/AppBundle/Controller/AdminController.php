<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

/**
 * Description of AdminController
 *
 * @author et4m1r
 */
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    public function createNewUserEntity()
    {
        return $this->get('fos_user.user_manager')->createUser();
    }

    public function prePersistUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }
    
    public function preUpdateUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }
    
    public function prePersistPostEntity($post)
    {
        $post->setCreatedUser($this->get('security.token_storage')->getToken()->getUser());
    }
    
    public function preUpdatePostEntity($post)
    {
        $post->setUpdatedUser($this->get('security.token_storage')->getToken()->getUser());
        $post->setUpdatedAt(new \DateTime());
    }
    
}