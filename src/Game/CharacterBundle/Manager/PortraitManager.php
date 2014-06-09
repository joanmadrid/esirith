<?php
namespace Game\CharacterBundle\Manager;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class PortraitManager
{
    protected $folders = array('human-male');

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
            $finder = new Finder();
            $finder->files()->in($this->kernelRootDir.'/../web/portraits/'.$folder);

            /**  @var SplFileInfo $file */
            foreach ($finder as $file) {
                $images[] = $file->getFilename();
            }
        }

        return $images;
    }
}
