<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class AjaxBlocksDemoController extends Controller
{
    const SIMPLE_CACHE_KEY = 'simple.block';
    const SIMPLE_NUMBER_OF_BLOCKS = 5;

    /**
     * Controller for the simple demo of the ajax blocks
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function simpleAction()
    {
        // Reset the blocks counters
        $this->resetSimpleCounter();

        $variables = array('numberOfBlocks' => self::SIMPLE_NUMBER_OF_BLOCKS);
        return $this->render(':ajax_blocks_demo:simple.html.twig', $variables);
    }

    /**
     * Returns the content for a simple ajax block
     *
     * @param $blockId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function simpleBlockAction($blockId)
    {
        $cache = new FilesystemAdapter();
        $cachedCounter = $cache->getItem(self::SIMPLE_CACHE_KEY.'.'.$blockId);
        $timerReloaded = $cachedCounter->get();
        $variables = array(
            'blockId' => $blockId,
            'timesReloaded' => $timerReloaded++,
        );
        $cachedCounter->set($timerReloaded);
        $cache->save($cachedCounter);

        return $this->render(':ajax_blocks_demo:simple_block.html.twig', $variables);
    }

    /**
     * Resets the reload counters for the simple ajax blocks
     */
    private function resetSimpleCounter()
    {
        $cache = new FilesystemAdapter();
        for ($i = 0; $i < self::SIMPLE_NUMBER_OF_BLOCKS; $i++) {
            $cacheKey = self::SIMPLE_CACHE_KEY.'.'.$i;
            $timesReloaded = $cache->getItem($cacheKey);
            $timesReloaded->set(0);
            $cache->save($timesReloaded);
        }
    }
}
