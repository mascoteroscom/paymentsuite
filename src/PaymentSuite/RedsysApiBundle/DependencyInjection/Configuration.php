<?php

/*
 * This file is part of the PaymentSuite package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 */

namespace PaymentSuite\RedsysApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('redsys_api');

        $rootNode->children()
            ->scalarNode('service_endpoint')
                ->cannotBeEmpty()
                ->defaultValue('https://sis-t.redsys.es:25443/sis/services/SerClsWSEntrada/wsdl/SerClsWSEntrada.wsdl')
            ->end()
            ->enumNode('operation_mode')
                ->values(array('capture', 'authorize'))
                ->defaultValue('capture')
            ->end()
            ->scalarNode('merchant_code')
                ->cannotBeEmpty()
                ->defaultValue('327234688')
            ->end()
            ->scalarNode('merchant_secret_key')
                ->cannotBeEmpty()
                ->defaultValue('qwertyasdf0123456789')
            ->end()
            ->scalarNode('merchant_name')
                ->cannotBeEmpty()
                ->defaultValue('bogus merchant')
            ->end()
            ->scalarNode('merchant_terminal')
                ->cannotBeEmpty()
                ->defaultValue('002') // EUR - no Verified By Visa
            ->end()
            ->scalarNode('currency')
                ->cannotBeEmpty()
                ->defaultValue('978') // EUR
            ->end()
            ->arrayNode('templates')
                ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('view_template')
                    ->defaultValue('RedsysApiBundle:RedsysApi:view.html.twig')
                ->end()
                    ->scalarNode('scripts_template')
                        ->defaultValue('RedsysApiBundle:RedsysApi:scripts.html.twig')
                    ->end()
                ->end()
            ->end()
            ->scalarNode('controller_route')
                ->defaultValue('/payment/redsysapi/execute')
            ->end()
            ->arrayNode('payment_success')
                ->isRequired()
                ->children()
                    ->scalarNode('route')
                        ->isRequired()
                        ->cannotBeEmpty()
                    ->end()
                    ->booleanNode('order_append')
                        ->defaultTrue()
                    ->end()
                    ->scalarNode('order_append_field')
                        ->defaultValue('order_id')
                    ->end()
                ->end()
            ->end()
            ->arrayNode('payment_fail')
                ->isRequired()
                ->children()
                    ->scalarNode('route')
                        ->isRequired()
                        ->cannotBeEmpty()
                    ->end()
                    ->booleanNode('order_append')
                        ->defaultTrue()
                    ->end()
                    ->scalarNode('order_append_field')
                        ->defaultValue('order_id')
                    ->end()
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}