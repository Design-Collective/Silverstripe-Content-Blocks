<?php
class MultiColumn extends Block {

	private static $singular_name = 'Multi column';
	private static $plural_name = 'Multi columns';

	static $db = array();

	static $has_one = array();

	static $many_many = array(
		'Blocks' => 'Block'
  );

	private static $many_many_extraFields=array(
     'Blocks'=>array('SortOrder'=>'Int')
  );

	private static $defaults = array(
		'Template' => 'MultiColumn',
	);

	/* Clean the relation table when deleting a Block */
	public function onBeforeDelete() {
		parent::onBeforeDelete();
		$this->Blocks()->removeAll();
	}

	public function getCMSFields() {

		$fields = parent::getCMSFields();

		$fields->removeByName(array('ArticleID','SortOrder', 'Active', 'Title', 'Content', 'Blocks', 'YoutubeVideoID', 'Images', 'Media', 'Files', 'Videos', 'Template'));


		if ($this->ID) {
			$BlockConfig = GridFieldConfig_RelationEditor::create(20);
			$BlockConfig->addComponent(new GridFieldOrderableRows('SortOrder'));

			$BlockGF = new GridField('Blocks', 'Blocks', $this->Blocks(), $BlockConfig);

			$classes = array_values(ClassInfo::subclassesFor($BlockGF->getModelClass()));

			if (count($classes) > 1 && class_exists('GridFieldAddNewMultiClass')) {
				$BlockConfig->removeComponentsByType('GridFieldAddNewButton');
				$BlockConfig->addComponent(new GridFieldAddNewMultiClass());
			}

			$fields->addFieldToTab("Root.Main", $BlockGF);
		}

		return $fields;
	}

	public function OrderedBlocks() {
		$blocks = new ArrayList();
		foreach($this->Blocks()->Sort("SortOrder") as $block) {
			$block->Nested = true;
			$blocks[] = $block;
		}
		return $blocks;
	}
}
