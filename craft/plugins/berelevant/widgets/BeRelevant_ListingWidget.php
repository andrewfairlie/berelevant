<?php
namespace Craft;

class BeRelevant_ListingWidget extends BaseWidget
{
    public function getName()
    {
        return Craft::t("Be Relevant");
    }

	private function _getEntries()
	{
		$olderThan = $this->getSettings()->days;
		$olderThanDate = date('Y-m-d', strtotime('-'. $olderThan .' days'));

		// Grab the entry elements
		$criteria = craft()->elements->getCriteria(ElementType::Entry);
		$criteria->sectionId = $this->getSettings()->section;
		$criteria->limit = $this->getSettings()->limit;
		$criteria->dateUpdated = '<'.$olderThanDate;

		return $criteria->find();
	}

	/* Update the widget title based on widget settings */
	public function getTitle()
	{
		return Craft::t($this->settings->title);
	}


    public function getBodyHtml()
    {
        $entries = $this->_getEntries();
        
        return craft()->templates->render('berelevant/listing', array(
            'entries' => $entries
        ));
    }
    
    protected function defineSettings()
    {
        return array(
           'title' => array(AttributeType::Name, 'required'=>true),
           'section' => array(AttributeType::Mixed, 'required'=>true),
           'days' => array(AttributeType::Number, 'min' => 1, 'required'=>true),
           'limit' => array(AttributeType::Number, 'min' => 1, 'required'=>true),
        );
    }
    
    public function getSettingsHtml()
    {
        return craft()->templates->render('berelevant/settings', array(
           'settings' => $this->getSettings()
        ));
    }
    
    public function prepSettings($settings)
    {
        return $settings;
    }

}