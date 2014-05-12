<?php

namespace SvetliDotName\Bundle\PartnerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $tb = new TreeBuilder();
        $rn = $tb->root('svetlidotname_partner');

        return $tb;
    }
}

