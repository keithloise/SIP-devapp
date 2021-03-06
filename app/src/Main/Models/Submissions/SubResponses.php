<?php

namespace {

    use SilverStripe\Forms\CheckboxField;
    use SilverStripe\Forms\HiddenField;
    use SilverStripe\Forms\TextField;
    use SilverStripe\ORM\DataObject;

    class SubResponses extends DataObject
    {
        private static $default_sort = 'Sort ASC';

        private static $db = [
            'Name'        => 'Text',
            'SubResponse' => 'Text',
            'Archived'    => 'Boolean',
            'Sort'        => 'Int'
        ];

        private static $has_one = [
            'Responses' => Responses::class,
        ];

        private static $summary_fields = [
            'Name' => 'Label',
            'SubResponse',
            'Status'
        ];

        public function getCMSFields()
        {
            $fields = parent::getCMSFields(); // TODO: Change the autogenerated stub
            $fields->addFieldToTab('Root.Main', new TextField('Name'));
            $fields->addFieldToTab('Root.Main', new TextField('SubResponse'));
            $fields->addFieldToTab('Root.Main', new CheckboxField('Archived'));
            $fields->addFieldToTab('Root.Main', new HiddenField('Sort'));
            return $fields;
        }

        public function getStatus()
        {
            if($this->Archived == 1) return _t('GridField.Archived', 'Archived');
            return _t('GridField.Live', 'Live');
        }
    }
}
