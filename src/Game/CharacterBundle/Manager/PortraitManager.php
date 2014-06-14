<?php
namespace Game\CharacterBundle\Manager;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class PortraitManager
{
    protected $folders = array('human-male', 'human-female');

    protected $kernelRootDir;

    public function __construct($kernelRootDir)
    {
        $this->kernelRootDir = $kernelRootDir;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        $images = array();
        foreach ($this->folders as $folder) {
            $images = array_merge($images, $this->getFromFolder($folder));
        }

        return $images;
    }

    /**
     * @param $folder
     * @return array
     */
    public function getFromFolder($folder)
    {
        $finder = new Finder();
        $finder->files()->in($this->kernelRootDir.'/../web/portraits/'.$folder);
        $images = array();

        /**  @var SplFileInfo $file */
        foreach ($finder as $file) {
            $images[] = array('folder'=>$folder, 'file'=>$file->getFilename());
        }
        return $images;
    }

    /**
     * @param string $folder
     * @param array $exclude
     * @return string
     */
    public function generateRandom($folder = '', $exclude = array())
    {
        $images = $this->getFromFolder($folder);
        //$images = array_diff($images, $exclude);
        //gamedo: programar exclude
        return $images[array_rand($images)];

    }
}
