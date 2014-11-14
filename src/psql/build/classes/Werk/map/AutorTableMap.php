<?php



/**
 * This class defines the structure of the 'autor' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.Werk.map
 */
class AutorTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Werk.map.AutorTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('autor');
        $this->setPhpName('Autor');
        $this->setClassname('Autor');
        $this->setPackage('Werk');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('autor_id_seq');
        // columns
        $this->addPrimaryKey('id', 'ID', 'INTEGER', true, null, null);
        $this->addColumn('gebdat', 'GebDat', 'VARCHAR', true, 50, null);
        $this->addColumn('beschreibung', 'Beschreibung', 'VARCHAR', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Werk', 'Werk', RelationMap::ONE_TO_MANY, array('id' => 'autor_id', ), null, null, 'Werks');
    } // buildRelations()

} // AutorTableMap
