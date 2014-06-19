<?php

namespace Game\QuestBundle\Twig;


class QuestExtension extends \Twig_Extension
{
    private $environment;

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('renderItem', array($this, 'renderItem')),
        );
    }

    /**
     * @param Item $item
     * @return mixed
     */
    public function renderItem($item)
    {
        $class = explode("\\", get_class($item));
        $class = array_pop($class);
        return $this->environment->render('ItemBundle:ItemRender:'.$class.'.html.twig', array('item' => $item));
    }

    /**
     * @param \Twig_Environment $environment
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'item_extension';
    }
}