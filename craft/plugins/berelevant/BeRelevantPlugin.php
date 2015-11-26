<?php
namespace Craft;

class BeRelevantPlugin extends BasePlugin
{
    function getName()
    {
         return Craft::t('Be Relevant');
    }

    function getVersion()
    {
        return '1.0';
    }

    function getDeveloper()
    {
        return 'Rye';
    }

    function getDeveloperUrl()
    {
        return 'http://rye.agency';
    }
}