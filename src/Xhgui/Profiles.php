<?php
/**
 * Contains logic for getting/creating/removing profile records.
 */
class Xhgui_Profiles
{
    protected $_collection;

    protected $_mapper;

    public function __construct(MongoDb $db)
    {
        $this->_collection = $db->results;
    }

    /**
     * Insert a profile run.
     *
     * Does unchecked inserts.
     *
     * @param array $profile The profile data to save.
     */
    public function insert($profile)
    {
    	// Mongo doesn't take kindly to dots hanging around keys
	    // see http://php.net/manual/en/class.mongoexception.php
		$profile = Xhgui_Util::escapeDotKeys($profile);
        return $this->_collection->insert($profile, array('w' => 0));
    }
}
