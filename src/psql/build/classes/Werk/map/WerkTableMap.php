<?php



/**
 * This class defines the structure of the 'werk' table.
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
class WerkTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Werk.map.WerkTableMap';

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
        $this->setName('werk');
        $this->setPhpName('Werk');
        $this->setClassname('Werk');
        $this->setPackage('Werk');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('name', 'Name', 'VARCHAR', true, null, null);
        $this->addForeignKey('autor_id', 'Autor_ID', 'INTEGER', 'autor', 'id', false, null, null);
        $this->addColumn('isbn', 'ISBN', 'VARCHAR', true, 24, null);
        $this->addColumn('release', 'ReleaseDate', 'DATE', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Autor', 'Autor', RelationMap::MANY_TO_ONE, array('autor_id' => 'id', ), null, null);
    } // buildRelations()

} // WerkTableMap
