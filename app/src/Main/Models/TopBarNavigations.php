<?php

namespace {

    use SilverStripe\CMS\Model\SiteTree;
    use SilverStripe\Forms\CheckboxField;
    use SilverStripe\Forms\DropdownField;
    use SilverStripe\Forms\HiddenField;
    use SilverStripe\Forms\TextField;
    use SilverStripe\ORM\DataObject;

    class TopBarNavigations extends DataObject
    {
        private static $default_sort = 'Sort';
        private static $table_name = 'TopBarNavigation';

        private static $singular_name = "Top-bar navigation";
        private static $plural_name = "Top-bar navigations";

        private static $db = [
            'Name'      => 'Varchar',
            'Archived'  => 'Boolean',
            'Sort'      => 'Int'
        ];

        private static $has_one = [
            'Page' => SiteTree::class
        ];

        private static $summary_fields = [
            'Name',
            'PageLink' => 'Page link',
            'Status'
        ];

        public function getCMSFields()
        {
            $fields = parent::getCMSFields(); // TODO: Change the autogenerated stub
            $fields->addFieldToTab('Root.Main', TextField::create('Name'));
            $fields->addFieldToTab('Root.Main', DropdownField::create('PageID', 'Select page to link', SiteTree::get()->map('ID','Title')));
            $fields->addFieldToTab('Root.Main', CheckboxField::create('Archived'));
            $fields->addFieldToTab('Root.Main', HiddenField::create('Sort'));

            return $fields;
        }

        public function getStatus()
        {
            if($this->Archived == 1) return _t('GridField.Archived', 'Archived');
            return _t('GridField.Live', 'Live');
        }

        public function getPageLink()
        {
            if ($this->owner->Page()) return $this->owner->Page()->Link();
            return 'No selected page';
        }
    }
}
